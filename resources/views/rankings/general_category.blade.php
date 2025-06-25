@extends('layouts/app')
@section('title') Stafeta Muntilor - Clasament - General {{ $category->name }} @endsection
@section('content')
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-header row"></div>
                <div class="content-body">
            <section id="auto-layout-columns" class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body">
                                    <a href="{{ route('rankings.index_category', [$stageid, $category->id]) }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='corner-up-left'></i> Inapoi</a>
                                    <a href="{{ route('rankings.category.general_pdf', [$stageid, $category->id]) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Clasament - General - Categoria {{ $category->name }}</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">Loc</th>
                                                <th width="30%">Nume Echipa</th>
                                                <th width="10%" class="text-center">Raid Montan</th>
                                                <th width="10%" class="text-center">Orientare</th>
                                                <th width="10%" class="text-center">Cunostinte Turistice</th>
                                                @if($stage_with_climb == 1)
                                                <th width="10%" class="text-center">Alpinism</th>
                                                @endif
                                                <th width="10%" class="text-center">Total</th>
                                                <th width="10%" class="text-center">Punctaj Stafeta Muntilor</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($ranking_general as $rank)
                                            <tr>
                                                <td class="text-center">{{ $rank['rank'] }}</td>
                                                <td>{{ $rank['name'] }}</td>
                                                <td class="text-center">{{ $rank['scor_raidmontan'] }}</td>
                                                <td class="text-center">{{ $rank['scor_orienteering'] }}</td>
                                                <td class="text-center">{{ $rank['scor_knowledge'] }}</td>
                                                @if($stage_with_climb == 1)
                                                <td class="text-center">{{ $rank['scor_climb'] }}</td>
                                                @endif
                                                <td class="text-center">{{ $rank['scor_total'] }}</td>
                                                <td class="text-center">{{ $rank['scor_stafeta'] }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br />
                                    <br />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@endsection