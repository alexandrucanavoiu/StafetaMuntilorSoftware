<div class="modal fade" id="CulturalEdit" tabindex="-1" role="dialog" aria-labelledby="CulturalEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Club - {{ $club->name }}</h4>
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
                                                    <div class="form-group row scor-list">
                                                        <div class="col-md-2">
                                                            <span>Punctaj Cultural: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control scor" id="scor" type="text" name="scor" placeholder="" required>
                                                            <div class="help-block text-danger print-error" id="scor-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">exemplu: 50</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--cultural-create btn btn-success mr-1 mb-1" data-id="{{ $club->id }}">Adauga</button>
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