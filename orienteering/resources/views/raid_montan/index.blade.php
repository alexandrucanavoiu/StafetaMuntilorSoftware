@extends('layouts/template')

@section('body')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
                    Import TIMP pentru RAID MONTAN
                </h1>
            </div>

            @if($teams !== $participations)

                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div>Numarul de echipe nu corespunde cu numarul echipelor care au datele completate la proba de raid, de aceea trebuie sa inserati date provizorii pentru ca importul sa functioneze</div>
                            <p>Automat prin apasarea butonului COMPLETARE DATE RAID MONTAN, toate echipele vor fi configurate cu abandon!! Daca aveati deja date introduse manual la Raid, acestea vor fi sterse!:</p>
                            <p>Dupa ce ati apasat butonul COMPLETARE DATE RAID MONTAN, aceasta sectiune nu va mai aparea si veti puteti importa fisierul TEXT generat cu ajutorul programului Ultra Orienteering</p>                            <div class="table-responsive">
                                <form action="/import-raid-montan/seed/insert" class="form-horizontal" method="post">
                                    {{ csrf_field() }}
                                    <button class="btn btn-primary btn-sm">Completare Date RAID MONTAN</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($teams == $participations)

                <div class="col-md-4 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Upload UUID Cards from xls, xlsx, cvs
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <form action="/import-raid-montan/xls" class="form-horizontal" method="post" enctype="multipart/form-data">
                                    {{ csrf_field() }}
                                    <div><input type="file" name="import_file" /></div>
                                    <button class="btn btn-primary btn-sm">Import File</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            @endif


        </div>
    </div>
@endsection