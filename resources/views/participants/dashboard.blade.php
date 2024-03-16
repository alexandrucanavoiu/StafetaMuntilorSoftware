@extends('layouts/app-participants')
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
                                        <h1 class="mb-1 text-white">Stafeta Muntilor</h1>
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
                                    <h2 class="fw-bolder">{{ $count_participants }}</h2>
                                    <p class="card-text">Participanti</p>
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
                                    <h2 class="fw-bolder">{{ $count_stages }}</h2>
                                    <p class="card-text">Etape</p>
                                </div>
                            </div>
                        </div>

                    </div>

                    <section id="">
                        <!-- create API key -->
                        <div class="card">
                            <div class="card-header pb-0">
                                <h4 class="card-title">Etape Stafeta Muntilor</h4>
                            </div>
                            <div class="row">
                                <div class="col-md-8 order-md-0 order-1">
                                    <div class="card-body">
                                        @foreach ($stages as $stage)
                                        <div class="mt-2">
                                            <div class="more-info">
                                                <h6 class="mb-0">{{ $stage->id }}. {{ $stage->name }} - {{ $stage->ong }} </h6>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-md-4 order-md-1 order-0">
                                    <div class="text-center">
                                        <img class="img-fluid text-center" src="/app-assets/images/illustration/pricing-Illustration.svg" alt="illustration" width="310">
                                    </div>
                                </div>
                            </div>
                        </div>
    
                        <!-- api key list -->
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text">
                                    Ștafeta Munților este competiția de turism sportiv, organizată la nivel national sau international ce are drept scop crearea cadrului organizatoric si competitional in vederea dezvoltarii unor relatii durabile, in baza principiilor eco-turistice-sportive si mediu protective, intre ONG-urile de tineret, turism, sport si ecologie.
                                </p>
                                <p class="card-text">
                                    Stafeta Muntilor este o competitie specializata, al carei clasament general este alcatuit exclusiv din probe ce pot fi cuantificate obiectiv si in cadrul careia concurentii au posibilitatea sa participe la categoria corespunzatoare varstei si nivelului de pregatire. 
                                </p>
                            </div>
                        </div>
                    </section>

                </section>
            </div>
        </div>
    </div>
@endsection