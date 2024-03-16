<div class="modal fade" id="ClubsCreate" tabindex="-1" role="dialog" aria-labelledby="ClubsCreate" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Adauga un club nou</h4>
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
                                                    <div class="form-group row clubs-list">
                                                        <div class="col-md-2">
                                                            <span>Nume Club: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control clubs" id="clubs" type="text" name="clubs[]" placeholder="" required>
                                                            <div class="help-block text-danger print-error" id="clubs-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Numele clubului, exemplu: Asociatia Drumetii Montane</small></p>
                                                        </div>
                                                        <div class="col-sm-2"><a href="javascript:void(0);" class="add_button" title="Add field"><img src="/images/add-icon.png"/></a></div>
                                                    </div>
                                                </div>

                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--clubs-create-store btn btn-success mr-1 mb-1" data-stageid="{{ $stageid }}">Adauga</button>
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

$(document).ready(function() {


            //Input fields increment limitation
            var maxField = 29;

            //Add button selector
            var addButton = $('.add_button');
            var x = 1;
            //Input field wrapper
            var wrapper = $('.clubs-list');

            //New input field html
            var fieldHTML = '<div class="col-12"><div class="form-group row clubs-list"><div class="col-md-2"><span>Nume Club: </span></div><div class="col-md-8"><input class="form-control clubs" id="clubs" type="text" name="clubs[]" placeholder="" required><div class="help-block text-danger print-error" id="clubs-error" style="display:none"><ul role="alert"></ul></div><p><small class="text-muted">Numele clubului, exemplu: Asociatia Drumetii Montane</small></p></div><div class="col-sm-2"><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a></div></div></div>';

            //Initial field counter is 1

            //Once add button is clicked
            $(addButton).click(function() {

                //Check maximum number of input fields
                if(x < maxField){

                    //Increment field counter
                    x++;

                    // Add field html
                    $(wrapper).append(fieldHTML);
                }
            });
            $(wrapper).on('click', '.remove_button', function(e) {
                //Once remove button is clicked
                e.preventDefault();

                //Remove field html
                $(this).parent('div').parent('div').remove();

                //Decrement field counter
                x--;
            });
        });
    </script>