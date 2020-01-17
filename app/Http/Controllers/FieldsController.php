<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\FieldSaveRequest;
use App\Models\Field;
use App\Models\FieldGroup;
use App\Models\FieldMember;
use App\ViewModels\FieldViewModel;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\TranslationLoader\LanguageLine;
use Yajra\DataTables\Facades\DataTables;

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
                'fields.locale_key as locale_key',
                'field_groups.name as field_group_name',
                'fields.sequence as field_sequence',
                'field_groups.sequence as field_group_sequence',
                'fields.mandatory')
                ->join('field_groups', 'field_groups.id', '=', 'fields.field_group_id')
                ->where('active', true)
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
                ->addColumn('mandatory', function ($row) {
                    $switchChecked = $row->mandatory ? 'checked' : '';
                    $switch = "<label><input type='checkbox' $switchChecked><span class='lever switch-col-blue'></span></label>";
                    $url = route('fields.mandatory', $row);
                    $button = "<a onclick='confirmSwitchMandatory(event, this, {$row->mandatory})'>$switch</a>";
                    return "<div class='switch'><form method='POST' action='$url' class='ml-1'>" . csrf_field() . $button . "</form></div>";
                })
                ->rawColumns(['action', 'mandatory'])
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

        $field = new FieldViewModel();
        $field->show_in_portal = true;
        $field->show_in_report = true;
        $array_field_groups = FieldGroup::select('id', 'name', 'sequence')
            ->orderBy('sequence')
            ->orderBy('name')
            ->pluck('name', 'id')->toArray();
        $array_field_types = config('constants.FIELD_TYPE_ARRAY');
        return view('fields.create', compact('breadcrumbs', 'field', 'array_field_groups', 'array_field_types'));
    }

    /**
     * Store a newly created field in storage.
     *
     * @param FieldSaveRequest $request
     * @return Response
     */
    public function store(FieldSaveRequest $request)
    {
        $request->validated();
        $name = $request['name'];
        $locale_key = $request['locale_key'];
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

        switch ($field_type) {
            case config('constants.FIELD_TYPE')['string']:
                $setting = [
                    'default_value' => $default_value,
                    'max_length' => $max_length
                ];
                break;
            case config('constants.FIELD_TYPE')['number']:
            case config('constants.FIELD_TYPE')['boolean']:
            case config('constants.FIELD_TYPE')['date']:
                $setting = [
                    'default_value' => $default_value,
                ];
                break;
            case config('constants.FIELD_TYPE')['single_choice']:
            case config('constants.FIELD_TYPE')['multi_choice']:
                if (!isset($items->a)) {
                    $arrayItems = explode(",", $items);
                    $setting = [
                        'default_value' => $default_value,
                        'items' => json_encode($arrayItems),
                    ];
                } else {
                    $setting = [
                        'default_value' => $default_value,
                    ];
                }
                break;
            case config('constants.FIELD_TYPE')['data_source']:
                $setting = [
                    'data_source' => $default_value,
                ];
                break;
        }

        DB::beginTransaction();

        Field::create([
            'name' => $name,
            'locale_key' => $locale_key,
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
            'key' => 'locale_key.' . $locale_key,
            'text' => [
                'en' => $name,
            ],
        ]);
        Cache::flush();

        DB::commit();

        Session::flash('flash_message', __('fields.flash_messages.created'));
        return redirect(route('fields.index'));
    }

    /**
     * Show the form for editing the specified field.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            'title' => __('fields.breadcrumbs.edit'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.fields'),
                    'active' => false,
                    'href' => route('fields.index'),
                ],
                [
                    'text' => __('fields.breadcrumbs.edit'),
                    'active' => true,
                ],
            ]
        ];

        $fieldDB = Field::findOrFail($id);
        $field = new FieldViewModel();
        $field->id = $fieldDB->id;
        $field->name = $fieldDB->name;
        $field->locale_key = $fieldDB->locale_key;
        $field->field_group_id = $fieldDB->field_group_id;
        $field->field_type = $fieldDB->field_type;
        $field->sequence = $fieldDB->sequence;
        $field->mandatory = $fieldDB->mandatory;
        $field->show_in_report = $fieldDB->show_in_report;
        $field->show_in_portal = $fieldDB->show_in_portal;
        $objSetting = json_decode($fieldDB->setting);

        switch ($field->field_type) {
            case config('constants.FIELD_TYPE')['string']:
                $field->default_value = $objSetting->default_value;
                $field->max_length = $objSetting->max_length;
                break;
            case config('constants.FIELD_TYPE')['number']:
            case config('constants.FIELD_TYPE')['boolean']:
            case config('constants.FIELD_TYPE')['date']:
                $field->default_value = $objSetting->default_value;
                break;
            case config('constants.FIELD_TYPE')['single_choice']:
            case config('constants.FIELD_TYPE')['multi_choice']:
                $objItems = json_decode($objSetting->items);
                $field->default_value = $objSetting->default_value;
                $field->items = implode(",", $objItems);
                break;
            case config('constants.FIELD_TYPE')['data_source']:
                $field->default_value = $objSetting->data_source;
                break;
        }

        $array_field_groups = FieldGroup::select('id', 'locale_key', 'sequence')
            ->orderBy('sequence')
            ->orderBy('locale_key')
            ->pluck('locale_key', 'id')->toArray();
        $array_field_types = config('constants.FIELD_TYPE_ARRAY');
        return view('fields.edit', compact('breadcrumbs', 'field', 'array_field_groups', 'array_field_types'));
    }

    /**
     * Update the specified field in storage.
     *
     * @param FieldSaveRequest $request
     * @param int $id
     * @return Response
     */
    public function update(FieldSaveRequest $request, $id)
    {
        $request->validated();
        $name = $request['name'];
        $locale_key = $request['locale_key'];
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
        switch ($field_type) {
            case config('constants.FIELD_TYPE')['string']:
                $setting = [
                    'default_value' => $default_value,
                    'max_length' => $max_length
                ];
                break;
            case config('constants.FIELD_TYPE')['number']:
            case config('constants.FIELD_TYPE')['boolean']:
            case config('constants.FIELD_TYPE')['date']:
                $setting = [
                    'default_value' => $default_value,
                ];
                break;
            case config('constants.FIELD_TYPE')['single_choice']:
            case config('constants.FIELD_TYPE')['multi_choice']:

                if (!isset($items->a)) {
                    $arrayItems = explode(",", $items);
                    $setting = [
                        'default_value' => $default_value,
                        'items' => json_encode($arrayItems),
                    ];
                } else {
                    $setting = [
                        'default_value' => $default_value,
                    ];
                }
                break;
            case config('constants.FIELD_TYPE')['data_source']:
                $setting = [
                    'data_source' => $default_value,
                ];
                break;
        }

        $field = Field::findOrFail($id);
        $old_locale_key = $field->locale_key;

        DB::beginTransaction();

        $field->update([
            'name' => $name,
            'locale_key' => $locale_key,
            'field_group_id' => $field_group_id,
            'field_type' => $field_type,
            'sequence' => $sequence,
            'mandatory' => $mandatory,
            'show_in_report' => $show_in_report,
            'show_in_portal' => $show_in_portal,
            'setting' => json_encode($setting)
        ]);

        $language_line = LanguageLine::where('group', 'fields')
            ->where('key', $old_locale_key)
            ->first();

        if (empty($language_line)) {
            LanguageLine::create([
                'group' => 'fields',
                'key' => 'locale_key.' . $locale_key,
                'text' => [
                    'en' => $name,
                ],
            ]);
        } else {
            $language_line->update([
                'key' => 'locale_key.' . $locale_key,
                'text' => [
                    'en' => $name,
                ],
            ]);
        }
        Cache::flush();

        DB::commit();

        Session::flash('flash_message', __('fields.flash_messages.updated'));
        return redirect(route('fields.index'));
    }

    /**
     * Remove the specified field from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $field_member = FieldMember::where('field_id', $id)->first();
        if (!empty($field_member)) {
            Session::flash('flash_error', __('fields.flash_messages.cant_delete'));
            return redirect(route('fields.index'));
        }

        Field::findOrFail($id)->update(['active' => false,
            'show_in_report' => false,
            'show_in_portal' => false]);

        Session::flash('flash_message', __('fields.flash_messages.deleted'));
        return redirect(route('fields.index'));
    }

    /**
     * Switch mandatory to selected
     *
     * @param $id
     * @return Response
     */
    function updateMandatory($id)
    {
        $field = Field::findOrFail($id);
        if ($field->mandatory) {
            $field->update(['mandatory' => false]);
        } else {
            $field->update(['mandatory' => true]);
        }
        Session::flash('flash_message', __('fields.flash_messages.mandatory_updated'));
        return redirect(route('fields.index'));
    }
}
