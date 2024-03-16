@extends('layouts/app')
@section('title') Stafeta Muntilor - Dashboard @endsection
@section('content')
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
<section id="dashboard-analytics">
                    <div class="row match-height">
                        <!-- Greetings Card starts -->
                        <div class="col-lg-6 col-md-12 col-sm-12">
                            <div class="card card-congratulations">
                                <div class="card-body text-center">
                                    <img src="/app-assets/images/elements/decore-left.png" class="congratulations-img-left" alt="card-img-left">
                                    <img src="/app-assets/images/elements/decore-right.png" class="congratulations-img-right" alt="card-img-right">
                                    <div class="avatar avatar-xl bg-primary shadow">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award font-large-1"><circle cx="12" cy="8" r="7"></circle><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline></svg>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                        <h1 class="mb-1 text-white">{{ \App\Helpers\Navigation::trophy($stageid)->name }}</h1>
                                        <p class="card-text m-auto w-75">
                                            {{ \App\Helpers\Navigation::trophy($stageid)->ong }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Greetings Card ends -->

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="avatar bg-light-info p-50 mb-1">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users font-medium-5"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                        </div>
                                    </div>
                                    <h2 class="fw-bolder">{{ $count_teams }}</h2>
                                    <p class="card-text">Echipe inscrise</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="card text-center">
                                <div class="card-body">
                                    <div class="avatar bg-light-info p-50 mb-1">
                                        <div class="avatar-content">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-package font-medium-5"><line x1="16.5" y1="9.4" x2="7.5" y2="4.21"></line><path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path><polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline><line x1="12" y1="22.08" x2="12" y2="12"></line></svg>
                                        </div>
                                    </div>
                                    <h2 class="fw-bolder">{{ $count_clubs }}</h2>
                                    <p class="card-text">Cluburi inscrise</p>
                                </div>
                            </div>
                        </div>

                    </div>

<div class="row match-height">
                        <!-- Company Table Card -->
                        <div class="col-lg-8 col-12">
                            <div class="card card-company-table">
                                <div class="card-body p-0">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>Nume Document</th>
                                                    <th>Actiune</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Regulament Stafeta Muntilor</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/regulament_stafeta_muntilor_2024.pdf" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Tabel Nominal de participare</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/anexa_1_tabel_nominal_de_participare.doc" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Fisa inscriere echipe</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/anexa_4_fisa_inscriere_echipe.docx" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Fisa proba Cunostinte Turistice</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/anexa_2_fisa_cunostinte_teoretice.doc" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Fisa proba Raid Montan</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/anexa_3_fisa_raid_montan.doc" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Fisa verificare echipament</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/anexa_5_fisa_verificare_echipament.doc" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Post PFA model</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/post_pfa.jpg" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Tabel posturi cu arbitru</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/tabel_cluburi_posturi_cu_arbitru.doc" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Tabel proba escalada</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/tabel_proba_escalada.doc" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <div class="avatar rounded">
                                                                <div class="avatar-content">
                                                                    <img src="/app-assets/images/icons/doc.png" alt="Toolbar svg">
                                                                </div>
                                                            </div>
                                                            <div>
                                                                <div class="fw-bolder">Tabel proba orientare</div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <a target="_blank" href="/download/tabel_proba_orientare.doc" class="btn btn-outline-primary waves-effect">
                                                                <i data-feather='download'></i>
                                                                <span>Descarca</span>
                                                            </a>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ Company Table Card -->

                        <div class="col-lg-4 col-md-6 col-12">
                            <div class="card card-developer-meetup">
                                <div class="meetup-img-wrapper rounded-top text-center">
                                    <img src="/app-assets/images/illustration/email.svg" alt="Meeting Pic" height="170">
                                </div>
                                <div class="card-body">
                                    <div class="meetup-header d-flex align-items-center">
                                        <div class="my-auto">
                                            <h4 class="card-title mb-25">Etape 2024 - Stafeta Muntilor</h4>
                                            <p class="card-text mb-0"></p>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="avatar float-start bg-light-primary rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar avatar-icon font-medium-3"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">Iunie 2024 - Trofeul Jnepenilor </h6>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="avatar float-start bg-light-primary rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar avatar-icon font-medium-3"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">12/14 Iulie 2024 - Trofeul Zimbrilor</h6>
                                        </div>
                                    </div>

                                    <div class="mt-3">
                                        <div class="avatar float-start bg-light-primary rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar avatar-icon font-medium-3"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">19/21 Iulie 2024 - Trofeul Via-Retezat</h6>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="avatar float-start bg-light-primary rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar avatar-icon font-medium-3"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">02/04 August 2024 - Trofeul Muntilor</h6>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="avatar float-start bg-light-primary rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar avatar-icon font-medium-3"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">16/18 August 2024 - Trofeul Hai pe Munte</h6>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <div class="avatar float-start bg-light-primary rounded me-1">
                                            <div class="avatar-content">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar avatar-icon font-medium-3"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                            </div>
                                        </div>
                                        <div class="more-info">
                                            <h6 class="mb-0">30 August/01 Sepembrie 2024 - Trofeul Pro-Parang</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>





                    </div>

                </section>
            </div>
        </div>
    </div>
@endsection