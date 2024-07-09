<div class="modal fade" id="ParticipantsStagesEdit" tabindex="-1" role="dialog" aria-labelledby="ParticipantsStagesEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header"><h4 class="card-title">Echipa: {{ $team->name }}</h4></div>
                            <div class="card-header"><h4 class="card-title">Club: {{ $team->club->name }}</h4></div>
                            <div class="card-header"><h4 class="card-title">Categorie: {{ $team->category->name }}</h4></div>

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
                                                            <span>NUME PARTICIPANT: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control select2 max-length-3" id="participants" name="participants[]" multiple="multiple" id="max_length" required>
                                                                <option value="">--- selectează ---</option>
                                                                @foreach($participants as $participant)
                                                                    <option value="{{ $participant->id }}" {{ ($searchparticipant->search($participant->id)) ? 'selected' : '' }} >{{$participant->ci}} - {{$participant->phone}}  - {{$participant->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="participants-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--participants-stages-update btn btn-success mr-1 mb-1" data-stageid="{{ $team->stage_id }}" data-id="{{ $team->id }}">Adauga</button>
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