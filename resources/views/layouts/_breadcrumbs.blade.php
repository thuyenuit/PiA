@if(isset($breadcrumbs) && $breadcrumbs)
    <div class="row page-titles">
        <div class="col-12 align-self-center">
            <h3 class="text-themecolor">{{ $breadcrumbs['title'] }}</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">@lang('layouts.sidebar.dashboard')</a></li>
                @foreach($breadcrumbs['links'] as $link)
                    @if($link['active'])
                        <li class="breadcrumb-item active">{{ $link['text'] }}</li>
                    @else
                        <li class="breadcrumb-item">
                            <a href="{{ $link['href'] }}">{{ $link['text'] }}</a>
                        </li>
                    @endif
                @endforeach
            </ol>
        </div>
    </div>
@endif
