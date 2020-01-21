<?php

namespace App\Http\Controllers;

use App\Helpers\ClubsHelper;
use App\Helpers\CommonHelper;
use App\Http\Requests\ClubSaveRequest;
use App\Models\Club;
use App\Models\Services;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Yajra\DataTables\Facades\DataTables;

class ClubsController extends Controller
{
    use ClubsHelper;

    /**
     * Display a listing of the club.
     *
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Club::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnShow = CommonHelper::generateButtonShow(route('clubs.show', $row->id));
                    $btnEdit = CommonHelper::generateButtonEdit(route('clubs.edit', $row->id));
                    $btnDelete = CommonHelper::generateButtonDelete(route('clubs.destroy', $row->id));
                    return $btnShow . $btnEdit . $btnDelete;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.clubs'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.clubs'),
                    'active' => true,
                ]
            ]
        ];

        return view('clubs.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new club.
     *
     * @return Response
     */
    public function create()
    {
        $breadcrumbs = [
            'title' => __('clubs.breadcrumbs.new'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.clubs'),
                    'active' => false,
                    'href' => route('clubs.index'),
                ],
                [
                    'text' => __('clubs.breadcrumbs.new'),
                    'active' => true,
                ]
            ]
        ];
        $club = new Club();
        $users = [];
        $services = Services::pluck('name','locale_key');

        return view('clubs.create', compact('breadcrumbs', 'users', 'club', 'services'));
    }

    /**
     * Store a newly created club in storage.
     *
     * @param ClubSaveRequest $request
     * @return Response
     */
    public function store(ClubSaveRequest $request)
    {
        $request->validated();

        $requestData = $request->all();

        if ($request->hasFile('club_logo')) {
            $requestData['club_logo'] = $this->storeImage($request, 'club_logo');
        }

        $requestData['charge_club_of_quota'] = ($request->has('charge_club_of_quota')) ? true : false;
        if (!$requestData['charge_club_of_quota']) {
            $requestData['monthly_payment'] = null;
        }

        Club::create($requestData);

        Session::flash('flash_message', __('clubs.flash_messages.created'));
        return redirect(route('clubs.index'));
    }

    /**
     * Display the specified club.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $club = Club::findOrFail($id);

        $breadcrumbs = [
            'title' => $club->name,
            'links' => [
                [
                    'text' => __('layouts.sidebar.clubs'),
                    'active' => false,
                    'href' => route('clubs.index')
                ],
                [
                    'text' => $club->name,
                    'active' => true,
                ]
            ]
        ];

        return view('clubs.show', compact('breadcrumbs', 'club'));
    }

    /**
     * Show the form for editing the specified club.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            'title' => __('clubs.breadcrumbs.edit'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.clubs'),
                    'active' => false,
                    'href' => route('clubs.index'),
                ],
                [
                    'text' => __('clubs.breadcrumbs.edit'),
                    'active' => true,
                ]
            ]
        ];

        $club = Club::findOrFail($id);
        $services = Services::pluck('name','locale_key');
        $users = User::join('clubs_users','clubs_users.user_id','=','users.id')->where('clubs_users.club_id',$id)
            ->pluck('users.name as name', 'users.id as id');

        return view('clubs.edit', compact('breadcrumbs', 'users', 'services', 'club'));
    }

    /**
     * Update the specified club in storage.
     *
     * @param ClubSaveRequest $request
     * @param int $id
     * @return Response
     */
    public function update(ClubSaveRequest $request, $id)
    {
        $request->validated();

        $requestData = $request->all();

        if ($request->hasFile('club_logo')) {
            $this->deleteImage($id);
            $requestData['club_logo'] = $this->storeImage($request, 'club_logo');
        }
        $requestData['charge_club_of_quota'] = ($request->has('charge_club_of_quota')) ? true : false;
        if (!$requestData['charge_club_of_quota']) {
            $requestData['monthly_payment'] = null;
        }

        Club::findOrFail($id)->update($requestData);

        Session::flash('flash_message', __('clubs.flash_messages.updated'));

        return redirect(route('clubs.index'));
    }

    /**
     * Remove the specified club from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        // TODO: check club member

        Club::findOrFail($id)->delete();

        Session::flash('flash_message', __('clubs.flash_messages.deleted'));

        return redirect(route('clubs.index'));
    }
}
