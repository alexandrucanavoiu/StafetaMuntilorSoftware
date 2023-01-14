@extends('layouts/template')

@section('body')
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
Import TIMP pentru ORIENTARE
                </h1>
            </div>

            @if($teams !== $orienteering)

            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div>Numarul de echipe nu corespunde cu numarul echipelor care au datele completate la proba de orientare, de aceea trebuie sa inserati date provizorii pentru ca importul sa functioneze</div>
                            <p>Automat prin apasarea butonului COMPLETARE DATE ORIENTARE, toate echipele la care nu au fost completate datele vor avea date default sub forma:</p>
                            <p>Nume Participant: - / Start: 00:00:00 / Finish: 00:00:00 / Total: 00:00:00 / Abandon: DA</p>
                        <p>Dupa ce ati apasat butonul COMPLETARE DATE ORIENTARE si tabela ORIENTARE a fost populata, aceasta sectiune nu va mai aparea si puteti importa linistiti fisierul TEXT generat cu ajutorul programului Ultra Orienteering</p>
                        <div class="table-responsive">
                            <form action="/import-orienteering/seed/insert" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <button class="btn btn-primary btn-sm">Completare Date Orientare</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            @if($teams == $orienteering)

            <div class="col-md-4 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Upload UUID Cards from xls, xlsx, cvs
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <form action="/import-orienteering/xls" class="form-horizontal" method="post" enctype="multipart/form-data">
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