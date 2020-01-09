<?php

namespace App\Http\Controllers;

use App\Helpers\CommonHelper;
use App\Http\Requests\LanguageSaveRequest;
use App\Models\Language;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use Spatie\TranslationLoader\LanguageLine;
use Yajra\DataTables\Facades\DataTables;

class TranslationsController extends Controller
{
    /**
     * Display a listing of the translation.
     *
     * @param Request $request
     * @return void
     * @throws Exception
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Language::latest()->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnShow = CommonHelper::generateButtonShow(route('translations.show', $row));
                    $btnEdit = CommonHelper::generateButtonEdit(route('translations.edit', $row));
                    $btnDelete = CommonHelper::generateButtonDelete(route('translations.destroy', $row));
                    return $btnShow . $btnEdit . $btnDelete;
                })
                ->addColumn('primary', function ($row) {
                    $switchChecked = $row->is_primary ? 'checked disabled' : '';
                    $switch = "<label><input type='checkbox' $switchChecked><span class='lever switch-col-blue'></span></label>";

                    if ($row->is_primary) {
                        return "<div class='switch'>$switch</div>";
                    }

                    $url = route('translations.primary', $row);
                    $button = "<a onclick='confirmSwitchPrimary(event, this)'>$switch</a>";
                    return "<div class='switch'><form method='POST' action='$url' class='ml-1'>" . csrf_field() . $button . "</form></div>";
                })
                ->rawColumns(['action', 'primary'])
                ->make(true);
        }

        $breadcrumbs = [
            'title' => __('layouts.sidebar.settings.translations'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.translations'),
                    'active' => true,
                ]
            ]
        ];

        return view('translations.index', compact('breadcrumbs'));
    }

    /**
     * Show the form for creating a new translation.
     *
     * @return Response
     */
    public function create()
    {
        $breadcrumbs = [
            'title' => __('translations.breadcrumbs.create'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.translations'),
                    'active' => false,
                    'href' => route('translations.index'),
                ],
                [
                    'text' => __('translations.breadcrumbs.create'),
                    'active' => true,
                ],
            ]
        ];

        $language = new Language();

        return view('translations.create', compact('breadcrumbs', 'language'));
    }

    /**
     * Store a newly created translation in storage.
     *
     * @param LanguageSaveRequest $request
     * @return Response
     */
    public function store(LanguageSaveRequest $request)
    {
        $request->validated();
        Language::create($request->all());

        Session::flash('flash_message', __('translations.flash_messages.created'));
        return redirect(route('translations.index'));
    }

    /**
     * Display the specified translation.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $language = Language::findOrFail($id);

        $breadcrumbs = [
            'title' => $language->label,
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.translations'),
                    'active' => false,
                    'href' => route('translations.index'),
                ],
                [
                    'text' => $language->label,
                    'active' => true,
                ],
            ]
        ];

        $currentTab = $request->get('tab');
        if (empty($currentTab) || !in_array($currentTab, config('constants.LOCALE_TABS'))) {
            $currentTab = config('constants.LOCALE_TABS')[0];
        }

        return view('translations.show', compact('breadcrumbs', 'language', 'currentTab'));
    }

    /**
     * Show the form for editing the specified translation.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $breadcrumbs = [
            'title' => __('translations.breadcrumbs.edit'),
            'links' => [
                [
                    'text' => __('layouts.sidebar.settings.translations'),
                    'active' => false,
                    'href' => route('translations.index'),
                ],
                [
                    'text' => __('translations.breadcrumbs.edit'),
                    'active' => true,
                ],
            ]
        ];
        $language = Language::findOrFail($id);

        return view('translations.edit', compact('breadcrumbs', 'language'));
    }

    /**
     * Update the specified translation in storage.
     *
     * @param LanguageSaveRequest $request
     * @param int $id
     * @return Response
     */
    public function update(LanguageSaveRequest $request, $id)
    {
        $request->validated();
        Language::findOrFail($id)->update($request->all());

        Session::flash('flash_message', __('translations.flash_messages.updated'));
        return redirect(route('translations.index'));
    }

    /**
     * Remove the specified translation from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        Language::findOrFail($id)->delete();
        Session::flash('flash_message', __('translations.flash_messages.deleted'));
        return redirect(route('translations.index'));
    }

    /**
     * Update locale text for selected language
     *
     * @param Request $request
     * @param $id
     * @return Response
     */
    public function updateLocale(Request $request, $id)
    {
        $language = Language::findOrFail($id);
        $group = $request->get('group');
        $data = $request->get('text');
        foreach ($data as $key => $label) {
            $languageLine = LanguageLine::where('group', $group)
                ->where('key', $key)
                ->first();
            if (!empty($languageLine)) {
                $text = $languageLine->text;
                if (empty($label)) {
                    unset($text[$language->lang_key]);
                } else {
                    $text[$language->lang_key] = $label;
                }
                $languageLine->update(['text' => $text]);
            }
        }

        Session::flash('flash_message', __('translations.flash_messages.locale_updated'));
        return redirect(route('translations.show', [$language, 'tab' => $group]));
    }

    /**
     * Switch primary language to selected
     *
     * @param $id
     * @return Response
     */
    function updatePrimary($id)
    {
        $language = Language::findOrFail($id);

        if (!$language->is_primary) {
            // update old primary language
            $oldLanguages = Language::where('is_primary', true)->get();
            foreach ($oldLanguages as $oldLanguage) {
                $oldLanguage->update(['is_primary' => false]);
            }

            // update new primary language
            $language->update(['is_primary' => true]);
        } else {
            $language->update(['is_primary' => false]);
        }

        Session::flash('flash_message', __('translations.flash_messages.primary_updated'));
        return redirect(route('translations.index'));
    }
}
