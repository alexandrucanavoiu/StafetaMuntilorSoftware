@extends('layouts/app')
@section('title') Stafeta Muntilor - Echipe @endsection
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
                                    <button class="btn btn-outline-primary waves-effect waves-light js--teams-create" data-toggle="modal"  data-target="#ClubsCreate"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-25"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Adauga o echipa noua</span></button>
                                    <a href="{{ route('teams.order.start') }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='list'></i> Ordine Start Echipe</a>
                                    <a href="{{ route('import.index') }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='upload'></i> Import file</a>
                                    <a href="{{ route('uuids.index') }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='clock'></i> Lista Ceasuri</a>
                                    <a href="{{ route('teams.listbyteams_pdf') }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lista Echipe Participante - Stafeta Muntilor</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">O</th>
                                            <th class="text-center">R</th>
                                            <th>Nume Club</th>
                                            <th>Nume Echipa</th>
                                            <th>Categorie</th>
                                            <th class="text-center">Actiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teams as $team)
                                        <tr>
                                            <td class="text-center">{{ $team->number }}</td>
                                            <td class="text-center">{{ $team->uuid_orienteering->id }}</td>
                                            <td class="text-center">{{ $team->uuid_raid->id }}</td>
                                            <td>{{ $team->club->name }}</td>
                                            <td>{{ $team->name }}</td>
                                            <td>{{ $team->category->name }}</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item js--teams-edit" href="#" data-id="{{ $team->id }}" data-toggle="modal"  data-target="#TeamsEdit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                            <span>Edit</span>
                                                        </a>
                                                        <a class="dropdown-item js--teams-destroy" href="#" data-id="{{ $team->id }}" data-toggle="modal"  data-target="#TeamsDestroy">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash me-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg>
                                                            <span>Delete</span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="text-center school-missing @if($teams->count() == 0)show @else hide @endif"><br /><br /><p class="box-title">Momentan nu ati adaugat nicio echipa in baza de date.</p><br /><br /></div>
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
                                    <p><strong>#</strong> - numarul de participare concurent.</p>
                                    <p><strong>O</strong> - numarul ceasului de orientare (ceas galben).</p>
                                    <p><strong>R</strong> - numarul ceasului de raid (ceas verde).</p>
                                    <p><strong>Nume Club</strong> - numele clubului participant</p>
                                    <p><strong>Nume Echipa</strong> - numele echipei participante</p>
                                    </div>
                                </div>
                    </div>
                    <div class="col-lg-6 col-12">
                                <div class="card">
                                    <div class="card-body">
                                    <div><strong>Actiuni</strong></div>
                                    <br />
                                    <p><span class="badge rounded-pill badge-light-primary me-1">Edit</span> - Editeaza echipa</p>
                                    <p><span class="badge rounded-pill badge-light-success me-1">Delete</span> - Sterge echipa</p>
                                    </div>
                                </div>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection