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
                                    <a href="{{ route('participants.rankingcumulatparticipants.pdf') }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Clasament Individual - Stafeta Muntilor</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">Loc</th>
                                                <th width="30%">Nume</th>
                                                <th width="30%">Club</th>
                                                @foreach ($stages as $stage)
                                                <th width="10%" class="text-center">Categ. Et. {{ $stage->id }}</th>
                                                <th width="10%" class="text-center">Etapa {{ $stage->id }}</th>
                                                @endforeach
                                                <th width="5%" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rankingsparticipantsStats as $key => $rank)
                                            <tr>
                                                <td class="text-center">{{ $rank['rank'] }}</td>
                                                <td>{{ $rank['name'] }}</td>
                                                <td>
                                                    @foreach ($rank['club'] as $club)
                                                        <div>{{ $club }}</div>
                                                    @endforeach
                                                </td>
                                                @foreach ($stages as $key => $stage)
                                                        @if(!empty($rank['stages'][$stage->id]))
                                                        <td class="text-center">{{ $rank['stages'][$stage->id]->category_name }}</td>
                                                        <td class="text-center">{{ $rank['stages'][$stage->id]->scor }}</td>
                                                        @else
                                                        <td class="text-center">X</td>
                                                        <td class="text-center">0</td>
                                                        @endif
                                                @endforeach
                                                <td class="text-center">{{ $rank['total_score'] }}</td>
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