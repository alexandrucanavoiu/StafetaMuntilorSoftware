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
            var fieldHTML_1 = '<div class="form-group"><label class="control-label col-sm-3" for="email">POST </label><div class="col-sm-5"><input type="text" class="form-control"  name="post[1][]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

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
            var fieldHTML_2 = '<div class="form-group"><label class="control-label col-sm-3" for="email">POST </label><div class="col-sm-5"><input type="text" class="form-control"  name="post[2][]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

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
            var fieldHTML_3 = '<div class="form-group"><label class="control-label col-sm-3" for="email">POST </label><div class="col-sm-5"><input type="text" class="form-control"  name="post[3][]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

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
            var fieldHTML_4 = '<div class="form-group"><label class="control-label col-sm-3" for="email">POST </label><div class="col-sm-5"><input type="text" class="form-control"  name="post[4][]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

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
            var fieldHTML_5 = '<div class="form-group"><label class="control-label col-sm-3" for="email">POST </label><div class="col-sm-5"><input type="text" class="form-control"  name="post[5][]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

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
            var fieldHTML_6 = '<div class="form-group"><label class="control-label col-sm-3" for="email">POST </label><div class="col-sm-5"><input type="text" class="form-control"  name="post[6][]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

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
            var fieldHTML_7 = '<div class="form-group"><label class="control-label col-sm-3" for="email">POST </label><div class="col-sm-5"><input type="text" class="form-control"  name="post[7][]"></div><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *</div>';

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
Configurare Posturi de Control Orientare
                </h1>
            </div>

                <div class="col-md-3 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categoria FAMILY
                        </div>
                        <div class="panel-body">
                            <form action="/configure" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="categories_id" value="1" name="categories_id">
                             <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">START</label>
                                    <div class="col-sm-5">
                                        <input type="hidden" class="form-control" id="start_1" value="251" name="post[1][]" placeholder="251">
                                        <input type="text" class="form-control" id="start_1" name="post[1][]" placeholder="251" disabled>
                                    </div>
                             </div>
                                <?php $nr = 1 ?>
                                @foreach($orienteering_post_1 as $post)
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">POST {{ $nr++ }}</label>
                                <div class="col-sm-5">
                                    <input type="text" class="form-control"  value="{{ $post->post }}" name="post[1][]">
                                </div>
                                <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                            </div>
                                @endforeach
                            <div class="button-add_1"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">FINISH</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="finish_1" value="252" name="post[1][]" placeholder="252">
                                    <input type="text" class="form-control" id="finish_1" name="post[1][]" placeholder="252" disabled>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="add_button_1" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categoria JUNIORI
                        </div>
                        <div class="panel-body">
                            <form action="/configure" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="categories_id" value="2" name="categories_id">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">START</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="start_2" value="251" name="post[2][]" placeholder="251">
                                    <input type="text" class="form-control" id="start_2" v name="post[2][]" placeholder="251" disabled>
                                </div>
                            </div>
                                <?php $nr = 1 ?>
                                @foreach($orienteering_post_2 as $post)
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="email">POST {{ $nr++ }}</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control"  value="{{ $post->post }}" name="post[2][]">
                                        </div>
                                        <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                    </div>
                                @endforeach
                                <div class="button-add_2"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">FINISH</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="finish_2" value="252" name="post[2][]" placeholder="252">
                                    <input type="text" class="form-control" id="finish_2"  name="post[2][]" placeholder="252" disabled>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="add_button_2" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                                <button class="btn btn-primary btn-sm">Actualizeaza</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categoria ELITE
                        </div>
                        <div class="panel-body">
                            <form action="/configure" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="categories_id" value="3" name="categories_id">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">START</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="start_3" value="251" name="post[3][]" placeholder="251">
                                    <input type="text" class="form-control" id="start_3" name="post[][]" placeholder="251" disabled>
                                </div>
                            </div>
                                <?php $nr = 1 ?>
                                @foreach($orienteering_post_3 as $post)
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="email">POST {{ $nr++ }}</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="{{ $post->post }}"  name="post[3][]">
                                        </div>
                                        <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                    </div>
                                @endforeach
                                <div class="button-add_3"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">FINISH</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="finish_3" value="252" name="post[3][]" placeholder="252">
                                    <input type="text" class="form-control" id="finish_3" name="post[3][]" placeholder="252" disabled>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="add_button_3" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                                <button class="btn btn-primary btn-sm">Actualizeaza</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categoria OPEN
                        </div>
                        <div class="panel-body">
                            <form action="/configure" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="categories_id" value="4" name="categories_id">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">START</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="start_4" value="251" name="post[4][]" placeholder="251">
                                    <input type="text" class="form-control" id="start_4" name="post[4][]" placeholder="251" disabled>
                                </div>
                            </div>
                                <?php $nr = 1 ?>
                            @foreach($orienteering_post_4 as $post)
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">POST {{ $nr++ }}</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" value="{{ $post->post }}"  name="post[4][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                            @endforeach
                                <div class="button-add_4"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">FINISH</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="finish_3" value="252" name="post[4][]" placeholder="252">
                                    <input type="text" class="form-control" id="finish_3"name="post[4][]" placeholder="252" disabled>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="add_button_4" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categoria VETERANI
                        </div>
                        <div class="panel-body">
                            <form action="/configure" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="categories_id" value="5" name="categories_id">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">START</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="start_5" value="251" name="post[5][]" placeholder="251">
                                    <input type="text" class="form-control" id="start_5" name="post[5][]" placeholder="251" disabled>
                                </div>
                            </div>
                                <?php $nr = 1 ?>
                                @foreach($orienteering_post_5 as $post)
                                    <div class="form-group">
                                        <label class="control-label col-sm-3" for="email">POST {{ $nr++ }}</label>
                                        <div class="col-sm-5">
                                            <input type="text" class="form-control" value="{{ $post->post }}"  name="post[5][]">
                                        </div>
                                        <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                    </div>
                                @endforeach
                                <div class="button-add_5"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">FINISH</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="finish_5" value="252" name="post[5][]" placeholder="252">
                                    <input type="text" class="form-control" id="finish_5"  name="post[5][]" placeholder="252" disabled>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="add_button_5" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                                <button class="btn btn-primary btn-sm">Actualizeaza</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categoria FEMININ
                        </div>
                        <div class="panel-body">
                            <form action="/configure" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="categories_id" value="6" name="categories_id">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">START</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="start_6" value="251" name="post[6][]" placeholder="251">
                                    <input type="text" class="form-control" id="start_6"  name="post[6][]" placeholder="251" disabled>
                                </div>
                            </div>
                                <?php $nr = 1 ?>
                            @foreach($orienteering_post_6 as $post)
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">POST {{ $nr++ }}</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" value="{{ $post->post }}"  name="post[6][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                            @endforeach
                                <div class="button-add_6"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">FINISH</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="finish_3" value="252" name="post[6][]" placeholder="252">
                                    <input type="text" class="form-control" id="finish_3" name="post[6][]" placeholder="252" disabled>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="add_button_6" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                                <button class="btn btn-primary btn-sm">Actualizeaza</button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-3 col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Categoria SENIORI
                        </div>
                        <div class="panel-body">
                            <form action="/configure" class="form-horizontal" method="post">
                                {{ csrf_field() }}
                                <input type="hidden" class="form-control" id="categories_id" value="7" name="categories_id">
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">START</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="start_7" value="251" name="post[7][]" placeholder="251">
                                    <input type="text" class="form-control" id="start_7" name="post[7][]" placeholder="251" disabled>
                                </div>
                            </div>
                                <?php $nr = 1 ?>
                            @foreach($orienteering_post_7 as $post)
                                <div class="form-group">
                                    <label class="control-label col-sm-3" for="email">POST {{ $nr++ }}</label>
                                    <div class="col-sm-5">
                                        <input type="text" class="form-control" value="{{ $post->post }}"  name="post[7][]">
                                    </div>
                                    <a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/images/remove-icon.png"/></a> *
                                </div>
                            @endforeach
                                <div class="button-add_7"></div>
                            <div class="form-group">
                                <label class="control-label col-sm-3" for="email">FINISH</label>
                                <div class="col-sm-5">
                                    <input type="hidden" class="form-control" id="finish_7" value="252" name="post[7][]" placeholder="252">
                                    <input type="text" class="form-control" id="finish_7" name="post[7][]" placeholder="252" disabled>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="add_button_7" title="Add field"><img src="/images/add-icon.png"/></a> <span class="error"> *</span>
                            <button class="btn btn-primary btn-sm">Actualizeaza</button>
                            </form>
                        </div>
                    </div>
                </div>
        </div>
    </div>
@endsection