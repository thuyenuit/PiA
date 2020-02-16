@extends('layouts.app')
@section('content')
    @include('layouts._breadcrumbs')

    <div class="page-content">
        <div class="card">
            <div class="card-body">
                <div class="alert alert-danger">
                    @lang('translations.show.warning')
                </div>

                <ul class="nav nav-tabs customtab">
                    @foreach(config('constants.LOCALE_TABS') as $tab)
                        <li class="nav-item">
                            <a class="nav-link {{ $currentTab == $tab ? 'active' : '' }}"
                               href="{{ route('translations.show', [$language, 'tab' => $tab]) }}">
                                @lang('translations.tabs.' . $tab)
                            </a>
                        </li>
                    @endforeach
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active pt-2">
                        {!! Form::open(['method' => 'POST', 'url' => route('translations.locale', $language)]) !!}
                        {!! Form::hidden('group', $currentTab) !!}
                        <div class="form-material row">
                            @foreach(CommonHelper::arrayKeysFlatten(__($currentTab), null) as $key)
                                <div class="form-group col-md-6 m-t-20">
                                    <label class="form-control-label">
                                        {{ $key }}
                                    </label>
                                    {!! Form::text("text[$key]", CommonHelper::getTranslation($currentTab, $key, $language->lang_key),
                                        ['class' => 'form-control', 'placeholder' => CommonHelper::getTranslation($currentTab, $key, 'en')]) !!}
                                </div>
                            @endforeach
                        </div>
                        {!! Form::submit(__('layouts.buttons.update'), ['class' => 'btn btn-success']) !!}
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
