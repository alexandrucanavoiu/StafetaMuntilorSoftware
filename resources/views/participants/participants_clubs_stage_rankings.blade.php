@extends('layouts/app-participants')
@section('title', 'Stafeta Muntilor - Clasament General Cumulat')
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
                                        <a href="{{ route('participants.rankingcumulatclubs.pdf') }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                </section>

                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Clasament General Cumulat - Stafeta Muntilor</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">Loc</th>
                                                <th width="30%">Nume Club</th>
                                                @foreach ($stages as $stage)
                                                <th width="10%" class="text-center">Etapa {{ $stage->id }}</th>
                                                @endforeach
                                                <th width="5%" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rankings as $key => $rank)
                                            <tr>
                                                <td class="text-center">{{ $rank['rank'] }}</td>
                                                <td>{{ $rank['name'] }}</td>
                                                @foreach ($rank['stages'] as $key => $stage)
                                                <td class="text-center">{{ $stage }}</td>
                                                @endforeach
                                                <td class="text-center">{{ $rank['total'] }}</td>
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


                    @foreach($categories as $category)
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Clasament General Cumulat Categoria {{ $category->name }} - Stafeta Muntilor</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">Loc</th>
                                                <th width="30%">Nume Club</th>
                                                @foreach ($stages as $stage)
                                                <th width="10%" class="text-center">Etapa {{ $stage->id }}</th>
                                                @endforeach
                                                <th width="5%" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($clubsstagecategoryrankings_rankings[$category->id] as $key => $rank)
                                                @if($rank['total'] !== 0)
                                                <tr>
                                                    <td class="text-center">{{ $rank['rank'] }}</td>
                                                    <td class="text-center">{{ $rank['club_name'] }}</td>
                                                    @foreach ($stages as $stage)
                                                    <th width="10%" class="text-center">{{ $rank['stage_' . $stage->id] }}</th>
                                                    @endforeach
                                                    <td class="text-center">{{ $rank['total'] }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br />
                                    <br />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach

       
            </div>
        </div>
</div>
@endsection