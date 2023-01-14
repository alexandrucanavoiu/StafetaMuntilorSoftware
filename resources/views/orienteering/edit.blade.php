<div class="modal fade" id="OrienteeringEdit" tabindex="-1" role="dialog" aria-labelledby="OrienteeringEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Echipa {{ $team->name }} - Orientare Turistica</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                <p class="card-text"><strong>Categoria:</strong> {{ $category->name }}</p>
                                <p class="card-text"><strong>Club:</strong> {{ $team->club->name }}</p>
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <span>Există erori la validarea formularului!</span>
                                    </div>
                                    <div class="help-block text-danger print-error" id="form_corruption-error" style="display:none"><ul role="alert"></ul></div>
                                    <div class="help-block text-danger print-error" id="start_finish_time-error" style="display:none"><ul role="alert"></ul></div>
                                    <br />
                                    <form>
                                        @csrf
                                        <div class="form-body">
                                            <div class="row">

                                                <div class="col-12">
                                                    <div class="form-group row start_time-list">
                                                        <div class="col-md-4">
                                                            <span>Start Time: </span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control start_time" id="start_time" type="text" name="start_time" placeholder="introduceti timpul in formatul: hh:mm:ss" value="{{ $orienteering_result['start_time'] }}" required>
                                                            <div class="help-block text-danger print-error" id="start_time-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">exemplu: 00:00:00</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row finish_time-list">
                                                        <div class="col-md-4">
                                                            <span>Finish Time: </span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control finish_time" id="finish_time" type="text" name="finish_time" placeholder="introduceti timpul in formatul: hh:mm:ss" value="{{ $orienteering_result['finish_time'] }}" required>
                                                            <div class="help-block text-danger print-error" id="finish_time-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">exemplu: 00:11:20</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row missed_posts-list">
                                                        <div class="col-md-4">
                                                            <span>Posturi Lipsa: </span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control missed_posts" id="missed_posts" type="text" name="missed_posts" placeholder="" value="{{ $orienteering_result['missed_posts'] }}" required>
                                                            <div class="help-block text-danger print-error" id="missed_posts-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">exemplu: 10, 30.</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Status (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control m-b" id="abandon" name="abandon">
                                                                <option value="0" {{ $orienteering_result['abandon'] === 0 ? 'selected' : '' }}>Ok</option>
                                                                <option value="1" {{ $orienteering_result['abandon'] === 1 ? 'selected' : '' }}>Abandon</option>
                                                                <option value="2" {{ $orienteering_result['abandon'] === 2 ? 'selected' : '' }}>Descalificata</option>
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="abandon-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                        <div><strong>Legenda</strong></div>
                                                            <div><strong>Start Time:</strong> 00:03:05 unde 00 (ore), 03 (minute), 05 (secunde).</div>
                                                            <br />
                                                            <div><strong>Finish Time:</strong> 00:11:05 unde 00 (ore), 11 (minute), 05 (secunde).</div>
                                                            <br />
                                                            <div><strong>Posturi Lipsa:</strong> care sunt posturile ratate. Exemplu: 10, 40. Daca nu exista posturi ratate/lipsa nu se completeaza.</div>
                                                            <br />
                                                            <div><strong>Ok / Abandon / Descalificare:</strong> se va selecta Abandon doar daca echipa a abandonat / se va selecta Descalificare daca echipa a fost descalificata / se va selecta Ok daca echipa a participat si puncteaza sau are posturi lipsa.</div>
                                                            <br />
                                                            <div>Atunci cand este Abandon/Descalificare este important sa adaugati 00:00:00 la timp, Posturi Lipsa se lasa necompletat, dupa care se va bifa : Abandon sau Descalificare dupa caz.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--orienteering-update btn btn-success mr-1 mb-1" data-categoryid="{{ $category->id }}" data-teamid="{{ $team->id }}">Adauga</button>
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
<script>
$(document).ready(function() {
            $("#start_time").inputmask("99:99:99",{ "placeholder": "0" });
});
$(document).ready(function() {
            $("#finish_time").inputmask("99:99:99",{ "placeholder": "0" });
});
</script>