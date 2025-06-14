@extends('layouts/app')
@section('title') Stafeta Muntilor - Clasament - Alpinism @endsection
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
                                    <a href="{{ route('rankings.category.climb.pdf', [$stageid, $category->id]) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Clasament - Alpinism - Categoria {{ $category->name }}</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">Loc</th>
                                                <th width="30%">Nume Echipa</th>
                                                <th width="10%" class="text-center">Metri</th>
                                                <th width="15%" class="text-center">Scor</th>
                                                <th width="15%" class="text-center">Timp Realizat</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rankings as $rank)
                                            <tr>
                                                <td class="text-center">{{ $rank['rank'] }}</td>
                                                <td>{{ $rank['name'] }}</td>
                                                <td class="text-center">{{ $rank['meters'] }}</td>
                                                <td class="text-center">{{ $rank['scor'] }}</td>
                                                <td class="text-center">{{ $rank['time'] }}</td>
                                            </tr>
                                            @endforeach
                                            @foreach($teams_list_abandon as $rank)
                                            <tr>
                                                <td class="text-center">-</td>
                                                <td>{{ $rank['name'] }}</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">@if($rank['abandon'] == 1) Abandon @else Descalificata @endif</td>
                                                <td class="text-center">-</td>
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