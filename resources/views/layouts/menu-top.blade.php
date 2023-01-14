<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <strong><i data-feather='layers'></i> {{ \App\Helpers\Navigation::trophy_details()->name_stage }}&nbsp; - &nbsp;</strong>  &nbsp;organizat de catre &nbsp;<strong> {{ \App\Helpers\Navigation::trophy_details()->name_organizer }}</strong> , etapa numarul: &nbsp;<strong>{{ \App\Helpers\Navigation::trophy_details()->stage_number }}</strong>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li class="nav-item dropdown dropdown-language"><a class="nav-link dropdown-toggle" id="dropdown-flag" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-ro"></i><span class="selected-language">Romana</span></a>
                </li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">Stafeta Muntilor</span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="/images/logo.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>