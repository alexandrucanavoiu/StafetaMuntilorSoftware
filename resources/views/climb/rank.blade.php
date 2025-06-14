@extends('layouts/app')
@section('title') Stafeta Muntilor - Alpinism @endsection
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
                                <h4 class="card-title">Clasament - Alpinism - Stafeta Muntilor</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="15%" class="text-center">Loc.</th>
                                            <th width="70%">Nume Club</th>
                                            <th width="10%">Punctaj</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($rank as $r)
                                        <tr>
                                            <td class="text-center">{{ $number++ }}</td>
                                            <td>{{ $r['club'] }}</td>
                                            <td>{{ $r['scor'] }}</td>
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