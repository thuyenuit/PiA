<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldGroupStoreRequest;
use App\Models\Field;
use App\Models\FieldViewModel;
use App\Models\FieldGroup;
use App\Models\Language;
use App\Helpers\CommonHelper;
use App\Http\Requests\FieldStoreRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Spatie\TranslationLoader\LanguageLine;
use Exception;

class FieldsController extends Controller
{
     /**
     * Display a listing of the custom field.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Field::select('fields.id', 
                                    'fields.name as field_name',
                                    'fields.label_locale as label_locale',
                                    'field_groups.label_locale as field_group_name',
                                    'fields.sequence as field_sequence',
                                    'field_groups.sequence as field_group_sequence')
                                ->join('field_groups', 'field_groups.id', '=', 'fields.field_group_id')
                                ->orderBy('field_group_sequence')
                                ->orderBy('field_group_name')
                                ->orderBy('field_sequence')
                                ->orderBy('field_name')
                                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = CommonHelper::generateButtonEdit(route('fields.edit', $row));
                    $btnDelete = CommonHelper::generateButtonDelete(route('fields.destroy', $row));
                    return $btnEdit . $btnDelete;
                })
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.settings.fields'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.fields'),
                    'active' => true,
                ]
            ],
        ];

        return view('fields.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new field.
     *
     * @return Response
     */
    public function create()
    { 
        $breadcrumbs = [
            'title' => __('fields.breadcrumbs.create'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.fields'),
                    'active' => false,
                    'href' => route('fields.index'),
                ],
                [
                    'text' => __('fields.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $customfield = new FieldViewModel();     
        $customfieldgroups = FieldGroup::select('id', "label_locale", 'sequence')
                                        ->orderBy('sequence')
                                        ->orderBy('label_locale')
                                        ->get();
        $arraycfgs = collect([]); 
        foreach($customfieldgroups as $item)
        {
            $arraycfgs->push(['key' => $item->id, 'value' => $item->label_locale]);
        }
        $arrayfieldtypes = CommonHelper::collectionFieldType(); 
        return view('fields.create', compact('breadcrumbs', 'customfield', 'arraycfgs', 'arrayfieldtypes'));
    }

    /**
     * Store a newly created field in storage.
     *
     * @param FieldStoreRequest $request
     * @return Response
     */
    public function store(FieldStoreRequest $request)
    {   
        $request->validated(); 
        $name = $request['name'];
        $label_locale = $request['label_locale'];
        $field_group_id = (int)$request->get('field_group');
        $field_type = (int)$request->get('field_type');
        $default_value = $request['default_value'];
        $items = $request['items'];    
        $max_length = $request['max_length'];
        $sequence = (int)$request->get('sequence');
        $mandatory = $request['mandatory'] == 'on' ? true : false;
        $show_in_report = $request['show_in_report'] == 'on' ? true : false;      
        $show_in_portal = $request['show_in_portal'] == 'on' ? true : false;   
        $setting = [];
     
        switch($field_type)
        {
            case 0:
                $setting = [
                    'default_value' =>$default_value,
                    'max_length' => $max_length
                ];
            break;
            case 4: case 5:

                if(!isset($items->a))
                {
                    $arrayItems  = explode(",", $items);
                    $setting = [
                        'default_value' =>$default_value,
                        'items' => json_encode($arrayItems),
                    ];
                }
                else
                {
                    $setting = [
                        'default_value' =>$default_value,
                    ];
                }
            break;
            case 1: case 2: case 3:
                $setting = [
                    'default_value' =>$default_value,
                ];
            break;
            case 6:
                $setting = [
                    'data_source' =>$default_value,
                ];
            break;
        }

        Field::create([
            'name' => $name,         
            'label_locale' => $label_locale,          
            'field_group_id' => $field_group_id,
            'field_type' => $field_type,
            'sequence' => $sequence,
            'mandatory' => $mandatory,
            'active' => true,
            'show_in_report' => $show_in_report,
            'show_in_portal' => $show_in_portal,
            'setting' => json_encode($setting)
        ]);

        LanguageLine::create([
             'group' => 'fields',
             'key' => $label_locale,
             'text' => [
                 'en' => $name,
             ],
        ]);
       
        Session::flash('flash_message', __('fields.flash_messages.created'));
        return redirect(route('fields.index'));
    }

    /**
     * Display the specified field.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified field.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified field in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified field from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Field::findOrFail($id)->delete();
        Session::flash('flash_message', __('fields.flash_messages.deleted'));
        return redirect(route('fields.index'));
    }
}
