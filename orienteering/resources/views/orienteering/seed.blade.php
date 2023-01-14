@extends('layouts/template')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
                    Inserare date fake pentru Orientare
                </h1>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        xx
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="/import-orienteering/seed/insert" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <button class="btn btn-primary btn-sm">SEED DATA</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection