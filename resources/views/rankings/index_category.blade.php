@extends('layouts/app')
@section('title') Stafeta Muntilor - Clasamente @endsection
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
                                <h4 class="card-title">Clasamente - Categoria {{ $category->name }}</h4>
                            </div>
                            <div class="card-body">
                                <p class="card-text"></p>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th width="40%" class="text-center">PROBA</th>
                                            <th width="20%" class="text-center">CLASAMENT</th>
                                            <th width="20%" class="text-center">PDF</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                                        <tr>
                                            <td>Cunostinte Turistice</td>
                                            <td class="text-center"><a href="{{ route('rankings.category.knowledge', $category->id) }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='award'></i> Vezi Clasament</a></td>
                                            <td class="text-center"><a href="{{ route('rankings.category.knowledge.pdf', $category->id) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a></td>
                                        </tr>
                                        <tr>
                                            <td>Orientare</td>
                                            <td class="text-center"><a href="{{ route('rankings.category.orienteering', $category->id) }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='award'></i> Vezi Clasament</a></td>
                                            <td class="text-center"><a href="{{ route('rankings.category.orienteering.pdf', $category->id) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a></td>
                                        </tr>
                                        <tr>
                                            <td>Raid Montan</td>
                                            <td class="text-center"><a href="{{ route('rankings.category.raidmontan', $category->id) }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='award'></i> Vezi Clasament</a></td>
                                            <td class="text-center"><a href="{{ route('rankings.category.raidmontan.pdf', $category->id) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a></td>
                                        </tr>
                                        <tr>
                                            <td>Clasament General</td>
                                            <td class="text-center"><a href="{{ route('rankings.category.general', $category->id) }}" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='award'></i> Vezi Clasament</a></td>
                                            <td class="text-center"><a href="{{ route('rankings.category.general_pdf', $category->id) }}" target="_blank" class="btn btn-outline-primary waves-effect waves-light"><i data-feather='download'></i> Export Clasament PDF</a></td>
                                        </tr>

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