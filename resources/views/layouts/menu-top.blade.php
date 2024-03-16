<nav class="header-navbar navbar navbar-expand-lg align-items-center floating-nav navbar-light navbar-shadow container-xxl">
        <div class="navbar-container d-flex content">
            <div class="bookmark-wrapper d-flex align-items-center">
                <strong><i data-feather='layers'></i> {{ \App\Helpers\Navigation::trophy($stageid)->name }}&nbsp; - &nbsp;</strong>  &nbsp;organizat de catre &nbsp;<strong> {{ \App\Helpers\Navigation::trophy($stageid)->ong }}</strong> , etapa numarul: &nbsp;<strong>{{ \App\Helpers\Navigation::trophy($stageid)->id }}</strong>
            </div>
            <ul class="nav navbar-nav align-items-center ms-auto">
                <li>
                    <div class="col-md-12">
                        <select class="form-control m-b" id="switch_stage" name="switch_stage">                            
                            @foreach (\App\Helpers\Navigation::stages() as $stage )
                            <option value="{{ $stage->id}}" {{ $stageid === "$stage->id" ? 'selected' : '' }}>{{ $stage->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </li>
                <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-style"><i class="ficon" data-feather="moon"></i></a></li>
                <li class="nav-item dropdown dropdown-user"><a class="nav-link dropdown-toggle dropdown-user-link" id="dropdown-user" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <div class="user-nav d-sm-flex d-none"><span class="user-name fw-bolder">Stafeta Muntilor</span><span class="user-status">Admin</span></div><span class="avatar"><img class="round" src="/images/logo.jpg" alt="avatar" height="40" width="40"><span class="avatar-status-online"></span></span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>