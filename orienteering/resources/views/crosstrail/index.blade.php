@extends('layouts/template')

@section('body')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
Import TIMP pentru CROSS-Trail
                </h1>
            </div>

            <div class="col-xs-6 col-md-4">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload UUID Cards from xls, xlsx, cvs
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="/import-trail-cross/xls" class="form-horizontal" method="post" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div><input type="file" name="import_file" /></div>
                                <button class="btn btn-primary btn-sm">Import File</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection