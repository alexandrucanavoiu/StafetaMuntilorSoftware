<div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item me-auto"><a class="navbar-brand" href="/"><span class="brand-logo">
                            <svg viewbox="0 0 139 95" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" height="24">
                                <defs>
                                    <lineargradient id="linearGradient-1" x1="100%" y1="10.5120544%" x2="50%" y2="89.4879456%">
                                        <stop stop-color="#000000" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                    <lineargradient id="linearGradient-2" x1="64.0437835%" y1="46.3276743%" x2="37.373316%" y2="100%">
                                        <stop stop-color="#EEEEEE" stop-opacity="0" offset="0%"></stop>
                                        <stop stop-color="#FFFFFF" offset="100%"></stop>
                                    </lineargradient>
                                </defs>
                                <g id="Page-1" stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <g id="Artboard" transform="translate(-400.000000, -178.000000)">
                                        <g id="Group" transform="translate(400.000000, 178.000000)">
                                            <path class="text-primary" id="Path" d="M-5.68434189e-14,2.84217094e-14 L39.1816085,2.84217094e-14 L69.3453773,32.2519224 L101.428699,2.84217094e-14 L138.784583,2.84217094e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L6.71554594,44.4188507 C2.46876683,39.9813776 0.345377275,35.1089553 0.345377275,29.8015838 C0.345377275,24.4942122 0.230251516,14.560351 -5.68434189e-14,2.84217094e-14 Z" style="fill:currentColor"></path>
                                            <path id="Path1" d="M69.3453773,32.2519224 L101.428699,1.42108547e-14 L138.784583,1.42108547e-14 L138.784199,29.8015838 C137.958931,37.3510206 135.784352,42.5567762 132.260463,45.4188507 C128.736573,48.2809251 112.33867,64.5239941 83.0667527,94.1480575 L56.2750821,94.1480575 L32.8435758,70.5039241 L69.3453773,32.2519224 Z" fill="url(#linearGradient-1)" opacity="0.2"></path>
                                            <polygon id="Path-2" fill="#000000" opacity="0.049999997" points="69.3922914 32.4202615 32.8435758 70.5039241 54.0490008 16.1851325"></polygon>
                                            <polygon id="Path-21" fill="#000000" opacity="0.099999994" points="69.3922914 32.4202615 32.8435758 70.5039241 58.3683556 20.7402338"></polygon>
                                            <polygon id="Path-3" fill="url(#linearGradient-2)" opacity="0.099999994" points="101.428699 0 83.0667527 94.1480575 130.378721 47.0740288"></polygon>
                                        </g>
                                    </g>
                                </g>
                            </svg></span>
                        <h2 class="brand-text">Stafeta Muntilor</h2>
                    </a></li>
                <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
            </ul>
        </div>
        <div class="shadow-bottom"></div>
        <div class="main-menu-content">
            <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
                <li class="{{ \App\Helpers\Navigation::isActiveRoute(['dashboard']) }} nav-item"><a class="d-flex align-items-center" href="{{ route('dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Dashboards">Dashboard</span></a></li>
                <li class="{{ \App\Helpers\Navigation::isActiveRoute(['setup.index']) }} nav-item"><a class="d-flex align-items-center" href="{{ route('setup.index') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Configurare">Configurare</span></a></li>
                <li class="{{ \App\Helpers\Navigation::isActiveRoute(['clubs.index', 'clubs.clubs.listbyteams']) }} nav-item"><a class="d-flex align-items-center" href="{{ route('clubs.index') }}"><i data-feather='bar-chart-2'></i><span class="menu-title text-truncate" data-i18n="Cluburi">Cluburi</span></a></li>
                <li class="{{ \App\Helpers\Navigation::isActiveRoute(['teams.index', 'teams.order.start', 'import.index']) }} nav-item"><a class="d-flex align-items-center" href="{{ route('teams.index') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Echipe">Echipe</span></a></li>
                <li class=" navigation-header"><span data-i18n="">Cultural</span><i data-feather="more-horizontal"></i></li>
                <li class="{{ \App\Helpers\Navigation::isActiveRoute(['cultural.index']) }} nav-item"><a class="d-flex align-items-center" href="{{ route('cultural.index') }}"><i data-feather="home"></i><span class="menu-title text-truncate" data-i18n="Cultural">Cultural</span></a></li>

                    <li class="navigation-header"><span data-i18n="Categoria Family">Categoria Family</span><i data-feather="more-horizontal"></i></li>
                    <li class="nav-item @if(Request::path() === 'knowledge/1') active @endif"><a class="d-flex align-items-center" href="{{ route('knowledge.index', 1) }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="Cunostinte Turistice">Cunostinte Turistice</span></a></li>
                    <li class="nav-item @if(Request::path() === 'orienteering/1') active @endif"><a class="d-flex align-items-center" href="{{ route('orienteering.index', 1) }}"><i data-feather="compass"></i><span class="menu-title text-truncate" data-i18n="Orientare">Orientare</span></a></li>
                    <li class="nav-item @if(Request::path() === 'raidmontan/1') active @endif"><a class="d-flex align-items-center" href="{{ route('raidmontan.index', 1) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Raid Montan">Raid Montan</span></a></li>
                    <li class="nav-item @if(Request::path() === 'rankings/1' || Request::path() === 'rankings/1/knowledge' || Request::path() === 'rankings/1/orienteering' || Request::path() === 'rankings/1/raidmontan' || Request::path() === 'rankings/1/generalcategory') active  @endif"><a class="d-flex align-items-center" href="{{ route('rankings.index_category', 1) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Clasamente">Clasamente</span></a></li>

                    <li class="navigation-header"><span data-i18n="Categoria Juniori">Categoria Juniori</span><i data-feather="more-horizontal"></i></li>
                    <li class="nav-item @if(Request::path() === 'knowledge/2') active @endif"><a class="d-flex align-items-center" href="{{ route('knowledge.index', 2) }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="Cunostinte Turistice">Cunostinte Turistice</span></a></li>
                    <li class="nav-item @if(Request::path() === 'orienteering/2') active @endif"><a class="d-flex align-items-center" href="{{ route('orienteering.index', 2) }}"><i data-feather="compass"></i><span class="menu-title text-truncate" data-i18n="Orientare">Orientare</span></a></li>
                    <li class="nav-item @if(Request::path() === 'raidmontan/2') active @endif"><a class="d-flex align-items-center" href="{{ route('raidmontan.index', 2) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Raid Montan">Raid Montan</span></a></li>
                    <li class="nav-item @if(Request::path() === 'rankings/2' || Request::path() === 'rankings/2/knowledge' || Request::path() === 'rankings/2/orienteering' || Request::path() === 'rankings/2/raidmontan' || Request::path() === 'rankings/2/generalcategory') active  @endif"><a class="d-flex align-items-center" href="{{ route('rankings.index_category', 2) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Clasamente">Clasamente</span></a></li>

                    <li class="navigation-header"><span data-i18n="Categoria Elite">Categoria Elite</span><i data-feather="more-horizontal"></i></li>
                    <li class="nav-item @if(Request::path() === 'knowledge/3') active @endif"><a class="d-flex align-items-center" href="{{ route('knowledge.index', 3) }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="Cunostinte Turistice">Cunostinte Turistice</span></a></li>
                    <li class="nav-item @if(Request::path() === 'orienteering/3') active @endif"><a class="d-flex align-items-center" href="{{ route('orienteering.index', 3) }}"><i data-feather="compass"></i><span class="menu-title text-truncate" data-i18n="Orientare">Orientare</span></a></li>
                    <li class="nav-item @if(Request::path() === 'raidmontan/3') active @endif"><a class="d-flex align-items-center" href="{{ route('raidmontan.index', 3) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Raid Montan">Raid Montan</span></a></li>
                    <li class="nav-item @if(Request::path() === 'rankings/3' || Request::path() === 'rankings/3/knowledge' || Request::path() === 'rankings/3/orienteering' || Request::path() === 'rankings/3/raidmontan' || Request::path() === 'rankings/3/generalcategory') active  @endif"><a class="d-flex align-items-center" href="{{ route('rankings.index_category', 3) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Clasamente">Clasamente</span></a></li>

                    <li class="navigation-header"><span data-i18n="Categoria Open">Categoria Open</span><i data-feather="more-horizontal"></i></li>
                    <li class="nav-item @if(Request::path() === 'knowledge/4') active @endif"><a class="d-flex align-items-center" href="{{ route('knowledge.index', 4) }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="Cunostinte Turistice">Cunostinte Turistice</span></a></li>
                    <li class="nav-item @if(Request::path() === 'orienteering/4') active @endif"><a class="d-flex align-items-center" href="{{ route('orienteering.index', 4) }}"><i data-feather="compass"></i><span class="menu-title text-truncate" data-i18n="Orientare">Orientare</span></a></li>
                    <li class="nav-item @if(Request::path() === 'raidmontan/4') active @endif"><a class="d-flex align-items-center" href="{{ route('raidmontan.index', 4) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Raid Montan">Raid Montan</span></a></li>
                    <li class="nav-item @if(Request::path() === 'rankings/4' || Request::path() === 'rankings/4/knowledge' || Request::path() === 'rankings/4/orienteering' || Request::path() === 'rankings/4/raidmontan' || Request::path() === 'rankings/4/generalcategory') active  @endif"><a class="d-flex align-items-center" href="{{ route('rankings.index_category', 4) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Clasamente">Clasamente</span></a></li>

                    <li class="navigation-header"><span data-i18n="Categoria Veterani">Categoria Veterani</span><i data-feather="more-horizontal"></i></li>
                    <li class="nav-item @if(Request::path() === 'knowledge/5') active @endif"><a class="d-flex align-items-center" href="{{ route('knowledge.index', 5) }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="Cunostinte Turistice">Cunostinte Turistice</span></a></li>
                    <li class="nav-item @if(Request::path() === 'orienteering/5') active @endif"><a class="d-flex align-items-center" href="{{ route('orienteering.index', 5) }}"><i data-feather="compass"></i><span class="menu-title text-truncate" data-i18n="Orientare">Orientare</span></a></li>
                    <li class="nav-item @if(Request::path() === 'raidmontan/5') active @endif"><a class="d-flex align-items-center" href="{{ route('raidmontan.index', 5) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Raid Montan">Raid Montan</span></a></li>
                    <li class="nav-item @if(Request::path() === 'rankings/5' || Request::path() === 'rankings/5/knowledge' || Request::path() === 'rankings/5/orienteering' || Request::path() === 'rankings/5/raidmontan' || Request::path() === 'rankings/5/generalcategory') active  @endif"><a class="d-flex align-items-center" href="{{ route('rankings.index_category', 5) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Clasamente">Clasamente</span></a></li>


                    <li class="navigation-header"><span data-i18n="Categoria Feminin">Categoria Feminin</span><i data-feather="more-horizontal"></i></li>
                    <li class="nav-item @if(Request::path() === 'knowledge/6') active @endif"><a class="d-flex align-items-center" href="{{ route('knowledge.index', 6) }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="Cunostinte Turistice">Cunostinte Turistice</span></a></li>
                    <li class="nav-item @if(Request::path() === 'orienteering/6') active @endif"><a class="d-flex align-items-center" href="{{ route('orienteering.index', 6) }}"><i data-feather="compass"></i><span class="menu-title text-truncate" data-i18n="Orientare">Orientare</span></a></li>
                    <li class="nav-item @if(Request::path() === 'raidmontan/6') active @endif"><a class="d-flex align-items-center" href="{{ route('raidmontan.index', 6) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Raid Montan">Raid Montan</span></a></li>
                    <li class="nav-item @if(Request::path() === 'rankings/6' || Request::path() === 'rankings/6/knowledge' || Request::path() === 'rankings/6/orienteering' || Request::path() === 'rankings/6/raidmontan' || Request::path() === 'rankings/6/generalcategory') active  @endif"><a class="d-flex align-items-center" href="{{ route('rankings.index_category', 6) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Clasamente">Clasamente</span></a></li>

                    <li class="navigation-header"><span data-i18n="Categoria Seniori">Categoria Seniori</span><i data-feather="more-horizontal"></i></li>
                    <li class="nav-item @if(Request::path() === 'knowledge/7') active @endif"><a class="d-flex align-items-center" href="{{ route('knowledge.index', 7) }}"><i data-feather="book-open"></i><span class="menu-title text-truncate" data-i18n="Cunostinte Turistice">Cunostinte Turistice</span></a></li>
                    <li class="nav-item @if(Request::path() === 'orienteering/7') active @endif"><a class="d-flex align-items-center" href="{{ route('orienteering.index', 7) }}"><i data-feather="compass"></i><span class="menu-title text-truncate" data-i18n="Orientare">Orientare</span></a></li>
                    <li class="nav-item @if(Request::path() === 'raidmontan/7') active @endif"><a class="d-flex align-items-center" href="{{ route('raidmontan.index', 7) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Raid Montan">Raid Montan</span></a></li>
                    <li class="nav-item @if(Request::path() === 'rankings/7' || Request::path() === 'rankings/7/knowledge' || Request::path() === 'rankings/7/orienteering' || Request::path() === 'rankings/7/raidmontan' || Request::path() === 'rankings/7/generalcategory') active  @endif"><a class="d-flex align-items-center" href="{{ route('rankings.index_category', 7) }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Clasamente">Clasamente</span></a></li>


                <li class="navigation-header"><span data-i18n="Clasamente">Clasamente </span><i data-feather="more-horizontal"></i></li>
                <li class="nav-item"><a class="d-flex align-items-center" href="{{ route('rankings.general') }}"><i data-feather="map"></i><span class="menu-title text-truncate" data-i18n="Clasamente">General</span></a></li>
            </ul>
        </div>
    </div>