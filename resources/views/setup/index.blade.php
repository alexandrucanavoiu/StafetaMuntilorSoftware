@extends('layouts/app')
@section('title') Stafeta Muntilor - Configurare @endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
            <div class="content-body">
                <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Stafeta Muntilor - Configurare Etapa</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%" class="text-center"></th>
                                                <th width="30%"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td class="text-center">Nume Etapa</td>
                                                <td class="text-center"><button type="button" class="btn @if(\App\Helpers\Navigation::setup_trophy() == true) btn-success @else btn-secondary @endif waves-effect waves-float waves-light js--trophy-setup" data-toggle="modal"  data-target="#TrophyCreate">Configureaza</button></td>
                                            </tr>
                                            <tr>
                                                <td class="text-center">Ordine Start</td>
                                                <td class="text-center"><button type="button" class="btn @if(\App\Helpers\Navigation::setup_trophy() == true) btn-success @else btn-secondary @endif waves-effect waves-float waves-light js--team-order-start" data-toggle="modal"  data-target="#TeamOrderStart">Configureaza</button></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                </div>
                <div class="row">
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Stafeta Muntilor - Configurare Raid Montan</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%" class="text-center">#</th>
                                                <th width="30%">Categorie</th>
                                                <th width="30%" class="text-center">Traseul de Raid</th>
                                                <th width="30%" class="text-center">Statii pentru Raid</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                            <tr>
                                                <td class="text-center">{{ $category->id }}</td>
                                                <td>Raid Montan - {{ $category->name }}</td>
                                                <td class="text-center"><button type="button" class="btn @if(\App\Helpers\Navigation::setup_raid_montan($category->id) == true) btn-success @else btn-secondary @endif waves-effect waves-float waves-light js--setup-raid-montan-edit" data-id="{{ $category->id }}" data-toggle="modal"  data-target="#SetupRaidMontanEdit">Configureaza</button></td>
                                                <td class="text-center"><button type="button" class="btn @if(\App\Helpers\Navigation::setup_raid_montan_stages($category->id) == true) btn-success @else btn-secondary @endif waves-effect waves-float waves-light js--setup-raid-montan-stages-edit" data-id="{{ $category->id }}" data-toggle="modal"  data-target="#SetupRaidMontanStagesEdit">Configureaza</button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Stafeta Muntilor - Configurare Orientare</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="10%" class="text-center">#</th>
                                                <th width="30%">Categorie</th>
                                                <th width="30%" class="text-center">Statii pentru Orientare</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($categories as $category)
                                            <tr>
                                                <td class="text-center">{{ $category->id }}</td>
                                                <td>Orientare - {{ $category->name }}</td>
                                                <td class="text-center"><button type="button" class="btn @if(\App\Helpers\Navigation::setup_orienteering_stations_stages($category->id) == true) btn-success @else btn-secondary @endif waves-effect waves-float waves-light js--setup-orienteering-stages-edit" data-id="{{ $category->id }}" data-toggle="modal"  data-target="#SetupOrienteeringStagesEdit">Configureaza</button></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <form>
                        @csrf
                        <div class="row" id="table-bordered">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4 class="card-title">Stergere Date</h4></div>
                                    <div class="card-body"><p class="card-text"></p></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="30%">Nume</th>
                                                    <th width="10%" class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Cluburi</td>
                                                    <td class="text-center"><div class="form-check-danger form-check-inline"><input class="form-check-input" type="checkbox" id="delete_clubs" name="delete_clubs" checked></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Echipe</td>
                                                    <td class="text-center"><div class="form-check-danger form-check-inline"><input class="form-check-input" type="checkbox" id="delete_teams" name="delete_teams" checked></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Configurare Raid Montan</td>
                                                    <td class="text-center"><div class="form-check-danger form-check-inline"><input class="form-check-input" type="checkbox" id="delete_config_raid_montan" name="delete_config_raid_montan" checked></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Configurare Orientare</td>
                                                    <td class="text-center"><div class="form-check-danger form-check-inline"><input class="form-check-input" type="checkbox" id="delete_config_orienteering" name="delete_config_orienteering" checked></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Rezultate Proba Raid Montan</td>
                                                    <td class="text-center"><div class="form-check-danger form-check-inline"><input class="form-check-input" type="checkbox" id="delete_rezults_raid_montan" name="delete_rezults_raid_montan" checked></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Rezultate Proba Orientare</td>
                                                    <td class="text-center"><div class="form-check-danger form-check-inline"><input class="form-check-input" type="checkbox" id="delete_rezults_orienteering" name="delete_rezults_orienteering" checked></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Rezultate Proba Teste Teoretice</td>
                                                    <td class="text-center"><div class="form-check-danger form-check-inline"><input class="form-check-input" type="checkbox" id="delete_rezults_knowledge" name="delete_rezults_knowledge" checked></div></td>
                                                </tr>
                                                <tr>
                                                    <td>Rezultate Proba Cultural</td>
                                                    <td class="text-center"><div class="form-check-danger form-check-inline"><input class="form-check-input" type="checkbox" id="delete_rezults_cultural" name="delete_rezults_cultural" checked></div></td>
                                                </tr>
                                            </tbody>
                                            <br />
                                        </table>
                                        <br /><br />
                                        <div class="text-center"><button type="button" class="btn btn-danger waves-effect waves-float waves-light js--setup-clean-up" data-toggle="modal"  data-target="#SetupCleanUp">Sterge</button></div>
                                        <br /><br />
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="row" id="table-bordered">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4 class="card-title">Demo Date</h4></div>
                                    <div class="card-body"><p class="card-text"></p></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="30%">Nume</th>
                                                    <th width="10%" class="text-center"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Demo 31 Cluburi, 103 echipe</td>
                                                    <td class="text-center"><a href="/import-demo-data-1" class="btn btn-info waves-effect waves-float waves-light">Import</a></td>
                                                </tr>
                                                <tr>
                                                    <td>Demo 24 Cluburi, 90 echipe</td>
                                                    <td class="text-center"><a href="/import-demo-data-2" class="btn btn-info waves-effect waves-float waves-light">Import</a></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br />
                                        <div class="text-center">Prin apasarea butonului "Import" toate datele vor fi sterse si inlocuite cu cele demo.</div>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" id="table-bordered">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4 class="card-title">Unix Timestamp</h4></div>
                                    <div class="card-body"><p class="card-text"></p></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td>Unix Timestamp in Date/Time</td>
                                                    <td class="text-center"><button type="button" class="btn btn-success waves-effect waves-float waves-light js--setup-convert-timestamp-datetime" data-toggle="modal"  data-target="#TimestampDateTime">Convertire</button></td>
                                                </tr>
                                                <tr>
                                                    <td>Date/Time in Unix Timestamp</td>
                                                    <td class="text-center"><button type="button" class="btn btn-success waves-effect waves-float waves-light js--setup-convert-datetime-timestamp" data-toggle="modal"  data-target="#DateTimeTimestamp">Convertire</button></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <br />
                                        <div class="text-center">Se utilizeaza in caz de erori pentru statii</div>
                                        <br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection