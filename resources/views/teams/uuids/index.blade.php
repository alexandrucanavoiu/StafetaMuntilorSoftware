@extends('layouts/app')
@section('title') Stafeta Muntilor - Configurare @endsection
@section('content')
<div class="app-content content">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl p-0">
        <div class="content-header row"></div>
            <div class="content-body">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="row" id="table-bordered">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4 class="card-title">Ceasuri Raid Montan</h4></div>
                                    <div class="card-body"><p class="card-text"></p></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th width="50%" class="text-center">NR</th>
                                                    <th width="50%" class="text-center">UUID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($uuid_raidmontan as $raid)
                                                <tr>
                                                    <td class="text-center">{{ $raid->id }}</td>
                                                    <td class="text-center">{{ $raid->name }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <br />
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6 col-12">
                        <div class="row" id="table-bordered">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header"><h4 class="card-title">Ceasuri Orientare</h4></div>
                                    <div class="card-body"><p class="card-text"></p></div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                <th width="50%" class="text-center">NR</th>
                                                    <th width="50%" class="text-center">UUID</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($uuid_orienteering as $orienteering)
                                                <tr>
                                                    <td class="text-center">{{ $orienteering->id }}</td>
                                                    <td class="text-center">{{ $orienteering->name }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <br />
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection