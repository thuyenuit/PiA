<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldGroupStoreRequest;
use App\Models\FieldGroup;
use App\Helpers\CommonHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

use Exception;

class FieldGroupsController extends Controller
{
     /**
     * Display a listing of the field group.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        $language = App::getLocale();
        $datas = FieldGroup::latest()->select('id', "label_locale", 'sequence')->get();
       
        if ($request->ajax()) {
           
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {                  
                    $btnEdit = CommonHelper::generateButtonEdit(route('fieldgroups.edit', $row));
                    $btnDelete = CommonHelper::generateButtonDelete(route('fieldgroups.destroy', $row));
                    return $btnEdit . $btnDelete;
                })
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.settings.field_groups'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.field_groups'),
                    'active' => true,
                ]
            ],
        ];

        return view('field_groups.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new field group.
     *
     * @return Response
     */
    public function create()
    {
        $breadcrumbs = [
            'title' => __('field_groups.breadcrumbs.create'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.field_groups'),
                    'active' => false,
                    'href' => route('fieldgroups.index'),
                ],
                [
                    'text' => __('field_groups.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $customfieldgroup = new FieldGroup();

        return view('field_groups.create', compact('breadcrumbs', 'customfieldgroup'));
    }

    /**
     * Store a newly created field group in storage.
     *
     * @param FieldGroupStoreRequest $request
     * @return Response
     */
    public function store(FieldGroupStoreRequest $request)
    {
        $request->validated();
        FieldGroup::create($request->all());
        Session::flash('flash_message', __('field_groups.flash_messages.created'));
        return redirect(route('fieldgroups.index'));
    }

    /**
     * Show the form for editing the specified field group.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            'title' => __('field_groups.breadcrumbs.edit'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.field_groups'),
                    'active' => false,
                    'href' => route('fieldgroups.index'),
                ],
                [
                    'text' => __('field_groups.breadcrumbs.edit'),
                    'active' => true,
                ],
            ]
        ];

        $customfieldgroup = FieldGroup::findOrFail($id); 
        return view('field_groups.edit', compact('breadcrumbs', 'customfieldgroup'));
    }

    /**
     * Update the specified field group in storage.
     *
     * @param FieldGroupStoreRequest $request
     * @param int $id
     * @return Response
     */
    public function update(FieldGroupStoreRequest $request, $id)
    {
        $request->validated();
        FieldGroup::findOrFail($id)->update($request->all());

        Session::flash('flash_message', __('field_groups.flash_messages.updated'));
        return redirect(route('fieldgroups.index'));
    }

    /**
     * Remove the specified field group from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        FieldGroup::findOrFail($id)->delete();
        Session::flash('flash_message', __('field_groups.flash_messages.deleted'));
        return redirect(route('fieldgroups.index'));
    }
}
