<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div class="scroll-sidebar">
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav">
            <ul id="sidebarnav">
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('home') }}">
                        <i class="mdi mdi-gauge"></i>
                        <span class="hide-menu">@lang('layouts.sidebar.dashboard')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('clubs.index') }}">
                        <i class="mdi mdi-bank"></i>
                        <span class="hide-menu">@lang('layouts.sidebar.clubs')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('members.index') }}">
                        <i class="mdi mdi-account-multiple"></i>
                        <span class="hide-menu">@lang('layouts.sidebar.members')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('payments.index') }}">
                        <i class="mdi mdi-credit-card"></i>
                        <span class="hide-menu">@lang('layouts.sidebar.payments')</span>
                    </a>
                </li>
                <li>
                    <a class="waves-effect waves-dark" href="{{ route('ratings.index') }}">
                        <i class="mdi mdi-chart-bubble"></i>
                        <span class="hide-menu">@lang('layouts.sidebar.ratings')</span>
                    </a>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="mdi mdi-file-chart"></i>
                        <span class="hide-menu">@lang('layouts.sidebar.statistics.group_name')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{ route('statistics.club') }}">
                                @lang('layouts.sidebar.statistics.club')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistics.member') }}">
                                @lang('layouts.sidebar.statistics.member')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('statistics.payment') }}">
                                @lang('layouts.sidebar.statistics.payment')
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a class="has-arrow waves-effect waves-dark" href="javascript:void(0);" aria-expanded="false">
                        <i class="mdi mdi-settings"></i>
                        <span class="hide-menu">@lang('layouts.sidebar.settings.group_name')</span>
                    </a>
                    <ul aria-expanded="false" class="collapse">
                        <li>
                            <a href="{{ route('app_settings') }}">
                                @lang('layouts.sidebar.settings.logo_icon')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fieldgroups.index') }}">
                                @lang('layouts.sidebar.settings.field_groups')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('fields.index') }}">
                                @lang('layouts.sidebar.settings.fields')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('groups.index') }}">
                                @lang('layouts.sidebar.settings.groups')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('payment_methods') }}">
                                @lang('layouts.sidebar.settings.payment_methods')
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('translations.index') }}">
                                @lang('layouts.sidebar.settings.translations')
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
