<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" href="/"><span class="brand-logo">
                            </span>
                        <h2 class="brand-text">Stafeta Muntilor</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ \App\Helpers\Navigation::isActiveRoute(['participants.dashboard']) }} nav-item"><a class="d-flex align-items-center" href="{{ route('participants.dashboard') }}"><i data-feather="grid"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a></li>
                <li class="{{ \App\Helpers\Navigation::isActiveRoute(['participants.list']) }} nav-item"><a class="d-flex align-items-center" href="{{ route('participants.list') }}"><i data-feather="users"></i><span class="menu-title text-truncate" data-i18n="Toti Participantii">Toti Participantii</span></a></li>
                @foreach (\App\Helpers\Navigation::stages() as $stage)
                <li class="navigation-header"><span data-i18n="Etape">{{ $stage->name}}</span><i data-feather="more-horizontal"></i></li>
                <li class="nav-item @if(Request::path() === 'participants/' . $stage->id . '/list') active @endif"><a class="d-flex align-items-center" href="{{ route('participants.stages.list', $stage->id) }}"><i data-feather="user-plus"></i><span class="menu-title text-truncate" data-i18n="Participanti">Participanti</span></a></li>
                @endforeach
                <li class="navigation-header"><span data-i18n="Clasamente">Clasamente</span><i data-feather="more-horizontal"></i></li>
                <li class="nav-item {{ \App\Helpers\Navigation::isActiveRoute(['participants.rankingcumulatclubs']) }}"><a class="d-flex align-items-center" href="{{ route('participants.rankingcumulatclubs') }}"><i data-feather="bar-chart-2"></i><span class="menu-title text-truncate" data-i18n="Etape">Cumulat Cluburi</span></a></li>
                <li class="nav-item {{ \App\Helpers\Navigation::isActiveRoute(['participants.rankingcumulatparticipants']) }}"><a class="d-flex align-items-center" href="{{ route('participants.rankingcumulatparticipants') }}"><i data-feather="bar-chart"></i><span class="menu-title text-truncate" data-i18n="Etape">Individual</span></a></li>
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('stages') }}"><i data-feather="corner-up-left"></i><span class="menu-title text-truncate" data-i18n="Etape">Înapoi la Etape</span></a></li>
            </ul>
        </div>
    </div>