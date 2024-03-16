<div class="modal fade" id="SetupRaidMontanEdit" tabindex="-1" role="dialog" aria-labelledby="SetupRaidMontanEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Stafeta Muntilor - Raid Montan - <strong>Categoria: {{ $category->name }}</strong></h4>
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
                                                    <div class="form-group row start_time-list">
                                                        <div class="col-md-3">
                                                            <span>Start</span>
                                                        </div>
                                                        <div class="col-md-5">
                                                            <input class="form-control" type="text" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br />

                                            <div class="row">
                                                <div class="col-12 stations-list">
                                                @php $number_pa = 0; @endphp
                                                    @foreach($raid_montan_setup as $key => $raid_montan_stations)
                                                        @if($raid_montan_stations->station_type == 1)
                                                        @php $number_pa++ @endphp
                                                        <div class="form-group row">
                                                            @if($number_pa == 1)
                                                            <div class="col-md-4">
                                                                <span class="station_type_name_pa0">Start -> PA {{ $number_pa }}</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group mb-2 station_type_insert">
                                                                    <input type="text" class="form-control" placeholder="" aria-label="" name="stations_pa[]" value="{{ $raid_montan_stations->maximum_time }}" aria-describedby="basic-addon2">
                                                                    <span class="input-group-text" id="basic-addon2">minute</span>
                                                                    <div class="help-block text-danger print-error" id="stations_pa-error stations_pa-{{ $key }}-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="javascript:void(0);" class="add_button_pa" title="Add field"><img src="/images/add-icon.png"/></a>
                                                            </div>
                                                            </div>
                                                            @else
                                                            <div class="col-md-4">
                                                            <span class="station_type_name_pa{{ $number_pa }}">PA {{ $number_pa - 1 }} -> PA {{ $number_pa }}</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group mb-2 station_type_insert">
                                                                    <input type="text" class="form-control" placeholder="" aria-label="" name="stations_pa[]" value="{{ $raid_montan_stations->maximum_time }}" aria-describedby="basic-addon2">
                                                                    <span class="input-group-text" id="basic-addon2">minute</span>
                                                                    <div class="help-block text-danger print-error" id="stations_pa-error stations_pa-{{ $key }}-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="javascript:void(0);" class="remove_button_pa" title="Remove field"><img src="/images/remove-icon.png"/></a>
                                                            </div>
                                                        </div>
                                                            @endif
                                                            @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            @foreach($raid_montan_setup as $raid_montan_stations)
                                                @if($raid_montan_stations->station_type == 3)
                                                <div class="row">
                                                    <div class="col-12">
                                                        <div class="form-group row">
                                                            <div class="col-md-4">
                                                                <span>-> Finish</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group mb-2 input">
                                                                    <input type="text" class="form-control" placeholder="" aria-label="" name="stations_finish" value="{{ $raid_montan_stations->maximum_time }}" aria-describedby="basic-addon2">
                                                                    <span class="input-group-text" id="basic-addon2">minute</span>
                                                                    <div class="help-block text-danger print-error" id="stations_finish-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-2">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            @endforeach
                                            <br />
                                            <div class="row">
                                                <div class="col-12 stations-list2">
                                                    @php $number_pfa = 0; @endphp
                                                    @foreach($raid_montan_setup as $key => $raid_montan_stations)
                                                        @if($raid_montan_stations->station_type == 2)
                                                        @php $number_pfa++ @endphp
                                                        <div class="form-group row">
                                                        @if($number_pfa == 1)
                                                            <div class="col-md-4">
                                                                <span class="station_type_name_pfa0">PFA {{ $number_pfa }}</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group mb-2 station_type_insert">
                                                                    <input type="text" class="form-control" placeholder="" aria-label="" name="stations_pfa[]" value="{{ $raid_montan_stations->points }}" aria-describedby="basic-addon2">
                                                                    <span class="input-group-text" id="basic-addon2">puncte</span>
                                                                    <div class="help-block text-danger print-error" id="stations_pfa-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <a href="javascript:void(0);" class="add_button_pfa" title="Add field"><img src="/images/add-icon.png"/></a>
                                                            </div>
                                                        @else
                                                        <div class="col-md-4">
                                                                <span class="station_type_name_pfa0">PFA {{ $number_pfa }}</span>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="input-group mb-2 station_type_insert">
                                                                    <input type="text" class="form-control" placeholder="" aria-label="" name="stations_pfa[]" value="{{ $raid_montan_stations->points }}" aria-describedby="basic-addon2">
                                                                    <span class="input-group-text" id="basic-addon2">puncte</span>
                                                                    <div class="help-block text-danger print-error" id="stations_pfa-error" style="display:none"><ul role="alert"></ul></div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                            <a href="javascript:void(0);" class="remove_button_pfa" title="Remove field"><img src="/images/remove-icon.png"/></a>
                                                            </div>
                                                        @endif
                                                        </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                            <br />
                                            <div class="row">
                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--setup-raid-montan-update btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}" data-id="{{ $category->id }}">Adauga</button>
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
<script type="text/javascript">
        $(document).ready(function () {

        
            // PA

            //Input fields increment limitation
            var maxField_pa = 30;

            //Add button selector
            var addButton_pa = $('.add_button_pa');
            var number_pa = {{ $number_pa}}
            //Input field wrapper
            var wrapper_pa = $('.stations-list');

            //Initial field counter is 1

            //Once add button is clicked
            $(addButton_pa).click(function() {

                //Check maximum number of input fields
                if(number_pa < maxField_pa){

                    //Increment field counter
                    number_pa++;

            //New input field html
            var fieldHTML_pa = '<div class="form-group row"><div class="col-md-4"> \
                                                            <span class="station_type_name_pa'+ number_pa +'">PA '+ (number_pa - 1) +' -> PA '+ number_pa +'</span> \
                                                        </div> \
                                                        <div class="col-md-4"> \
                                                            <div class="input-group mb-2 station_type_insert"> \
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="stations_pa[]" value="" aria-describedby="basic-addon2"> \
                                                                <span class="input-group-text" id="basic-addon2">minute</span> \
                                                            </div> \
                                                        </div> \
                                                        <div class="col-md-3"> \
                                                            <a href="javascript:void(0);" class="remove_button_pa" title="Remove field"><img src="/images/remove-icon.png"/></a></div> \
                                                        </div></div>';

                    // Add field html
                    $(wrapper_pa).append(fieldHTML_pa);
                }
            });
            $(wrapper_pa).on('click', '.remove_button_pa', function(e) {
                //Once remove button is clicked
                e.preventDefault();

                //Remove field html
                $(this).parent('div').parent('div').remove();

                //Decrement field counter
                number_pa--;
            });

            // PFA

            //Input fields increment limitation
            var maxField_pfa = 30;

            //Add button selector
            var addButton_pfa = $('.add_button_pfa');
            var number_pfa = {{ $number_pfa}}
            //Input field wrapper
            var wrapper_pfa = $('.stations-list2');

            //Initial field counter is 1

            //Once add button is clicked
            $(addButton_pfa).click(function() {

                //Check maximum number of input fields
                if(number_pfa < maxField_pfa){

                    //Increment field counter
                    number_pfa++;

            //New input field html
            var fieldHTML_pfa = '<div class="form-group row"><div class="col-md-4"> \
                                                            <span class="station_type_name_pfa'+ number_pfa +'">PFA '+ number_pfa +'</span> \
                                                        </div> \
                                                        <div class="col-md-4"> \
                                                            <div class="input-group mb-2 station_type_insert"> \
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="stations_pfa[]" value="" aria-describedby="basic-addon2"> \
                                                                <span class="input-group-text" id="basic-addon2">puncte</span> \
                                                            </div> \
                                                        </div> \
                                                        <div class="col-md-3"> \
                                                            <a href="javascript:void(0);" class="remove_button_pfa" title="Remove field"><img src="/images/remove-icon.png"/></a></div> \
                                                        </div></div>';

                    // Add field html
                    $(wrapper_pfa).append(fieldHTML_pfa);
                }
            });
            $(wrapper_pfa).on('click', '.remove_button_pfa', function(e) {
                //Once remove button is clicked
                e.preventDefault();

                //Remove field html
                $(this).parent('div').parent('div').remove();

                //Decrement field counter
                number_pfa--;
            });

        });

</script>