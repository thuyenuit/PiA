<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomFieldGroupStoreRequest;
use App\Models\CustomFieldGroup;
use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

use Exception;

class CustomFieldGroupsController extends Controller
{
     /**
     * Display a listing of the custom field group.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        //$language = App::getLocale();
        $datas = CustomFieldGroup::latest()->select('id', "label_locale", 'sequence')->get();
       
        if ($request->ajax()) {
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = CommonHelper::generateButtonEdit(route('customfieldgroups.edit', $row));
                    $btnDelete = CommonHelper::generateButtonDelete(route('customfieldgroups.destroy', $row));
                    return $btnEdit . $btnDelete;
                })
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.settings.custom_field_groups'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.custom_field_groups'),
                    'active' => true,
                ]
            ],
        ];

        return view('custom_field_groups.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new custom field group.
     *
     * @return Response
     */
    public function create()
    {
        $breadcrumbs = [
            'title' => __('custom_field_groups.breadcrumbs.create'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.custom_field_groups'),
                    'active' => false,
                    'href' => route('customfieldgroups.index'),
                ],
                [
                    'text' => __('custom_field_groups.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $customfieldgroup = new CustomFieldGroup();

        return view('custom_field_groups.create', compact('breadcrumbs', 'customfieldgroup'));
    }

    /**
     * Store a newly created custom field group in storage.
     *
     * @param CustomFieldGroupStoreRequest $request
     * @return Response
     */
    public function store(CustomFieldGroupStoreRequest $request)
    {
        $request->validated();
        $isInteger = (is_int($request->input('sequence'))) ? true : false;
        if($isInteger)
        {
           
        }

        CustomFieldGroup::create($request->all());
        Session::flash('flash_message', __('custom_field_groups.flash_messages.created'));
        return redirect(route('customfieldgroups.index'));
    }

    /**
     * Show the form for editing the specified custom field group.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            'title' => __('custom_field_groups.breadcrumbs.edit'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.custom_field_groups'),
                    'active' => false,
                    'href' => route('customfieldgroups.index'),
                ],
                [
                    'text' => __('custom_field_groups.breadcrumbs.edit'),
                    'active' => true,
                ],
            ]
        ];

        $customfieldgroup = CustomFieldGroup::findOrFail($id); 
        return view('custom_field_groups.edit', compact('breadcrumbs', 'customfieldgroup'));
    }

    /**
     * Update the specified custom field group in storage.
     *
     * @param CustomFieldGroupStoreRequest $request
     * @param int $id
     * @return Response
     */
    public function update(CustomFieldGroupStoreRequest $request, $id)
    {
        $request->validated();
        CustomFieldGroup::findOrFail($id)->update($request->all());

        Session::flash('flash_message', __('custom_field_groups.flash_messages.updated'));
        return redirect(route('customfieldgroups.index'));
    }

    /**
     * Remove the specified custom field group from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        CustomFieldGroup::findOrFail($id)->delete();
        Session::flash('flash_message', __('custom_field_groups.flash_messages.deleted'));
        return redirect(route('customfieldgroups.index'));
    }
}
