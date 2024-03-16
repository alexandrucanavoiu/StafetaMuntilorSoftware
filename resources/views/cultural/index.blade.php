@extends('layouts/app')
@section('title') Stafeta Muntilor - Cultural @endsection
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
                                    <a href="{{ route('cultural.rank.pdf', [$stageid]) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
            <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lista Cluburi Participante - Cultural - Stafeta Muntilor</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="15%" class="text-center">Nr.</th>
                                            <th width="70%">Nume Club</th>
                                            <th width="5%">Scor</th>
                                            <th width="10%" class="text-center">Actiuni</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rankings as $rank)
                                        <tr>
                                            <td class="text-center">@if($rank['scor'] == 0) - @else {{ $rank['rank'] }} @endif</td>
                                            <td>{{ $rank['name'] }}</td>
                                            <td>@if(isset($rank['scor'])) {{ $rank['scor'] }} @else N/A @endif</td>
                                            <td class="text-center">
                                                <div class="dropdown">
                                                    <button type="button" class="btn btn-sm dropdown-toggle hide-arrow py-0 waves-effect waves-float waves-light" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-end">
                                                        <a class="dropdown-item js--cultural-edit" href="#" data-stageid="{{ $stageid }}" data-id="{{ $rank['id'] }}" data-toggle="modal"  data-target="#CulturalEdit">
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
                                <div class="text-center school-missing @if(count($rankings) == 0)show @else hide @endif"><br /><br /><p class="box-title">Momentan nu ati adaugat nici un club in baza de date.</p><br /><br /></div>
                                <br /><br /><br />
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection