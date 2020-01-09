<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class MembersController extends Controller
{
    /**
     * Display a listing of the member.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = CommonHelper::generateButtonEdit(route('members.edit', $row->id));
                    $btnDelete = CommonHelper::generateButtonDelete(route('members.destroy', $row->id));
                    return $btnEdit . $btnDelete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.members'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.members'),
                    'active' => true,
                ]
            ]
        ];

        return view('members.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new member.
     *
     * @return Response
     */
    public function create()
    {
        $breadcrumbs = [
            'title' => __('members.breadcrumbs.new'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.members'),
                    'active' => false,
                    'href' => route('members.index'),
                ],
                [
                    'text' => __('members.breadcrumbs.new'),
                    'active' => true,
                ]
            ]
        ];

        $user = new User();

        return view('members.create', compact('breadcrumbs', 'user'));
    }

    /**
     * Store a newly created member in storage.
     *
     * @param UserStoreRequest $request
     * @return Response
     */
    public function store(UserStoreRequest $request)
    {
        $request->validated();
        $requestData = $request->all();
        $requestData['password'] = bcrypt($request->password);
        User::create($requestData);

        Session::flash('flash_message', __('members.flash_messages.created'));
        return redirect(route('members.index'));
    }

    /**
     * Display the specified member.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified member.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            'title' => __('members.breadcrumbs.edit'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.members'),
                    'active' => false,
                    'href' => route('members.index'),
                ],
                [
                    'text' => __('members.breadcrumbs.edit'),
                    'active' => true,
                ],
            ]
        ];

        $user = User::findOrFail($id);

        return view('members.edit', compact('breadcrumbs', 'user'));
    }

    /**
     * Update the specified member in storage.
     *
     * @param UserUpdateRequest $request
     * @param int $id
     * @return Response
     */
    public function update(UserUpdateRequest $request, $id)
    {
        $request->validated();
        User::findOrFail($id)->update(['name' => $request->name]);

        Session::flash('flash_message', __('members.flash_messages.updated'));
        return redirect(route('members.index'));
    }

    /**
     * Remove the specified member from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        if (Auth::id() == $id) {
            Session::flash('flash_error', __('members.flash_messages.cant_delete'));
            return redirect(route('members.index'));
        }

        User::findOrFail($id)->delete();

        Session::flash('flash_message', __('members.flash_messages.deleted'));
        return redirect(route('members.index'));
    }

    /**
     * Get profile of current user
     */
    public function profile()
    {

    }
}
