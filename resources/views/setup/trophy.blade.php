<div class="modal fade" id="TrophyCreate" tabindex="-1" role="dialog" aria-labelledby="TrophyCreate" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Configurare Etapa</h4>
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
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="form-group row name-list">
                                                        <div class="col-md-4">
                                                            <span>Numele Etapei: </span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control name" id="name" type="text" name="name" value="{{ $trophy_setup->name }}" placeholder="" required>
                                                            <div class="help-block text-danger print-error" id="name-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Exemplu: Trofeul Stafeta Muntilor</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row ong-list">
                                                        <div class="col-md-4">
                                                            <span>Numele Organizatorului: </span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control ong" id="ong" type="text" name="ong" value="{{ $trophy_setup->ong }}" placeholder="" required>
                                                            <div class="help-block text-danger print-error" id="ong-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Exemplu: Asociatia Stafeta Muntilor</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Numarul Etapei (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control"type="text" value="{{ $trophy_setup->id }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--trophy-setup-update btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}">Actualizeaza</button>
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