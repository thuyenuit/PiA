<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\GroupSaveRequest;
use App\Models\Group;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;


class GroupsController extends Controller
{
    /**
     * Display a listing of the group.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Group::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnShow = CommonHelper::generateButtonShow(route('groups.show', $row));
                    $btnEdit = CommonHelper::generateButtonEdit(route('groups.edit', $row));
                    $btnDelete = CommonHelper::generateButtonDelete(route('groups.destroy', $row));
                    return $btnShow . $btnEdit . $btnDelete;
                })
                ->addColumn('builtin_col', function ($row) {
                    $switchChecked = $row->builtin ? 'checked' : '';
                    $switch = "<label><input type='checkbox' disabled $switchChecked><span class='lever switch-col-blue'></span></label>";
                    return "<div class='switch'>$switch</div>";
                })
                ->rawColumns(['action', 'builtin_col'])
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.settings.groups'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.groups'),
                    'active' => true,
                ]
            ],
        ];

        return view('groups.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new group.
     *
     * @return Response
     */
    public function create()
    {
        $breadcrumbs = [
            'title' => __('groups.breadcrumbs.create'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.groups'),
                    'active' => false,
                    'href' => route('groups.index'),
                ],
                [
                    'text' => __('groups.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $group = new Group();

        return view('groups.create', compact('breadcrumbs', 'group'));
    }

    /**
     * Store a newly created group in storage.
     *
     * @param GroupSaveRequest $request
     * @return Response
     */
    public function store(GroupSaveRequest $request)
    {
        $request->validated();
        Group::create($request->all());

        Session::flash('flash_message', __('groups.flash_messages.created'));
        return redirect(route('groups.index'));
    }

    /**
     * Display the specified group.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $group = Group::findOrFail($id);

        $breadcrumbs = [
            'title' => $group->name,
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.groups'),
                    'active' => false,
                    'href' => route('groups.index'),
                ],
                [
                    'text' => $group->name,
                    'active' => true,
                ],
            ]
        ];

        return view('groups.show', compact('breadcrumbs', 'group'));
    }

    /**
     * Show the form for editing the specified group.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            'title' => __('groups.breadcrumbs.edit'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.groups'),
                    'active' => false,
                    'href' => route('groups.index'),
                ],
                [
                    'text' => __('groups.breadcrumbs.edit'),
                    'active' => true,
                ],
            ]
        ];

        $group = Group::findOrFail($id);

        return view('groups.edit', compact('group', 'breadcrumbs'));
    }

    /**
     * Update the specified group in storage.
     *
     * @param GroupSaveRequest $request
     * @param int $id
     * @return Response
     */
    public function update(GroupSaveRequest $request, $id)
    {
        $request->validated();
        Group::findOrFail($id)->update($request->all());

        Session::flash('flash_message', __('groups.flash_messages.updated'));
        return redirect(route('groups.index'));
    }

    /**
     * Remove the specified group from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Group::findOrFail($id)->delete();
        Session::flash('flash_message', __('groups.flash_messages.deleted'));
        return redirect(route('groups.index'));
    }
}
