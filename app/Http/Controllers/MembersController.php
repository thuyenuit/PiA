<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\ProfileUpdateRequest;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Models\Member;
use App\Models\User;
use App\Models\FieldGroup;
use App\Models\Field;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
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
     * @param Request $request
     * @return Response
     */
    public function profile(Request $request)
    {
      
        $breadcrumbs = [
            'title' => __('members.breadcrumbs.profile'),
            'links' => [
                [
                    'text' => __('members.breadcrumbs.profile'),
                    'active' => false,
                    'href' => route('my_profile'),
                ],
                [
                    'text' => __('members.breadcrumbs.edit_profile'),
                    'active' => true,
                ],
            ]
        ];

        $user = Auth::user();
        $member = $user->member;

        if (empty($member)) {
            $member = new Member();
        }

        $tabs = config('constants.PROFILE_TABS');
        $currentTab = $request->get('tab');
        if (empty($currentTab) || !in_array($currentTab, array_values($tabs))) {
            $currentTab = config('constants.PROFILE_TABS')['info'];         
        }

        $field_groups = new FieldGroup();
        $fields = new Field();
        if ($currentTab == config('constants.PROFILE_TABS')['info']) {
            $field_groups = FieldGroup::select('id', "label_locale", 'sequence')->orderBy('sequence')->get();
            $fields = Field::select('fields.id',
                                    'fields.name as field_name',
                                    'fields.field_group_id',
                                    'fields.label_locale as field_locale_key',
                                    'fields.field_type',
                                    'fields.sequence as field_sequence',
                                    'fields.mandatory',
                                    'fields.setting',
                                    'field_members.value',
                                    'field_groups.label_locale as field_group_name',
                                    'field_groups.sequence as field_group_sequence',)
                            ->join('field_groups', 'field_groups.id', '=', 'fields.field_group_id')
                            ->leftJoin('field_members', function($join){
                                $join->on('fields.id', '=', 'field_members.field_id') 
                                    ->where('field_members.member_id', '=', Auth::id());
                            })
                            ->where('fields.active', true)
                            ->where('fields.show_in_portal', true)
                            ->orderBy('field_group_sequence')
                            ->orderBy('field_group_name')
                            ->orderBy('field_sequence')
                            ->orderBy('field_name')
                            ->get();
                            
            foreach ($fields as $field) {
                $field->setting = json_decode($field->setting);              
            }
        }

        

        return view('members.profile', compact('breadcrumbs',
            'user',
            'member',
            'field_groups',
            'fields',
            'tabs',
            'currentTab'));
    }

    /**
     * Update profile of current user
     *
     * @param ProfileUpdateRequest $request
     * @return Response
     */
    public function updateProfile(ProfileUpdateRequest $request)
    {
        $request->validated();
        $user = Auth::user();
        $member = $user->member;
        User::findOrFail($user->id)->update(['name' => $request->name]);
        User::findOrFail($user->id)->update(['email' => $request->email]);
        Member::findOrFail($member->id)->update(['address' => $request->address]);
        Member::findOrFail($member->id)->update(['town' => $request->town]);
        Member::findOrFail($member->id)->update(['phone' => $request->phone]);
        //$member = Auth::user()->update($requestData);
        return redirect()->route('my_profile');
    }

    /**
     * Update avatar of current user
     *
     * @param Request $request
     * @return Response
     */
    public function updateAvatar(Request $request)
    {
        $requestData = $request->all();
        $base64_str = substr($requestData['image'], strpos($requestData['image'], ",") + 1);
        if (CommonHelper::isBase64Encoded($base64_str)) {
            $fileExtension = CommonHelper::getFileExtension($requestData['image']);
            $fileName = 'avatar' . '_' . time() . '_' . rand(0, 9999999) . '.' . $fileExtension;
            $image = base64_decode($base64_str);
            file_put_contents(public_path(config('constants.UPLOAD.LOGO_ICON')) . '/' . $fileName, $image);
            $user = Auth::user();
            $member = $user->member;
            Member::findOrFail($member->id)->update(['avatar' => $fileName]);
        }
        return redirect()->route('my_profile');
    }

    public function updatePassword(PasswordUpdateRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $request->validated();
        if ($user->password) {
            $currentPassword = $request->old_password;
            $newPassword = $request->password;
            if (Hash::check($currentPassword, $user->password)) {
                $user->password = Hash::make($newPassword);
                $user->save();
                Session::flash('flash_message', __('admin.users.flash_messages.updated_password'));
                return redirect('admin/my-profile?tab=' . User::PROFILE_TABS['password']);
            } else {
                Session::flash('flash_message', __('admin.users.flash_messages.password_incorrect'));
                return redirect('admin/my-profile?tab=' . User::PROFILE_TABS['password']);
            }
        }
    }
}
