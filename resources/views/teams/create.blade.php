<div class="modal fade" id="TeamsCreate" tabindex="-1" role="dialog" aria-labelledby="TeamsCreate" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
        <div class="modal-content">
                <div class="modal-body">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Adauga o noua echipa</h4>
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
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Nume Club (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control club_id" aria-required="true" id="club_id" name="club_id">
                                                                <option value="">--- selectează ---</option>
                                                                @foreach($clubs as $club)
                                                                    <option value="{{ $club->id }}" {{ (collect(old('club_id'))->contains($club->id)) ? 'selected':'' }}>{{ $club->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="club_id-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Selectati Clubul</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row name-list">
                                                        <div class="col-md-4">
                                                            <span>Nume Echipa: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control name" id="name" type="text" name="name" placeholder="">
                                                            <div class="help-block text-danger print-error" id="name-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Numele Echipei, exemplu: Asociatia Drumetii Montane</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>Categoria (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control category_id" aria-required="true" id="category_id" name="category_id">
                                                                <option value="">--- selectează ---</option>
                                                                @foreach($categories as $category)
                                                                    <option value="{{ $category->id }}" {{ (collect(old('category_id'))->contains($category->id)) ? 'selected':'' }}>{{ $category->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="category_id-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Selectati Categoria</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row number-list">
                                                        <div class="col-md-4">
                                                            <span>Numar de participare: </span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <input class="form-control number" id="number" type="text" name="number" placeholder="">
                                                            <div class="help-block text-danger print-error" id="number-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Numarul echipei: 12</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>UUID Orienteeting (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control uuid_card_orienteering_id" aria-required="true" id="uuid_card_orienteering_id" name="uuid_card_orienteering_id">
                                                                <option value="">--- selectează ---</option>
                                                                @foreach($uuid_orienteering as $uuid)
                                                                    <option value="{{ $uuid->id }}" {{ (collect(old('uuid_card_orienteering_id'))->contains($uuid->id)) ? 'selected':'' }}>Nr. {{ $uuid->id }} - {{ $uuid->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="uuid_card_orienteering_id-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Selectati ceas pentru orientare</small></p>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-12">
                                                    <div class="form-group row">
                                                        <div class="col-md-4">
                                                            <span>UUID Raid (<span class="field-required">*</span>)</span>
                                                        </div>
                                                        <div class="col-md-8">
                                                            <select class="form-control uuid_card_raid_id" aria-required="true" id="uuid_card_raid_id" name="uuid_card_raid_id">
                                                                <option value="">--- selectează ---</option>
                                                                @foreach($uuid_raid as $uuid)
                                                                    <option value="{{ $uuid->id }}" {{ (collect(old('uuid_card_raid_id'))->contains($uuid->id)) ? 'selected':'' }}>Nr. {{ $uuid->id }} - {{ $uuid->name }}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="help-block text-danger print-error" id="uuid_card_raid_id-error" style="display:none"><ul role="alert"></ul></div>
                                                            <p><small class="text-muted">Selectati ceas pentru orientare</small></p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8 offset-md-4 pt-50">
                                                    <button type="button" class="btn btn-primary me-1 mr-1 mb-1" type="reset" data-bs-dismiss="modal" aria-label="Close">Inchide</button>
                                                    <button type="submit" class="js--teams-create-store btn btn-success mr-1 mb-1">Adauga</button>
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
            var maxField = 20;

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