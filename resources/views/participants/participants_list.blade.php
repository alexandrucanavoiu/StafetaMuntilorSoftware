@extends('layouts/app-participants')
@section('title') Stafeta Muntilor - Lista Participanti @endsection
@section('content')

<div class="app-content content ">
    <div class="content-overlay"></div>
    <div class="header-navbar-shadow"></div>
    <div class="content-wrapper container-xxl  p-0">
        <div class="content-header row">
        </div>
        <div class="content-body">
            <section id="auto-layout-columns" class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <button class="btn btn-outline-primary waves-effect waves-light js--participants-create" data-toggle="modal"  data-target="#ParticipantsCreate"><span><svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-plus me-25"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg> Adauga participant</span></button>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lista Participanti</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-datatable table-responsive pt-0">
                                <table id="participants-list" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">ID</th>
                                            <th width="10%">CI</th>
                                            <th width="10%">TELEFON</th>
                                            <th width="50%" class="text-center">NAME</th>
                                            <th width="10%" class="text-center">ACTIUNI</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>


@endsection
@section('scripts-footer')
<script>
$(function() {

    var table = $('#participants-list').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: "/participants/list/datatables",
        "pageLength": 25,
        "oLanguage":
            {
                "sProcessing":   "Procesează...",
                "sLengthMenu":   "Afișează _MENU_ înregistrări pe pagină",
                "sZeroRecords":  "Nu am găsit nimic - ne pare rău",
                "sInfo":         "Afișate de la _START_ la _END_ din _TOTAL_ înregistrări",
                "sInfoEmpty":    "Afișate de la 0 la 0 din 0 înregistrări",
                "sInfoFiltered": "(filtrate dintr-un total de _MAX_ înregistrări)",
                "sInfoPostFix":  "",
                "sSearch":       "Caută:",
                "sUrl":          "",
                "oPaginate": {
                    "sFirst":    "Prima",
                    "sPrevious": "Precedentă",
                    "sNext":     "Următoarea",
                    "sLast":     "Ultima"
                }
            },
        "order": [[ 0, 'desc' ]],
        "columnDefs": [
            {className: "text-center", "targets": [0, 1, 3]}
        ],

        columns: [{
            data: 'id',
            name: 'id',
            searchable: false,
            sortable: false
        }, {
            data: 'ci',
            name: 'ci',
            searchable: true,
            sortable: false,
        }, {
            data: 'phone',
            name: 'phone',
            searchable: true,
            sortable: false,
        }, {
            data: 'name',
            name: 'name',
            searchable: true,
            sortable: false
        }, {
            data: 'actions',
            name: 'actions',
            orderable: false,
            searchable: false
        }]
    });

});
</script>
@endsection
