@extends('layouts/app')
@section('title') Stafeta Muntilor - Import Date @endsection
@section('content')
<div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper container-xxl p-0">
            <div class="content-body">
                <section>

                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <p class="card-text text-danger">
                                    Atunci cand importati datele din fisier, datele deja existente vor fi suprascrise. Daca ati facut modificari la o echipa care urmeaza sa o importati automat timpii vor fi suprascrisi. Nu uitati sa bifati la fiecare echipa in parte PFA-urile lipsa dupa ce ati importat datele de pe ceasuri.
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Import date Raid Montan</h4>
                        </div>
                        <div class="card-body">
                            @if($teams !== $participations_raidmontan)

                                <div class="col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div>Numarul de echipe nu corespunde cu numarul echipelor care au datele completate la proba de raid, de aceea trebuie sa inserati date provizorii pentru ca importul sa functioneze</div>
                                            <p>Automat prin apasarea butonului COMPLETARE DATE RAID MONTAN, toate echipele vor fi configurate cu abandon!! Daca aveati deja date introduse manual la Raid, acestea vor fi sterse!:</p>
                                            <p>Dupa ce ati apasat butonul COMPLETARE DATE RAID MONTAN, aceasta sectiune nu va mai aparea si veti puteti importa fisierul TEXT generat cu ajutorul programului Ultra Orienteering</p>                            <div class="table-responsive">
                                                <form action="{{ route('import.raidmontan_seed') }}" class="form-horizontal" method="post">
                                                    {{ csrf_field() }}
                                                    <br />
                                                    <button class="btn btn-primary btn-sm">Completare Date RAID MONTAN</button>
                                                    <br />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($teams == $participations_raidmontan)

                                <div class="col-md-4 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Upload UUID Cards from txt, xls, xlsx, cvs
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <form action="{{ route('import.raidmontan_import_uuids') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <br />
                                                    <div><input type="file" name="import_file" /></div>
                                                    <br />
                                                    <button class="btn btn-primary btn-sm">Import File</button>
                                                    <br />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                </section>

                <section>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Import date Orientare</h4>
                        </div>
                        <div class="card-body">
                            @if($teams !== $participations_orienteering)

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
                                                <form action="{{ route('import.orienteering_seed') }}" class="form-horizontal" method="post">
                                                    {{ csrf_field() }}
                                                    <button class="btn btn-primary btn-sm">Completare Date Orientare</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            @if($teams == $participations_orienteering)

                                <div class="col-md-4 col-md-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Upload UUID Cards from xls, xlsx, cvs
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="table-responsive">
                                                <form action="{{ route('import.orienteering_import_uuids') }}" class="form-horizontal" method="post" enctype="multipart/form-data">
                                                    {{ csrf_field() }}
                                                    <br />
                                                    <div><input type="file" name="import_file" /></div>
                                                    <br />
                                                    <button class="btn btn-primary btn-sm">Import File</button>
                                                    <br />
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            @endif

                        </div>
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection