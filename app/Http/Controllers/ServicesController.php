<?php


namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\ServiceSaveRequest;
use App\Models\Services;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Spatie\TranslationLoader\LanguageLine;
use Yajra\DataTables\Facades\DataTables;

class ServicesController extends Controller
{
    /**
     * Display a listing of the services.
     *
     * @param Request $request
     * @return Response
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Services::latest()->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = CommonHelper::generateButtonEdit(route('services.edit', $row));
                    $btnDelete = CommonHelper::generateButtonDelete(route('services.destroy', $row));
                    return $btnEdit . $btnDelete;
                })
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.settings.services'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.services'),
                    'active' => true,
                ]
            ],
        ];

        return view('services.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new services.
     *
     * @return Response
     */
    public function create()
    {
        $breadcrumbs = [
            'title' => __('services.breadcrumbs.create'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.services'),
                    'active' => false,
                    'href' => route('services.index'),
                ],
                [
                    'text' => __('services.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $service = new Services();

        return view('services.create', compact('breadcrumbs', 'service'));
    }

    /**
     * Store a newly created service in storage.
     *
     * @param ServiceSaveRequest $request
     * @return Response
     */
    public function store(ServiceSaveRequest $request)
    {
        $request->validated();

        DB::beginTransaction();

        // Create Service
        Services::create($request->all());

        // Create Language Line
        LanguageLine::create([
            'group' => 'services',
            'key' => 'locale_key.' . $request->locale_key,
            'text' => [
                'en' => $request->name,
            ],
        ]);
        Cache::flush();

        DB::commit();

        Session::flash('flash_message', __('services.flash_messages.created'));
        return redirect(route('services.index'));
    }

    /**
     * Show the form for editing the specified service.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            'title' => __('services.breadcrumbs.edit'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.services'),
                    'active' => false,
                    'href' => route('services.index'),
                ],
                [
                    'text' => __('services.breadcrumbs.edit'),
                    'active' => true,
                ],
            ]
        ];

        $service = Services::findOrFail($id);

        return view('services.edit', compact('service', 'breadcrumbs'));
    }

    /**
     * Update the specified service in storage.
     *
     * @param ServiceSaveRequest $request
     * @param int $id
     * @return Response
     */
    public function update(ServiceSaveRequest $request, $id)
    {
        $request->validated();

        $service = Services::findOrFail($id);
        $old_locale_key = $service->locale_key;

        DB::beginTransaction();

        // Update Service
        $service->update($request->all());

        // Update Language Line
        $language_line = LanguageLine::where('group', 'services')
            ->where('key', 'locale_key.' . $old_locale_key)
            ->first();

        if(empty($language_line)){
            LanguageLine::create([
                'group' => 'services',
                'key' => 'locale_key.' . $request->locale_key,
                'text' => [
                    'en' => $request->name,
                ],
            ]);
        }else{
            $language_line->update([
                'key' => 'locale_key.' . $request->locale_key,
                'text' => [
                    'en' => $request->name,
                ],
            ]);
        }
        Cache::flush();

        DB::commit();

        Session::flash('flash_message', __('services.flash_messages.updated'));
        return redirect(route('services.index'));
    }

    /**
     * Remove the specified service from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        // TODO: check club service

        DB::beginTransaction();

        // Delete Service
        $service = Services::findOrFail($id);
        $service->delete();

        // Delete Language Lines
        LanguageLine::where('group', 'services')->where('key', 'locale_key.' . $service->locale_key)->delete();
        Cache::flush();

        DB::commit();
        Session::flash('flash_message', __('services.flash_messages.deleted'));
        return redirect(route('services.index'));
    }

}
