<div class="modal fade" id="ParticipantsStagesDestroy" tabindex="-1" role="dialog" aria-labelledby="ParticipantsStagesDestroy" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Stergere participanti</h4>
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
                                                    <div class="form-group row">
                                                        <div class="col-md-8">
                                                                <span><strong>Club</strong> {{ $team->club->name }} </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span><strong>Team</strong> {{ $team->name }} </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span><strong>Categorie</strong> {{ $team->category->name }} </span>
                                                        </div>
                                                    </div><br />
                                                </div>

                                                

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            @foreach ($participants_stages as $key => $participant_stages)
                                                                @foreach ($participant_stages->participants as $participant)
                                                                <span><strong>Participant {{ $key+1 }}:</strong> {{ $participant->name }}</span>
                                                                @endforeach
                                                            @endforeach
                                                        </div>
                                                        
                                                    </div>
                                                </div>


                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--participants-stages-confirm btn btn-danger mr-1 mb-1" data-stageid="{{ $stageid }}" data-id="{{ $team_id }}">Destroy</button>
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