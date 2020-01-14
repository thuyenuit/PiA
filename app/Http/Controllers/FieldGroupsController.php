<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\FieldGroupSaveRequest;
use App\Models\Field;
use App\Models\FieldGroup;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

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
        if ($request->ajax()) {
            $datas = FieldGroup::latest()->select('id', "label_locale", 'sequence')->get();
            return DataTables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = CommonHelper::generateButtonEdit(route('field_groups.edit', $row));
                    $btnDelete = CommonHelper::generateButtonDelete(route('field_groups.destroy', $row));
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
                    'href' => route('field_groups.index'),
                ],
                [
                    'text' => __('field_groups.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $field_group = new FieldGroup();

        return view('field_groups.create', compact('breadcrumbs', 'field_group'));
    }

    /**
     * Store a newly created field group in storage.
     *
     * @param FieldGroupSaveRequest $request
     * @return Response
     */
    public function store(FieldGroupSaveRequest $request)
    {
        $request->validated();
        FieldGroup::create($request->all());
        Session::flash('flash_message', __('field_groups.flash_messages.created'));
        return redirect(route('field_groups.index'));
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
                    'href' => route('field_groups.index'),
                ],
                [
                    'text' => __('field_groups.breadcrumbs.edit'),
                    'active' => true,
                ],
            ]
        ];

        $field_group = FieldGroup::findOrFail($id);
        return view('field_groups.edit', compact('breadcrumbs', 'field_group'));
    }

    /**
     * Update the specified field group in storage.
     *
     * @param FieldGroupSaveRequest $request
     * @param int $id
     * @return Response
     */
    public function update(FieldGroupSaveRequest $request, $id)
    {
        $request->validated();
        FieldGroup::findOrFail($id)->update($request->all());

        Session::flash('flash_message', __('field_groups.flash_messages.updated'));
        return redirect(route('field_groups.index'));
    }

    /**
     * Remove the specified field group from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $field = Field::where('field_group_id', $id)->first();
        if (!empty($field)) {
            Session::flash('flash_error', __('field_groups.flash_messages.cant_delete'));
            return redirect(route('field_groups.index'));
        }

        FieldGroup::findOrFail($id)->delete();
        Session::flash('flash_message', __('field_groups.flash_messages.deleted'));
        return redirect(route('field_groups.index'));
    }
}
