<div class="modal fade" id="SetupRaidMontanStagesEdit" tabindex="-1" role="dialog" aria-labelledby="SetupRaidMontanStagesEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Configurare Posturi de Control Raid Montan  - <strong>Categoria: {{ $category->name }}</strong></h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <span>Există erori la validarea formularului!</span>
                                    </div>
                                    <div class="help-block text-danger print-error" id="form_corruption-error" style="display:none"><ul role="alert"></ul></div>
                                    <br />
                                    <form>
                                        @csrf
                                        <div class="form-body">
                                        @foreach($raid_montan_setup_stages as $number_stage => $raid_montan_setup_stages)
                                            @if($raid_montan_setup_stages->post == 251)
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row start_time-list">
                                                        <div class="col-md-3">
                                                            <span>Start</span>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input class="form-control" type="text" value="251" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            @elseif($raid_montan_setup_stages->post == 252)
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row start_time-list">
                                                        <div class="col-md-3">
                                                            <span>Finish</span>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input class="form-control" type="text" value="252" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <div class="col-12 stations-list">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span class="station_type_name_pa0">PA {{ $number_stage }} </span>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-group mb-2 station_type_insert">
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="post[]" value="{{ $raid_montan_setup_stages->post }}" aria-describedby="basic-addon2">
                                                                <span class="input-group-text" id="basic-addon2">cod statie</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-group mb-2 station_type_insert">
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="time[]" value="{{ $raid_montan_setup_stages->time }}" aria-describedby="basic-addon2">
                                                                <span class="input-group-text" id="basic-addon2">minute de pauza</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            @endif
                                            @php $number_stage++ @endphp
                                    @endforeach


                                            <br />
                                            <div class="row">
                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--setup-raid-montan-stages-update btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}" data-id="{{ $category->id }}">Adauga</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>