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
            <div class="row" id="table-bordered">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Lista Participanti</h4>
                        </div>
                        <div class="card-body">
                            <div class="card-datatable table-responsive pt-0">
                                <table id="participants-stages-list" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th width="5%" class="text-center">ID</th>
                                            <th width="30%" class="text-center">NAME</th>
                                            <th width="30%" class="text-center">CLUB</th>
                                            <th width="10%" class="text-center">CATEGORY</th>
                                            <th width="10%" class="text-center">PARTICIPANTS</th>
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

    var table = $('#participants-stages-list').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: "/participants/"+ {{ $stage_id }} + "/list/datatables",
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
        "order": [[0, 'desc' ]],
        "columnDefs": [
            {className: "text-center", "targets": [0, 3, 4, 5]}
        ],

        columns: [{
            data: 'id',
            name: 'id',
            searchable: false,
            sortable: false
        }, {
            data: 'name',
            name: 'name',
            searchable: true,
            sortable: false
        }, {
            data: 'club',
            name: 'club',
            searchable: true,
            sortable: false
        }, {
            data: 'category',
            name: 'category',
            searchable: true,
            sortable: false
        }, {
            data: 'participants',
            name: 'participants',
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
