@extends('layouts/app')
@section('title') Stafeta Muntilor - Lista Start Echipe @endsection
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
                                    <a href="{{ route('teams.index') }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='corner-up-left'></i> Inapoi</a>
                                    <a href="{{ route('teams.order.start.pdf') }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export PDF</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            <div class="row" id="table-bordered">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Lista Start - Stafeta Muntilor</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr>
                                        <th>Nr</th>
                                        <th>Ora Start</th>
                                        <th>Categorie</th>
                                        <th>Club</th>
                                        <th>Echipa</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Nr</th>
                                        <th>Ora Start</th>
                                        <th>Categorie</th>
                                        <th>Club</th>
                                        <th>Echipa</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($results as $key => $result)
                                    <tr>
                                        <td width="3%">{{ $number++ }}</td>
                                        @if($key == 0)
                                        <td width="10%">{{ $data_start->format('h:i:s') }}</td>
                                        @else
                                        <td width="10%">{{ $data_start->addMinutes($minute_start)->format('h:i:s') }}</td>
                                        @endif
                                        <td>{{ $result['category'] }}</td>
                                        <td>{{ $result['club'] }}</td>
                                        <td>{{ $result['team'] }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>

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