@extends('layouts/app')
@section('title') Stafeta Muntilor - Clasament - RaidMontan @endsection
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
                                    <a href="{{ route('rankings.category.raidmontan.pdf', [$stageid, $category->id]) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Clasament - Raid Montan - Categoria {{ $category->name }}</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">Loc</th>
                                                <th width="20%">Nume Echipa</th>
                                                <th width="5%" class="text-center">Scor</th>
                                                <th width="10%" class="text-center">Timp Total</th>
                                                <th width="30%" class="text-center">Depunctarea</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rankings as $rank)
                                            <tr>
                                                <td class="text-center">{{ $rank['rank'] }}</td>
                                                <td>{{ $rank['name'] }}</td>
                                                <td class="text-center">{{ $rank['total_score'] }}</td>
                                                <td class="text-center">{{ $rank['total_time'] }}</td>
                                                <td>
                                                @isset($rank['depunctation_status'])
                                                    @foreach ($rank['depunctation_status'] as $depunctation_status)
                                                        <div>{{ $depunctation_status }}</div>
                                                @endforeach
                                                @else
                                                Fara penalizare
                                                @endif
                                                </td>
                                            </tr>
                                            @endforeach
                                            @foreach($teams_list_disqualified as $rank)
                                            <tr>
                                                <td class="text-center">-</td>
                                                <td>{{ $rank['name'] }}</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">Descalificata</td>
                                                <td>Lipsa Bocanci</td>
                                            </tr>
                                            @endforeach
                                            @foreach($teams_list_abandon as $rank)
                                            <tr>
                                                <td class="text-center">-</td>
                                                <td>{{ $rank['name'] }}</td>
                                                <td class="text-center">-</td>
                                                <td class="text-center">Abandon</td>
                                                <td>-</td>
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