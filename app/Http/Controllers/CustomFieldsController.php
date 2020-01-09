<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomFieldGroupStoreRequest;
use App\Models\CustomField;
use App\Models\CustomFieldGroup;
use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Arr;
use Exception;

class CustomFieldsController extends Controller
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
            $data = CustomField::select('custom_fields.id', 
                                        'custom_fields.name',
                                        'custom_field_groups.label_locale')
                                ->join('custom_field_groups', 'custom_field_groups.id', '=', 'custom_fields.custom_field_group_id')
                                ->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = CommonHelper::generateButtonEdit(route('customfields.edit', $row));
                    $btnDelete = CommonHelper::generateButtonDelete(route('customfields.destroy', $row));
                    return $btnEdit . $btnDelete;
                })
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.settings.custom_fields'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.custom_fields'),
                    'active' => true,
                ]
            ],
        ];

        return view('custom_fields.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new field.
     *
     * @return Response
     */
    public function create()
    {
        $breadcrumbs = [
            'title' => __('custom_fields.breadcrumbs.create'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.custom_fields'),
                    'active' => false,
                    'href' => route('customfields.index'),
                ],
                [
                    'text' => __('custom_fields.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $customfield = new CustomField();     
        $customfieldgroups = CustomFieldGroup::select('id', "label_locale")->get();
        $arraycfgs = collect([]); 
        foreach($customfieldgroups as $item)
        {
            $arraycfgs->push(['key' => $item->id, 'value' => $item->label_locale]);
        }
        $arrayfieldtypes = collect([]); 
        $arrayfieldtypes->push(['key' => 0, 'value' => 'String']);
        $arrayfieldtypes->push(['key' => 1, 'value' => 'Number']);
        $arrayfieldtypes->push(['key' => 2, 'value' => 'Boolean']);
        $arrayfieldtypes->push(['key' => 3, 'value' => 'Date']);
        $arrayfieldtypes->push(['key' => 4, 'value' => 'Single Choice']);
        $arrayfieldtypes->push(['key' => 5, 'value' => 'Multiple Choice']);
        $arrayfieldtypes->push(['key' => 6, 'value' => 'Data Source']);

        return view('custom_fields.create', compact('breadcrumbs', 'customfield', 'arraycfgs', 'arrayfieldtypes'));
    }

    /**
     * Store a newly created field in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }
}
