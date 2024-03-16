<div class="modal fade" id="RaidMontanEdit" tabindex="-1" role="dialog" aria-labelledby="RaidMontanEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Echipa {{ $team->name }} - Raid Montan</h4>
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
                                                    <div class="form-group row finish_time-list">
                                                        <div class="col-md-6">
                                                            <span>Lipsa Bocanci: </span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="missing_footwear" name="missing_footwear" @if($raidmontan_participations->missing_footwear == 1) checked @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br />
                                                </div>
                                                
                                                <div class="col-12">
                                                    <div class="form-group row finish_time-list">
                                                        <div class="col-md-6">
                                                            <span>Lipsa echipament: </span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-check form-check-inline">
                                                                <div class="input-group"><input id="missing_equipment_items" type="number" name="missing_equipment_items" class="touchspin" value="{{ $raidmontan_participations->missing_equipment_items }}" /></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br />
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row missed_posts-list">
                                                        <div class="col-md-6">
                                                            <span>Nerespectare distanta intre membrii: </span>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="checkbox" id="minimum_distance_penalty" name="minimum_distance_penalty" @if($raidmontan_participations->minimum_distance_penalty == 1) checked @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br />
                                                </div>

                                                @foreach ($RaidmontanParticipationsEntries as $RaidmontanParticipationsEntrie)
                                                    @if($RaidmontanParticipationsEntrie->raidmontan_stations_station_type == 0)
                                                        <div class="row">
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-2">
                                                                        <span><strong>Start</strong>:</span>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control station_start" id="station_start" type="text" name="station_start" placeholder="hh:mm:ss" value="{{ $RaidmontanParticipationsEntrie->time_start }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="input-group mb-4">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="input-group mb-4">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif                                   
                                                    @if($RaidmontanParticipationsEntrie->raidmontan_stations_station_type == 1)
                                                            <div class="col-12">
                                                                <div class="form-group pa-stations-row row">
                                                                    <div class="col-md-2">
                                                                        <span><strong>PA-{{ $station_type_one++ }}</strong>:</span>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control time-start" id="pa_stations_s_{{ $station_type_one }}" type="text" name="pa_stations[$station_type_one]['time_start']" placeholder="hh:mm:ss" value="{{ $RaidmontanParticipationsEntrie->time_start }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control time-finish" id="pa_stations_f_{{ $station_type_one }}" type="text" name="pa_stations[$station_type_one]['time_finish']" placeholder="hh:mm:ss" value="{{ $RaidmontanParticipationsEntrie->time_finish }}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="input-group mb-4">
                                                                        @foreach ($RaidmontanParticipationsEntrie->RaidmontanStations as $value)
                                                                                {{ $value['maximum_time'] }} minute (timp maxim)
                                                                        @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endif
                                                    @if($RaidmontanParticipationsEntrie->raidmontan_stations_station_type == 2)
                                                            <div class="col-12">
                                                                <div class="form-group row">
                                                                    <div class="col-md-4">
                                                                        <span>Post fara Arbitru (<strong>PFA-{{ $station_type_two++ }}</strong>): </span>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-check-input" type="checkbox" id="pfa_stations-{{ $station_type_two }}" name="pfa_stations[]" @if($RaidmontanParticipationsEntrie->hits == 0) checked @endif>
                                                                            <label class="form-check-label padding-left-10" for="pfa_stations-{{ $station_type_two }}">Post Ratat</label>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="input-group mb-4">
                                                                        @foreach ($RaidmontanParticipationsEntrie->RaidmontanStations as $value)
                                                                                {{ $value['points'] }} puncte (scor)
                                                                        @endforeach
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    @endif
                                                    @if($RaidmontanParticipationsEntrie->raidmontan_stations_station_type == 3)
                                                        <div class="row">
                                                            <div class="col-12 stations-list">
                                                                <div class="form-group row">
                                                                    <div class="col-md-2">
                                                                        <span><strong>Finish</strong>:</span>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="input-group mb-4">
                                                                            <input class="form-control station_finish" id="station_finish" type="text" name="station_finish" placeholder="hh:mm:ss" value="{{ $RaidmontanParticipationsEntrie->time_finish }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-3">
                                                                        <div class="input-group mb-4">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-4">
                                                                        <div class="input-group mb-4">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach


                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Status (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <select class="form-control m-b" id="abandon" name="abandon">
                                                                <option value="0" {{ $raidmontan_participations->abandon === 0 ? 'selected' : '' }}>Ok</option>
                                                                <option value="1" {{ $raidmontan_participations->abandon  === 1 ? 'selected' : '' }}>Abandon</option>
                                                                <option value="2" {{ $raidmontan_participations->abandon  === 2 ? 'selected' : '' }}>Descalificata</option>
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="abandon-error" style="display:none"><ul role="alert"></ul></div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--raidmontan-update btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}" data-categoryid="{{ $category->id }}" data-teamid="{{ $team->id }}">Adauga</button>
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

$("#station_start").inputmask("99:99:99",{ "placeholder": "0" });
$("#station_finish").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_s_1").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_f_1").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_s_2").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_f_2").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_s_3").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_f_3").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_s_4").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_f_4").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_s_5").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_f_5").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_s_6").inputmask("99:99:99",{ "placeholder": "0" });
$("#pa_stations_f_6").inputmask("99:99:99",{ "placeholder": "0" });

  // Default Spin
  $('.touchspin').TouchSpin({
    buttondown_class: 'btn btn-primary',
    buttonup_class: 'btn btn-primary',
    buttondown_txt: feather.icons['minus'].toSvg(),
    buttonup_txt: feather.icons['plus'].toSvg()
  });

  // Icon Change
  $('.touchspin-icon').TouchSpin({
    buttondown_txt: feather.icons['chevron-down'].toSvg(),
    buttonup_txt: feather.icons['chevron-up'].toSvg()
  });

  
  var touchspinValue = $('.touchspin-min-max'),
    counterMin = 17,
    counterMax = 21;
  if (touchspinValue.length > 0) {
    touchspinValue
      .TouchSpin({
        min: counterMin,
        max: counterMax,
        buttondown_txt: feather.icons['minus'].toSvg(),
        buttonup_txt: feather.icons['plus'].toSvg()
      })
      .on('touchspin.on.startdownspin', function () {
        var $this = $(this);
        $('.bootstrap-touchspin-up').removeClass('disabled-max-min');
        if ($this.val() == counterMin) {
          $(this).siblings().find('.bootstrap-touchspin-down').addClass('disabled-max-min');
        }
      })
      .on('touchspin.on.startupspin', function () {
        var $this = $(this);
        $('.bootstrap-touchspin-down').removeClass('disabled-max-min');
        if ($this.val() == counterMax) {
          $(this).siblings().find('.bootstrap-touchspin-up').addClass('disabled-max-min');
        }
      });
  }



});
</script>