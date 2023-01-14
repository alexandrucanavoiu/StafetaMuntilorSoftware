@extends('layouts/template')

@section('body')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
LISTA START ECHIPE
                </h1>
                <a target="_blank" class="center-right btn btn-primary btn-sm" href="/order-start/pdf">EXPORT TO PDF</a>
            </div>


            <div class="col-lg-12">
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
                    @foreach($results as $result)
                    <tr>
                        <td width="3%">{{ $number++ }}</td>
                        <td width="10%">{{ $data_start->addMinutes($minute_start)->format('h:i:s') }}</td>
                        <td>{{ $result['category'] }}</td>
                        <td>{{ $result['club'] }}</td>
                        <td>{{ $result['team'] }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>


        </div>
    </div>
@endsection