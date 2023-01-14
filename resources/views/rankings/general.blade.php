@extends('layouts/app')
@section('title') Stafeta Muntilor - Clasament - General@endsection
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
                                    <a href="{{ route('rankings.general_pdf') }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
            </section>
                    <div class="row" id="table-bordered">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header"><h4 class="card-title">Clasament - General - Stafeta Muntilor</h4></div>
                                <div class="card-body"><p class="card-text"></p></div>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th width="5%" class="text-center">Loc</th>
                                                <th width="30%">Nume Club</th>
                                                <th width="5%" class="text-center">Family</th>
                                                <th width="5%" class="text-center">Junior</th>
                                                <th width="5%" class="text-center">Elite</th>
                                                <th width="5%" class="text-center">Open</th>
                                                <th width="5%" class="text-center">Veterani</th>
                                                <th width="5%" class="text-center">Feminin</th>
                                                <th width="5%" class="text-center">Seniori</th>
                                                <th width="5%" class="text-center">Bonus</th>
                                                <th width="5%" class="text-center">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($rankings as $club_name => $rank)
                                            <tr>
                                                <td class="text-center">{{ $rank['rank'] }}</td>
                                                <td>{{ $rank['club_name'] }}</td>
                                                @php
                                                    $array_categories = array_slice($rank['categories'], 0, 4);
                                                @endphp
                                                @foreach ($categories as $category)
                                                        @if (array_key_exists($category->name, $array_categories))
                                                            <td class="text-center">{{ $rank[$category->name] }}</td>
                                                        @else
                                                            <td class="text-center"><s>{{ $rank[$category->name] }}</s></td>
                                                        @endif
                                               
                                                @endforeach
                                                <td>{{ $rank['bonus'] }}</td>
                                                <td>{{ $rank['total_sm'] }}</td>
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