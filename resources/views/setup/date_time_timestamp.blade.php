<div class="modal fade" id="DateTimeTimestamp" tabindex="-1" role="dialog" aria-labelledby="DateTimeTimestamp" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Convertire Date/Time in Timestamp</h4>
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
                                                                <div class="col-md-4"><span>Anul</span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" id="timestamp_year" name="timestamp_year" value="{{ $year }}" aria-describedby="basic-addon2">
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp_year-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>

                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span>Luna</span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" id="timestamp_month" name="timestamp_month" value="{{ $month }}" aria-describedby="basic-addon2">
                                                                        <span class="input-group-text" id="basic-addon2">01 pana la 12</span>
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp_month-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>

                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span>Zi</span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" id="timestamp_day" name="timestamp_day" value="{{ $day }}" aria-describedby="basic-addon2">
                                                                        <span class="input-group-text" id="basic-addon2">01 pana la 31</span>
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp_day-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>

                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span>Ora (24 ore)</span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" id="timestamp_hour" name="timestamp_hour" value="{{ $hour }}" aria-describedby="basic-addon2">
                                                                        <span class="input-group-text" id="basic-addon2">00 pana la 23</span>
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp_hour-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>

                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span>Minute</span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" id="timestamp_minutes" name="timestamp_minutes" value="{{ $minutes }}" aria-describedby="basic-addon2">
                                                                        <span class="input-group-text" id="basic-addon2">00 pana la 59</span>
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp_minutes-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>

                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span>Secunde</span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <input type="text" class="form-control" placeholder="" aria-label="" id="timestamp_secounds" name="timestamp_secounds" value="{{ $secounds }}" aria-describedby="basic-addon2">
                                                                        <span class="input-group-text" id="basic-addon2">00 pana la 59</span>
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp_secounds-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>

    <br /><br />
                                                    
                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span><strong>Unix Timestamp:</strong></span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <div id="concatenation_output"><strong>N/A</strong></div>
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp_month-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>

                                                    <div class="form-group row">
                                                                <div class="col-md-4"><span><strong>Your Time Zone:</strong></span></div>
                                                                <div class="col-md-4">
                                                                    <div class="input-group mb-2">
                                                                        <div id="concatenation_output_to_datestring"><strong>N/A</strong></div>
                                                                    </div>
                                                                    <div class="help-block text-danger print-error" id="timestamp_month-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                    </div>

    <br /><br />


                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--setup-convert-datetime-timestamp-confirm btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}">Convertire</button>
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