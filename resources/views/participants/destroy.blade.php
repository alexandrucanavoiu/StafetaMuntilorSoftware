<div class="modal fade" id="ParticipantsDestroy" tabindex="-1" role="dialog" aria-labelledby="ParticipantsDestroy" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Stergere participant</h4>
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
                                                    <div class="form-group row ci-list">
                                                        <div class="col-md-4">
                                                            <span>CI: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control cnp" id="ci" type="text" name="ci" placeholder="" value="{{ $participant->ci }}" disabled>
                                                            <div class="help-block text-danger print-error" id="ci-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row phone-list">
                                                        <div class="col-md-4">
                                                            <span>Telefon: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control cnp" id="ci" type="text" name="phone" placeholder="" value="{{ $participant->phone }}" disabled>
                                                            <div class="help-block text-danger print-error" id="phone-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row name-list">
                                                        <div class="col-md-4">
                                                            <span>NUME PARTICIPANT: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control name" id="name" type="text" name="name" placeholder="" value="{{ $participant->name }}" disabled>
                                                            <div class="help-block text-danger print-error" id="name-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--participants-destroy-confirm btn btn-danger mr-1 mb-1" data-id="{{ $participant->id }}">Destroy</button>
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