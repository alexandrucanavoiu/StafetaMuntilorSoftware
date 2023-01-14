@extends('layouts/app')
@section('title') Stafeta Muntilor - Raid Montan @endsection
@section('content')
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row">
            </div>
            <div class="content-body">
            <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Raid Montan - Categoria {{ $category->name }}</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">Nr.</th>
                                            <th width="80%">Nume Echipa</th>
                                            <th width="5%" class="text-center">Status</th>
                                            <th width="10%" class="text-center">Actiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teams as $team)
                                        <tr>
                                            <td class="text-center">{{ $team->number }}</td>
                                            <td>{{ $team->name }}</td>
                                            @if($team->raidmontan_participations !== null)
                                                <td class="text-center">@if($team->raidmontan_participations->missing_footwear == 1) Descalificata @elseif($team->raidmontan_participations->abandon == 0) OK @elseif($team->raidmontan_participations->abandon == 1) Abandon @elseif($team->raidmontan_participations->abandon == 2) Descalificata @else N/A @endif</td>
                                            @else
                                                <td class="text-center">N/A</td>
                                            @endif
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item js--raidmontan-edit" href="#" data-categoryid="{{ $category->id }}" data-teamid="{{ $team->id }}" data-toggle="modal"  data-target="#RaidMontanEdit">
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
                                            <p><strong>Nr.</strong> - Numar participare.</p>
                                            <p><strong>Nume Echipa</strong> - Numele echipei participante</p>
                                            <p><strong>Status</strong> - Ok/Abandon/Descalificata - Completat N/A - Necompletat</p>
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