@extends('layouts/app')
@section('title') Stafeta Muntilor @endsection
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
                                    <button class="btn btn-outline-primary waves-effect waves-light js--teams-create" data-stageid="{{ $stageid }}" data-toggle="modal"  data-target="#ClubsCreate"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-25"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Adauga o echipa noua</span></button>
                                    <a href="{{ route('teams.order.start', [$stageid]) }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='list'></i> Ordine Start Echipe</a>
                                    <a href="{{ route('import.index', [$stageid]) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='upload'></i> Import file</a>
                                    <a href="{{ route('teams.listbyteams_pdf', [$stageid]) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lista Echipa, Categorie si CHIPNO importate din CSV</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text">Verifica mai jos daca ai erori de import, vezi Legenda/Descriere Culori pentru detalii.</p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th>Nume Echipa</th>
                                            <th>Chipno</th>
                                            <th>Categorie</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teams_with_issue as $team_category)
                                            @foreach($team_category as $team)
                                        <tr class="table-danger">
                                            <td>{{ $team['name'] }}</td>
                                            <td>{{ $team['chipno'] }}</td>
                                            <td>{{ $team['category_name'] }}</td>
                                        </tr>
                                            @endforeach
                                        @endforeach

                                        @foreach($teams_exists as $team_category)
                                            @foreach($team_category as $team)
                                        <tr class="table-success">
                                            <td>{{ $team['name'] }}</td>
                                            <td>{{ $team['chipno'] }}</td>
                                            <td>{{ $team['category_name'] }}</td>
                                        </tr>
                                            @endforeach
                                        @endforeach

                                    </tbody>
                                </table>
                                <br /><br /><br />
                            </div>
                        </div>
                    </div>
                </div>

            </div>


            <div class="row match-height">
                    <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div><strong>Legenda</strong></div>
                                    <br />
                                    <p><strong>Nume Echipa</strong> - numele echipei (clubului)</p>
                                    <p><strong>Chipno</strong> - numaruld e chip</p>
                                    <p><strong>Categorie</strong> - categoria echipei</p>
                                    </div>
                                </div>
                    </div>
                    <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div><strong>Descriere Culori</strong></div>
                                    <br />
                                    <p><span class="badge rounded-pill badge-light-success me-1">VERDE</span> - In urma importului, echipa a fost identificata si actualizata in baza de date cu CHIPNO.</p>
                                    <p><span class="badge rounded-pill badge-light-warning me-1">GALBEN</span> - Echipa nu a fost actualizata cu CHIPNO, deoarece categoria din fisier nu corespunde cu cea din baza de date.</p>
                                    <p><span class="badge rounded-pill badge-light-danger me-1">ROSU</span> - Echipa din fisierul importat nu se regaseste in baza de date pentru aceasta etapa. Este posibil ca numele echipei sau categoria din fisier sa fie gresite.</p>
                                    </div>
                                </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection