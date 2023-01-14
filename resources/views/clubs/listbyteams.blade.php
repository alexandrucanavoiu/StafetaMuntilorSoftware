@extends('layouts/app')
@section('title') Stafeta Muntilor - Lista Cluburi in functie de echipe @endsection
@section('content')
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
            <section id="auto-layout-columns" class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <a href="{{ route('clubs.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='corner-up-left'></i> Inapoi</a>
                                    <a href="{{ route('clubs.clubs.listbyteams_pdf') }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lista Cluburi in functie de echipe - Stafeta Muntilor</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="15%" class="text-center">Nr. Curent</th>
                                            <th width="75%">Nume Club</th>
                                            <th width="10%" class="text-center">Echipe Inscrise</th>
                                            <th width="10%" class="text-center">Echipe Family</th>
                                            <th width="10%" class="text-center">Echipe Juniori</th>
                                            <th width="10%" class="text-center">Echipe Elite</th>
                                            <th width="10%" class="text-center">Echipe Open</th>
                                            <th width="10%" class="text-center">Echipe Veterani</th>
                                            <th width="10%" class="text-center">Echipe Feminin</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($club_list as $club)
                                        <tr>
                                            <td class="text-center">{{ $number++ }}</td>
                                            <td>{{ $club['club_name'] }}</td>
                                            <td class="text-center">{{ $club['total'] }}</td>
                                            <td class="text-center">{{ $club['Family'] }}</td>
                                            <td class="text-center">{{ $club['Juniori'] }}</td>
                                            <td class="text-center">{{ $club['Elite'] }}</td>
                                            <td class="text-center">{{ $club['Open'] }}</td>
                                            <td class="text-center">{{ $club['Veterani'] }}</td>
                                            <td class="text-center">{{ $club['Feminin'] }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection