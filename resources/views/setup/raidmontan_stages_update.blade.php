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
                                <div class="text-danger">Se Adauga in functie de CSV: Start punch, PunchX, Finish punch</div>
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
                                                <div class="col-12 stations-list">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span class="station_type_name_pa0">Start</span>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-group mb-2 station_type_insert">
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="start_251" value="{{ $raid_montan_setup_stages->cod_start }}" aria-describedby="basic-addon2" required>
                                                                <span class="input-group-text" id="basic-addon2">cod</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <br />
                                            @elseif($raid_montan_setup_stages->post == 252)
                                            <div class="row">
                                                <div class="col-12 stations-list">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span class="station_type_name_pa0">Finish</span>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-group mb-2 station_type_insert">
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="finish_252" value="{{ $raid_montan_setup_stages->cod_start }}" aria-describedby="basic-addon2" required>
                                                                <span class="input-group-text" id="basic-addon2">cod</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <div class="col-12 stations-list">
                                                    <div class="form-group row">
                                                        <div class="col-md-2">
                                                            <span class="station_type_name_pa0">PA {{ $number_stage }} </span>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-group mb-2 station_type_insert">
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="post[{{ $number_stage }}][arrived]" value="{{ $raid_montan_setup_stages->cod_start }}" aria-describedby="basic-addon2" required>
                                                                <span class="input-group-text" id="basic-addon2">cod</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="input-group mb-2 station_type_insert">
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="post[{{ $number_stage }}][go]" value="{{ $raid_montan_setup_stages->cod_finish }}" aria-describedby="basic-addon2" required>
                                                                <span class="input-group-text" id="basic-addon2">cod</span>
                                                            </div>
                                                        </div>
                                                        <div class="col-2">
                                                            <div class="form-group mb-2">
                                                                <label class="form-label">Pauza</label>
                                                                <div class="input-group">
                                                                    <input type="text" class="form-control" placeholder="" name="post[{{ $number_stage }}][time]" value="{{ $raid_montan_setup_stages->time }}" required>
                                                                    <span class="input-group-text">minute</span>
                                                                </div>
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