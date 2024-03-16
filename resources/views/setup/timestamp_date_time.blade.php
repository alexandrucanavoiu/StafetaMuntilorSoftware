<div class="modal fade" id="TimestampDateTime" tabindex="-1" role="dialog" aria-labelledby="TimestampDateTime" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Convertire Timestamp in Date/Time</h4>
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
                                                                <div class="col-md-4"><span>Unixtime/Timestamp</span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" id="timestamp" name="timestamp" value="{{ $concatenation_output }}" aria-describedby="basic-addon2">
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>


    <br /><br />
                                                    
                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span><strong>Unix Timestamp / Timestamp:</strong></span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <div id="concatenation_output"><strong>{{ $concatenation_output }}</strong></div>
                                                                    </div>
                                                                </div>
                                                    </div>

                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span><strong>Converted in Date/Time:</strong></span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <div id="concatenation_output_to_datestring"><strong>{{ $concatenation_output_to_datestring }}</strong></div>
                                                                    </div>
                                                                </div>
                                                    </div>

    <br /><br />


                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--setup-convert-timestamp-datetime-confirm btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}">Convertire</button>
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