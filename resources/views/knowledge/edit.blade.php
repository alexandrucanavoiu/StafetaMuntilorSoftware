<div class="modal fade" id="KnowledgeEdit" tabindex="-1" role="dialog" aria-labelledby="KnowledgeEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Echipa {{ $team->name }} - Cunostinte Turistice</h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                <p class="card-text"><strong>Categoria:</strong> {{ $category->name }}</p>
                                <p class="card-text"><strong>Club:</strong> {{ $team->club->name }}</p>
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
                                                    <div class="form-group row time-list">
                                                        <div class="col-md-4">
                                                            <span>Timp Realizat: </span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control time" id="time" type="text" name="time" placeholder="introduceti timpul in formatul: hh:mm:ss" value="{{ $knowledge_result['time'] }}" required>
                                                            <div class="help-block text-danger print-error" id="time-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">exemplu: 00:01:20</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row wrong_answers-list">
                                                        <div class="col-md-4">
                                                            <span>Nr. Intrebari Gresite: </span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control wrong_answers" id="wrong_answers" type="text" name="wrong_answers" placeholder="" value="{{ $knowledge_result['wrong_answers'] }}" required>
                                                            <div class="help-block text-danger print-error" id="wrong_answers-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">exemplu: 3</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row wrong_questions-list">
                                                        <div class="col-md-4">
                                                            <span>S-au gresit intrebarile: </span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input class="form-control wrong_questions" id="wrong_questions" type="text" name="wrong_questions" placeholder="" value="{{ $knowledge_result['wrong_questions'] }}" required>
                                                            <div class="help-block text-danger print-error" id="wrong_questions-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">exemplu: 1,6,8</small></p>
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
                                                                <option value="0" {{ $knowledge_result['abandon'] === 0 ? 'selected' : '' }}>Ok</option>
                                                                <option value="1" {{ $knowledge_result['abandon'] === 1 ? 'selected' : '' }}>Abandon</option>
                                                                <option value="2" {{ $knowledge_result['abandon'] === 2 ? 'selected' : '' }}>Descalificata</option>
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="abandon-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body">
                                                        <div><strong>Legenda</strong></div>
                                                            <div><strong>Timp Realizat:</strong> 00:03:05 unde 00 (ore), 03 (minute), 05 (secunde).</div>
                                                            <br />
                                                            <div><strong>Intrebari Gresite:</strong> cate intrebari a gresit echipa ( in cifre). Exemplu: 2. Daca nu s-a gresit nicio intrebare scrieti "0".</div>
                                                            <br />
                                                            <div><strong>S-au gresit intrebarile:</strong> care sunt intrebarile gresite. Exemplu: 2, 4, 10. Daca nu s-a gresit nicio intrebare, trebuie sa inserati "0".</div>
                                                            <br />
                                                            <div><strong>Status:</strong> se va selecta Abandon doar daca echipa a abandonat / se fa selecta Descalificare daca echipa a fost descalificata / Ok daca echipa a participat.</div>
                                                            <br />
                                                            <div>Atunci cand este Abandon/Descalificare este important sa adaugati 00:00:00 la timp si 0 peste tot dupa care se va bifa : Abandon sau Descalificare dupa caz.</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--knowledge-update btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}" data-categoryid="{{ $category->id }}" data-teamid="{{ $team->id }}">Adauga</button>
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
            $("#time").inputmask("99:99:99",{ "placeholder": "0" });
});
</script>