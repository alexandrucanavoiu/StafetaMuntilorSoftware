@extends('layouts/app')
@section('title') Stafeta Muntilor - Alpinism @endsection
@section('content')
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row"></div>
                <div class="content-body">
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Alpinism - Categoria {{ $category->name }}</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">Nr.</th>
                                                <th width="30%">Nume Echipa</th>
                                                <th width="10%" class="text-center">Metri</th>
                                                <th width="15%" class="text-center">Timp Realizat</th>
                                                <th width="10%" class="text-center">Status</th>
                                                <th width="10%" class="text-center">Actiuni</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($teams as $team)
                                            <tr>
                                                <td class="text-center">{{ $team->number }}</td>
                                                <td>{{ $team->name }}</td>
                                                <td class="text-center">@if($team->climb == null) N/A @else {{ $team->climb->meters }} @endif</td>
                                                <td class="text-center">@if($team->climb == null) N/A @else {{ $team->climb->time }} @endif</td>
                                                <td class="text-center">@if($team->climb == null) N/A @else @if($team->climb->abandon == 0) Ok @elseif($team->climb->abandon == 1) Abandon @else Descalificata @endif @endif</td>
                                                <td class="text-center">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-end">
                                                            <a class="dropdown-item js--climb-edit" href="#" data-stageid="{{ $stageid }}" data-categoryid="{{ $category->id }}" data-teamid="{{ $team->id }}" data-toggle="modal"  data-target="#ClimbEdit">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 me-50"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                                                <span>Edit</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <div class="text-center school-missing @if($teams->count() == 0)show @else hide @endif"><br /><br /><p class="box-title">Momentan nu ati adaugat nicio echipa in baza de date pentru aceasta categorie.</p><br /><br /></div>
                                    <br /><br /><br />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row match-height">
                            <div class="col-lg-6 col-12">
                                        <div class="card">
                                            <div class="card-body">
                                            <div><strong>Legenda</strong></div>
                                            <br />
                                            <p><strong>NR.</strong> - Numar participare.</p>
                                            <p><strong>Nume Echipa</strong> - numele echipei participante</p>
                                            <p><strong>Metri</strong> - numarul de metri escaladati.</p>
                                            <p><strong>Timp Realizat</strong> - timpul realizat</p>
                                            <p><strong>Status</strong> - (Ok - Calificata, Abandon - neprezentare, Descalificare - descalificata)</p>
                                            </div>
                                        </div>
                            </div>
                            <div class="col-lg-6 col-12">
                                        <div class="card">
                                            <div class="card-body">
                                            <div><strong>Actiuni</strong></div>
                                            <br />
                                            <p><span class="badge rounded-pill badge-light-primary me-1">Edit</span> - Editeaza</p>
                                            </div>
                                        </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection