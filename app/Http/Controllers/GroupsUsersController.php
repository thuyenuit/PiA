<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\GroupUserStoreRequest;
use App\Models\Group;
use App\Models\GroupUser;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class GroupsUsersController extends Controller
{
    /**
     * Display a listing of the groups.
     *
     * @param int $group_id
     * @return Response
     * @throws Exception
     */
    public function index($group_id)
    {
        $group = Group::findOrFail($group_id);
        $data = GroupUser::where('group_id', $group_id)->latest()->get();

        return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) use ($group) {
                return CommonHelper::generateButtonDelete(route('groups.users.destroy', [$group, $row]));
            })
            ->addColumn('name', function ($row) {
                return $row->user->name;
            })
            ->addColumn('email', function ($row) {
                return $row->user->email;
            })
            ->addColumn('club', function ($row) {
                // TODO: return club name
//                return empty($row->club) ? null : $row->club->name;

                return null;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $group_id
     * @return Response
     */
    public function create($group_id)
    {
        $group = Group::findOrFail($group_id);

        $breadcrumbs = [
            'title' => __('groups_users.breadcrumbs.create'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.groups'),
                    'active' => false,
                    'href' => route('groups.index'),
                ],
                [
                    'text' => $group->name,
                    'active' => false,
                    'href' => route('groups.show', $group),
                ],
                [
                    'text' => __('groups_users.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $group_user = new GroupUser();
        $users = User::whereDoesntHave('groups_users', function (Builder $query) use ($group_id) {
            $query->where('group_id', $group_id);
        })
            ->orderBy('name')->pluck('name', 'id');
        $users->prepend(__('groups_users.select_user'), '');

        // TODO: select items for club

        return view('groups_users.create', compact('breadcrumbs', 'group', 'group_user', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param GroupUserStoreRequest $request
     * @param int $group_id
     * @return Response
     */
    public function store(GroupUserStoreRequest $request, $group_id)
    {
        $request->validated();
        $requestData = $request->all();
        $requestData['group_id'] = $group_id;
        GroupUser::create($requestData);

        Session::flash('flash_message', __('groups_users.flash_messages.created'));
        return redirect(route('groups.show', ['id' => $group_id]));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $group_id
     * @param int $id
     * @return Response
     */
    public function destroy($group_id, $id)
    {
        GroupUser::where('group_id', $group_id)->where('id', $id)->firstOrFail()->delete();

        Session::flash('flash_message', __('groups_users.flash_messages.deleted'));
        return redirect(route('groups.show', ['id' => $group_id]));
    }
}
