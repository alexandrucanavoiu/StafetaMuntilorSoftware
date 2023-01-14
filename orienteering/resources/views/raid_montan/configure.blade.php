@extends('layouts/template')
@section('body')
    <script type="text/javascript">
        $(document).ready(function() {
            //Input fields increment limitation
            var maxField = 20;

            //Add button selector
            var addButton_1 = $('.add_button_1');
            //Input field wrapper
            var wrapper_1 = $('.button-add_1');

            //New input field html
            var fieldHTML_1 = '<div class="form-group">' +
                '<label class="control-label col-sm-2" for="email">Cod PA </label>' +
                '<div class="col-sm-3">' +
                '<input type="text" class="form-control"  name="category[1][cod][]">' +
                '</div>' +
                '<label class="control-label col-sm-3" for="email">Time </label>' +
                '<div class="col-sm-3"><input type="text" class="form-control"  name="category[1][time][]"></div>' +
                '<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

            //Initial field counter is 1
            var x_1 = 1;

            //Once add button is clicked
            $(addButton_1).click(function() {

                //Check maximum number of input fields
                if(x_1 < maxField){

                    //Increment field counter
                    x_1++;

                    // Add field html
                    $(wrapper_1).append(fieldHTML_1);
                }
            });


            //Add button selector
            var addButton_2 = $('.add_button_2');
            //Input field wrapper
            var wrapper_2 = $('.button-add_2');

            //New input field html
            var fieldHTML_2 = '<div class="form-group">' +
                '<label class="control-label col-sm-2" for="email">Cod PA </label>' +
                '<div class="col-sm-3">' +
                '<input type="text" class="form-control"  name="category[2][cod][]">' +
                '</div>' +
                '<label class="control-label col-sm-3" for="email">Time </label>' +
                '<div class="col-sm-3"><input type="text" class="form-control"  name="category[2][time][]"></div>' +
                '<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';
            //Initial field counter is 1
            var x_2 = 1;

            //Once add button is clicked
            $(addButton_2).click(function() {

                //Check maximum number of input fields
                if(x_2 < maxField){

                    //Increment field counter
                    x_2++;

                    // Add field html
                    $(wrapper_2).append(fieldHTML_2);
                }
            });

            //Add button selector
            var addButton_3 = $('.add_button_3');
            //Input field wrapper
            var wrapper_3 = $('.button-add_3');

            //New input field html
            var fieldHTML_3 = '<div class="form-group">' +
                '<label class="control-label col-sm-2" for="email">Cod PA </label>' +
                '<div class="col-sm-3">' +
                '<input type="text" class="form-control"  name="category[3][cod][]">' +
                '</div>' +
                '<label class="control-label col-sm-3" for="email">Time </label>' +
                '<div class="col-sm-3"><input type="text" class="form-control"  name="category[3][time][]"></div>' +
                '<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';
            //Initial field counter is 1
            var x_3 = 1;

            //Once add button is clicked
            $(addButton_3).click(function() {

                //Check maximum number of input fields
                if(x_3 < maxField){

                    //Increment field counter
                    x_3++;

                    // Add field html
                    $(wrapper_3).append(fieldHTML_3);
                }
            });


            //Add button selector
            var addButton_4 = $('.add_button_4');
            //Input field wrapper
            var wrapper_4 = $('.button-add_4');

            //New input field html
            var fieldHTML_4 = '<div class="form-group">' +
                '<label class="control-label col-sm-2" for="email">Cod PA </label>' +
                '<div class="col-sm-3">' +
                '<input type="text" class="form-control"  name="category[4][cod][]">' +
                '</div>' +
                '<label class="control-label col-sm-3" for="email">Time </label>' +
                '<div class="col-sm-3"><input type="text" class="form-control"  name="category[4][time][]"></div>' +
                '<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';
            //Initial field counter is 1
            var x_4 = 1;

            //Once add button is clicked
            $(addButton_4).click(function() {

                //Check maximum number of input fields
                if(x_4 < maxField){

                    //Increment field counter
                    x_4++;

                    // Add field html
                    $(wrapper_4).append(fieldHTML_4);
                }
            });

            //Add button selector
            var addButton_5 = $('.add_button_5');
            //Input field wrapper
            var wrapper_5 = $('.button-add_5');

            //New input field html
            var fieldHTML_5 = '<div class="form-group">' +
                '<label class="control-label col-sm-2" for="email">Cod PA </label>' +
                '<div class="col-sm-3">' +
                '<input type="text" class="form-control"  name="category[5][cod][]">' +
                '</div>' +
                '<label class="control-label col-sm-3" for="email">Time </label>' +
                '<div class="col-sm-3"><input type="text" class="form-control"  name="category[5][time][]"></div>' +
                '<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';
            //Initial field counter is 1
            var x_5 = 1;

            //Once add button is clicked
            $(addButton_5).click(function() {

                //Check maximum number of input fields
                if(x_5 < maxField){

                    //Increment field counter
                    x_5++;

                    // Add field html
                    $(wrapper_5).append(fieldHTML_5);
                }
            });


            //Add button selector
            var addButton_6 = $('.add_button_6');
            //Input field wrapper
            var wrapper_6 = $('.button-add_6');

            //New input field html
            var fieldHTML_6 = '<div class="form-group">' +
                '<label class="control-label col-sm-2" for="email">Cod PA </label>' +
                '<div class="col-sm-3">' +
                '<input type="text" class="form-control"  name="category[6][cod][]">' +
                '</div>' +
                '<label class="control-label col-sm-3" for="email">Time </label>' +
                '<div class="col-sm-3"><input type="text" class="form-control"  name="category[6][time][]"></div>' +
                '<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';
            //Initial field counter is 1
            var x_6 = 1;

            //Once add button is clicked
            $(addButton_6).click(function() {

                //Check maximum number of input fields
                if(x_6 < maxField){

                    //Increment field counter
                    x_6++;

                    // Add field html
                    $(wrapper_6).append(fieldHTML_6);
                }
            });

            //Add button selector
            var addButton_7 = $('.add_button_7');
            //Input field wrapper
            var wrapper_7 = $('.button-add_7');

            //New input field html
            var fieldHTML_7 = '<div class="form-group">' +
                '<label class="control-label col-sm-2" for="email">Cod PA </label>' +
                '<div class="col-sm-3">' +
                '<input type="text" class="form-control"  name="category[7][cod][]">' +
                '</div>' +
                '<label class="control-label col-sm-3" for="email">Time </label>' +
                '<div class="col-sm-3"><input type="text" class="form-control"  name="category[7][time][]"></div>' +
                '<a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';
            //Initial field counter is 1
            var x_7 = 1;

            //Once add button is clicked
            $(addButton_7).click(function() {

                //Check maximum number of input fields
                if(x_7 < maxField){

                    //Increment field counter
                    x_7++;

                    // Add field html
                    $(wrapper_7).append(fieldHTML_7);
                }
            });

            $(wrapper).on('click', '.remove_button', function(e) {
                //Once remove button is clicked
                e.preventDefault();

                //Remove field html
                $(this).parent('div').remove();

                //Decrement field counter
                x--;
            });
        });
    </script>
<div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div style="margin-top: 10px; margin-bottom: -10px">
                    @include('partials.form-flash-message')
                </div>
                <h1 class="page-header">
Configurare Posturi de Control Raid Montan
                </h1>
            </div>

            <div class="col-md-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categoria Family
                    </div>
                    <div class="panel-body">
                        <form action="/configure-raid-montan" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="categories_id" value="1" name="categories_id">
                            <?php $nr = 1 ?>
                            @if($raidmontan_post_1->count() > 0)
                                @foreach($raidmontan_post_1 as $post)
                                    @if($post->post == "251")
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">START</label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" class="form-control" id="start_1" value="251" name="category[1][cod][]" placeholder="251">
                                                    <input type="hidden" class="form-control" id="start_1" value="" name="category[1][time][]" placeholder="251">
                                                    <input type="text" class="form-control" id="start_1" name="category[1][cod][]" placeholder="251" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($post->post == "252")
                                        <div class="button-add_1"></div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">FINISH</label>
                                                <div class="col-xs-3">
                                                    <input type="hidden" class="form-control" id="finish_1" value="252" name="category[1][cod][]" placeholder="">
                                                    <input type="hidden" class="form-control" id="finish_1" value="" name="category[1][time][]" placeholder="">
                                                    <input type="text" class="form-control" id="finish_1" value="252" name="category[1][cod][]" placeholder="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->post }}" name="category[1][cod][]">
                                            </div>
                                            <label class="control-label col-sm-3" for="email">Time</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->time }}" name="category[1][time][]">
                                            </div>
                                            <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <?php $nr = 1 ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">START</label>
                                        <div class="col-sm-3">
                                            <input type="hidden" class="form-control" id="start_1" value="251" name="category[1][cod][]" placeholder="251">
                                            <input type="hidden" class="form-control" id="start_1" value="" name="category[1][time][]" placeholder="251">
                                            <input type="text" class="form-control" id="start_1" name="category[1][cod][]" placeholder="251" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[1][cod][]">
                                    </div>
                                    <label class="control-label col-sm-3" for="email">Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[1][time][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                                <div class="button-add_1"></div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">FINISH</label>
                                        <div class="col-xs-3">
                                            <input type="hidden" class="form-control" id="finish_1" value="252" name="category[1][cod][]" placeholder="">
                                            <input type="hidden" class="form-control" id="finish_1" value="" name="category[1][time][]" placeholder="">
                                            <input type="text" class="form-control" id="finish_1" value="252" name="category[1][cod][]" placeholder="" disabled>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            <a href="javascript:void(0);" class="add_button_1" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categoria Juniori
                    </div>
                    <div class="panel-body">
                        <form action="/configure-raid-montan" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="categories_id" value="2" name="categories_id">
                            <?php $nr = 1 ?>
                            @if($raidmontan_post_2->count() > 0)
                                @foreach($raidmontan_post_2 as $post)
                                    @if($post->post == "251")
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">START</label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" class="form-control" id="start_1" value="251" name="category[2][cod][]" placeholder="251">
                                                    <input type="hidden" class="form-control" id="start_1" value="" name="category[2][time][]" placeholder="251">
                                                    <input type="text" class="form-control" id="start_1" name="category[2][cod][]" placeholder="251" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($post->post == "252")
                                        <div class="button-add_2"></div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">FINISH</label>
                                                <div class="col-xs-3">
                                                    <input type="hidden" class="form-control" id="finish_1" value="252" name="category[2][cod][]" placeholder="">
                                                    <input type="hidden" class="form-control" id="finish_1" value="" name="category[2][time][]" placeholder="">
                                                    <input type="text" class="form-control" id="finish_1" value="252" name="category[2][cod][]" placeholder="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->post }}" name="category[2][cod][]">
                                            </div>
                                            <label class="control-label col-sm-3" for="email">Time</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->time }}" name="category[2][time][]">
                                            </div>
                                            <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <?php $nr = 1 ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">START</label>
                                        <div class="col-sm-3">
                                            <input type="hidden" class="form-control" id="start_1" value="251" name="category[2][cod][]" placeholder="251">
                                            <input type="hidden" class="form-control" id="start_1" value="" name="category[2][time][]" placeholder="251">
                                            <input type="text" class="form-control" id="start_1" name="category[2][cod][]" placeholder="251" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[2][cod][]">
                                    </div>
                                    <label class="control-label col-sm-3" for="email">Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[2][time][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                                <div class="button-add_2"></div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">FINISH</label>
                                        <div class="col-xs-3">
                                            <input type="hidden" class="form-control" id="finish_1" value="252" name="category[2][cod][]" placeholder="">
                                            <input type="hidden" class="form-control" id="finish_1" value="" name="category[2][time][]" placeholder="">
                                            <input type="text" class="form-control" id="finish_1" value="252" name="category[2][cod][]" placeholder="" disabled>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            <a href="javascript:void(0);" class="add_button_2" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categoria Elite
                    </div>
                    <div class="panel-body">
                        <form action="/configure-raid-montan" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="categories_id" value="3" name="categories_id">
                            <?php $nr = 1 ?>
                            @if($raidmontan_post_3->count() > 0)
                                @foreach($raidmontan_post_3 as $post)
                                    @if($post->post == "251")
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">START</label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" class="form-control" id="start_1" value="251" name="category[3][cod][]" placeholder="251">
                                                    <input type="hidden" class="form-control" id="start_1" value="" name="category[3][time][]" placeholder="251">
                                                    <input type="text" class="form-control" id="start_1" name="category[3][cod][]" placeholder="251" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($post->post == "252")
                                        <div class="button-add_3"></div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">FINISH</label>
                                                <div class="col-xs-3">
                                                    <input type="hidden" class="form-control" id="finish_1" value="252" name="category[3][cod][]" placeholder="">
                                                    <input type="hidden" class="form-control" id="finish_1" value="" name="category[3][time][]" placeholder="">
                                                    <input type="text" class="form-control" id="finish_1" value="252" name="category[3][cod][]" placeholder="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->post }}" name="category[3][cod][]">
                                            </div>
                                            <label class="control-label col-sm-3" for="email">Time</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->time }}" name="category[3][time][]">
                                            </div>
                                            <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <?php $nr = 1 ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">START</label>
                                        <div class="col-sm-3">
                                            <input type="hidden" class="form-control" id="start_1" value="251" name="category[3][cod][]" placeholder="251">
                                            <input type="hidden" class="form-control" id="start_1" value="" name="category[3][time][]" placeholder="251">
                                            <input type="text" class="form-control" id="start_1" name="category[3][cod][]" placeholder="251" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[3][cod][]">
                                    </div>
                                    <label class="control-label col-sm-3" for="email">Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[3][time][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                                <div class="button-add_3"></div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">FINISH</label>
                                        <div class="col-xs-3">
                                            <input type="hidden" class="form-control" id="finish_1" value="252" name="category[3][cod][]" placeholder="">
                                            <input type="hidden" class="form-control" id="finish_1" value="" name="category[3][time][]" placeholder="">
                                            <input type="text" class="form-control" id="finish_1" value="252" name="category[3][cod][]" placeholder="" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <a href="javascript:void(0);" class="add_button_3" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categoria Open
                    </div>
                    <div class="panel-body">
                        <form action="/configure-raid-montan" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="categories_id" value="4" name="categories_id">
                            <?php $nr = 1 ?>
                            @if($raidmontan_post_4->count() > 0)
                                @foreach($raidmontan_post_4 as $post)
                                    @if($post->post == "251")
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">START</label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" class="form-control" id="start_1" value="251" name="category[4][cod][]" placeholder="251">
                                                    <input type="hidden" class="form-control" id="start_1" value="" name="category[4][time][]" placeholder="251">
                                                    <input type="text" class="form-control" id="start_1" name="category[4][cod][]" placeholder="251" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($post->post == "252")
                                        <div class="button-add_4"></div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">FINISH</label>
                                                <div class="col-xs-3">
                                                    <input type="hidden" class="form-control" id="finish_1" value="252" name="category[4][cod][]" placeholder="">
                                                    <input type="hidden" class="form-control" id="finish_1" value="" name="category[4][time][]" placeholder="">
                                                    <input type="text" class="form-control" id="finish_1" value="252" name="category[4][cod][]" placeholder="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->post }}" name="category[4][cod][]">
                                            </div>
                                            <label class="control-label col-sm-3" for="email">Time</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->time }}" name="category[4][time][]">
                                            </div>
                                            <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <?php $nr = 1 ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">START</label>
                                        <div class="col-sm-3">
                                            <input type="hidden" class="form-control" id="start_1" value="251" name="category[4][cod][]" placeholder="251">
                                            <input type="hidden" class="form-control" id="start_1" value="" name="category[4][time][]" placeholder="251">
                                            <input type="text" class="form-control" id="start_1" name="category[4][cod][]" placeholder="251" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[4][cod][]">
                                    </div>
                                    <label class="control-label col-sm-3" for="email">Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[4][time][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                                <div class="button-add_4"></div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">FINISH</label>
                                        <div class="col-xs-3">
                                            <input type="hidden" class="form-control" id="finish_1" value="252" name="category[4][cod][]" placeholder="">
                                            <input type="hidden" class="form-control" id="finish_1" value="" name="category[4][time][]" placeholder="">
                                            <input type="text" class="form-control" id="finish_1" value="252" name="category[4][cod][]" placeholder="" disabled>
                                        </div>
                                    </div>
                                </div>

                            @endif
                            <a href="javascript:void(0);" class="add_button_4" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categoria Veterani
                    </div>
                    <div class="panel-body">
                        <form action="/configure-raid-montan" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="categories_id" value="5" name="categories_id">
                            <?php $nr = 1 ?>
                            @if($raidmontan_post_5->count() > 0)
                                @foreach($raidmontan_post_5 as $post)
                                    @if($post->post == "251")
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">START</label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" class="form-control" id="start_1" value="251" name="category[5][cod][]" placeholder="251">
                                                    <input type="hidden" class="form-control" id="start_1" value="" name="category[5][time][]" placeholder="251">
                                                    <input type="text" class="form-control" id="start_1" name="category[5][cod][]" placeholder="251" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($post->post == "252")
                                        <div class="button-add_5"></div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">FINISH</label>
                                                <div class="col-xs-3">
                                                    <input type="hidden" class="form-control" id="finish_1" value="252" name="category[5][cod][]" placeholder="">
                                                    <input type="hidden" class="form-control" id="finish_1" value="" name="category[5][time][]" placeholder="">
                                                    <input type="text" class="form-control" id="finish_1" value="252" name="category[5][cod][]" placeholder="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->post }}" name="category[5][cod][]">
                                            </div>
                                            <label class="control-label col-sm-3" for="email">Time</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->time }}" name="category[5][time][]">
                                            </div>
                                            <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <?php $nr = 1 ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">START</label>
                                        <div class="col-sm-3">
                                            <input type="hidden" class="form-control" id="start_1" value="251" name="category[5][cod][]" placeholder="251">
                                            <input type="hidden" class="form-control" id="start_1" value="" name="category[5][time][]" placeholder="251">
                                            <input type="text" class="form-control" id="start_1" name="category[5][cod][]" placeholder="251" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[5][cod][]">
                                    </div>
                                    <label class="control-label col-sm-3" for="email">Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[5][time][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                                <div class="button-add_5"></div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">FINISH</label>
                                        <div class="col-xs-3">
                                            <input type="hidden" class="form-control" id="finish_1" value="252" name="category[5][cod][]" placeholder="">
                                            <input type="hidden" class="form-control" id="finish_1" value="" name="category[5][time][]" placeholder="">
                                            <input type="text" class="form-control" id="finish_1" value="252" name="category[5][cod][]" placeholder="" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <a href="javascript:void(0);" class="add_button_5" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categoria Feminin
                    </div>
                    <div class="panel-body">
                        <form action="/configure-raid-montan" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="categories_id" value="6" name="categories_id">
                            <?php $nr = 1 ?>
                            @if($raidmontan_post_6->count() > 0)
                                @foreach($raidmontan_post_6 as $post)
                                    @if($post->post == "251")
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">START</label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" class="form-control" id="start_1" value="251" name="category[6][cod][]" placeholder="251">
                                                    <input type="hidden" class="form-control" id="start_1" value="" name="category[6][time][]" placeholder="251">
                                                    <input type="text" class="form-control" id="start_1" name="category[6][cod][]" placeholder="251" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($post->post == "252")
                                        <div class="button-add_6"></div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">FINISH</label>
                                                <div class="col-xs-3">
                                                    <input type="hidden" class="form-control" id="finish_1" value="252" name="category[6][cod][]" placeholder="">
                                                    <input type="hidden" class="form-control" id="finish_1" value="" name="category[6][time][]" placeholder="">
                                                    <input type="text" class="form-control" id="finish_1" value="252" name="category[6][cod][]" placeholder="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->post }}" name="category[6][cod][]">
                                            </div>
                                            <label class="control-label col-sm-3" for="email">Time</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->time }}" name="category[6][time][]">
                                            </div>
                                            <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <?php $nr = 1 ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">START</label>
                                        <div class="col-sm-3">
                                            <input type="hidden" class="form-control" id="start_1" value="251" name="category[6][cod][]" placeholder="251">
                                            <input type="hidden" class="form-control" id="start_1" value="" name="category[6][time][]" placeholder="251">
                                            <input type="text" class="form-control" id="start_1" name="category[6][cod][]" placeholder="251" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[6][cod][]">
                                    </div>
                                    <label class="control-label col-sm-3" for="email">Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[6][time][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                                <div class="button-add_6"></div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">FINISH</label>
                                        <div class="col-xs-3">
                                            <input type="hidden" class="form-control" id="finish_1" value="252" name="category[6][cod][]" placeholder="">
                                            <input type="hidden" class="form-control" id="finish_1" value="" name="category[6][time][]" placeholder="">
                                            <input type="text" class="form-control" id="finish_1" name="category[6][cod][]" placeholder="" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <a href="javascript:void(0);" class="add_button_6" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        Categoria Seniori
                    </div>
                    <div class="panel-body">
                        <form action="/configure-raid-montan" class="form-horizontal" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" class="form-control" id="categories_id" value="7" name="categories_id">
                            <?php $nr = 1 ?>
                            @if($raidmontan_post_7->count() > 0)
                                @foreach($raidmontan_post_7 as $post)
                                    @if($post->post == "251")
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">START</label>
                                                <div class="col-sm-3">
                                                    <input type="hidden" class="form-control" id="start_1" value="251" name="category[7][cod][]" placeholder="251">
                                                    <input type="hidden" class="form-control" id="start_1" value="" name="category[7][time][]" placeholder="251">
                                                    <input type="text" class="form-control" id="start_1" name="category[7][cod][]" placeholder="251" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @elseif($post->post == "252")
                                        <div class="button-add_7"></div>
                                        <div class="row">
                                            <div class="form-group">
                                                <label class="control-label col-sm-2" for="email">FINISH</label>
                                                <div class="col-xs-3">
                                                    <input type="hidden" class="form-control" id="finish_1" value="252" name="category[7][cod][]" placeholder="">
                                                    <input type="hidden" class="form-control" id="finish_1" value="" name="category[7][time][]" placeholder="">
                                                    <input type="text" class="form-control" id="finish_1" value="252" name="category[7][cod][]" placeholder="" disabled>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="form-group">
                                            <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->post }}" name="category[7][cod][]">
                                            </div>
                                            <label class="control-label col-sm-3" for="email">Time</label>
                                            <div class="col-sm-3">
                                                <input type="text" class="form-control"  value="{{ $post->time }}" name="category[7][time][]">
                                            </div>
                                            <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <?php $nr = 1 ?>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">START</label>
                                        <div class="col-sm-3">
                                            <input type="hidden" class="form-control" id="start_1" value="251" name="category[7][cod][]" placeholder="251">
                                            <input type="hidden" class="form-control" id="start_1" value="" name="category[7][time][]" placeholder="251">
                                            <input type="text" class="form-control" id="start_1" name="category[7][cod][]" placeholder="251" disabled>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-sm-2" for="email">Cod PA {{ $nr++ }}</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[7][cod][]">
                                    </div>
                                    <label class="control-label col-sm-3" for="email">Time</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control"  value="" name="category[7][time][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                                <div class="button-add_7"></div>
                                <div class="row">
                                    <div class="form-group">
                                        <label class="control-label col-sm-2" for="email">FINISH</label>
                                        <div class="col-xs-3">
                                            <input type="hidden" class="form-control" id="finish_1" value="252" name="category[7][cod][]" placeholder="">
                                            <input type="hidden" class="form-control" id="finish_1" value="" name="category[7][time][]" placeholder="">
                                            <input type="text" class="form-control" id="finish_1" value="252" name="category[7][cod][]" placeholder="" disabled>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            <a href="javascript:void(0);" class="add_button_7" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                        </form>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection