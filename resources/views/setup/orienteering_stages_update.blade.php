<div class="modal fade" id="SetupOrienteeringStagesEdit" tabindex="-1" role="dialog" aria-labelledby="SetupOrienteeringStagesEdit" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Stafeta Muntilor - Orientare - <strong>Categoria: {{ $category->name }}</strong></h4>
                            </div>
                            <div class="card-content">
                                <div class="card-body">
                                    <div class="text-danger">Primul POST este Start-ul, Ultimul POST este Finish-ul. Se Adauga in functie de CSV: Start punch, PunchX, Finish punch</div>
                                    <br />
                                    <div class="alert alert-danger print-error-msg" style="display:none">
                                        <span>Există erori la validarea formularului!</span>
                                    </div>
                                    <div class="help-block text-danger print-error" id="form_corruption-error" style="display:none"><ul role="alert"></ul></div>
                                    <br />
                                    <form>
                                        @csrf
                                    <div class="form-body">


                                        <div class="row">
                                            <div class="col-12 stations-list">
                                                @php $number_post = 1; @endphp
                                                    @foreach($orienteering_setup_stages as $key => $orienteering_stage)
                                                        <div class="form-group row">
                                                            <div class="col-md-4"><span class="station_type_name_pa{{ $number_post }}">POST {{ $number_post }}</span></div>
                                                            <div class="col-md-4">
                                                                <div class="input-group mb-2 station_type_insert">
                                                                    <input type="text" class="form-control" placeholder="" aria-label="" name="post[]" value="{{ $orienteering_stage->post }}" aria-describedby="basic-addon2">
                                                                    <span class="input-group-text" id="basic-addon2">cod statie</span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                @if($key == 0)
                                                                    <a href="javascript:void(0);" class="add_button_post" title="Add field"><img src="/images/add-icon.png"/></a>
                                                                @else
                                                                    <a href="javascript:void(0);" class="remove_button_post" title="Remove field"><img src="/images/remove-icon.png"/></a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                            @php $number_post++ @endphp
                                                    @endforeach
                                            </div>
                                        </div>
                                    </div>
                                        <br /><br />
                                        <div class="row">
                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--setup-orienteering-stages btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}" data-id="{{ $category->id }}">Adauga</button>
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
            var maxField_post = 30;

            //Add button selector
            var addButton_post = $('.add_button_post');
            var number_post = {{ $number_post }};
            //Input field wrapper
            var wrapper_post = $('.stations-list');

            //Initial field counter is 1

            //Once add button is clicked
            $(addButton_post).click(function() {

                //Check maximum number of input fields
                if(number_post < maxField_post){

                    //Increment field counter
                    number_post++;

            //New input field html
            var fieldHTML_post = '<div class="form-group row"><div class="col-md-4"> \
                                                            <span class="station_type_name_pa'+ number_post +'">POST '+ number_post +'</span> \
                                                        </div> \
                                                        <div class="col-md-4"> \
                                                            <div class="input-group mb-2 station_type_insert"> \
                                                                <input type="text" class="form-control" placeholder="" aria-label="" name="post[]" value="" aria-describedby="basic-addon2"> \
                                                                <span class="input-group-text" id="basic-addon2">cod statie</span> \
                                                            </div> \
                                                        </div> \
                                                        <div class="col-md-3"> \
                                                            <a href="javascript:void(0);" class="remove_button_post" title="Remove field"><img src="/images/remove-icon.png"/></a></div> \
                                                        </div></div>';

                    // Add field html
                    $(wrapper_post).append(fieldHTML_post);
                }
            });
            $(wrapper_post).on('click', '.remove_button_post', function(e) {
                //Once remove button is clicked
                e.preventDefault();

                //Remove field html
                $(this).parent('div').parent('div').remove();

                //Decrement field counter
                number_post--;
            });

      

        });

</script>