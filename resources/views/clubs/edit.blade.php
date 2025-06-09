<div class="modal fade" id="ClubsEdit" tabindex="-1" role="dialog" aria-labelledby="ClubsEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Editare Club - {{ $club->name }}</h4>
                                <ol class="breadcrumb">
                                    Va rugam sa completati toate campurile si sa verificati corectitudinea datelor! <span class="badge rounded-pill badge-light-danger me-1">Nu folositi diacritice!!</span>
                                </ol>
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
                                                        <div class="col-md-2">
                                                            <span>Nume Club: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control name" id="name" type="text" name="name" placeholder="" value="{{ $club->name }}" required>
                                                            <div class="help-block text-danger print-error" id="name-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Numele clubului, exemplu: Asociatia Drumetii Montane</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Organizator de etapa? (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control m-b" id="stage_id" name="stage_id">
                                                                <option value="0">-</option>
                                                                @foreach($stages as $stage)
                                                                <option value="{{ $stage->id }}" {{ $stage->id === $club->stage_id ? 'selected' : '' }}>Etapa {{ $stage->id }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="stage_id-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Organizator de escalada? (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control m-b" id="climbing" name="climbing">
                                                                <option value="0"  {{ $club->climbing === 0 ? 'selected' : '' }}>-</option>
                                                                <option value="1"  {{ $club->climbing === 1 ? 'selected' : '' }}>Da</option>
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="climbing-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--clubs-update btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}" data-id="{{ $club->id }}">Adauga</button>
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