$(document).ready(function(){
    // Attach change event listener to select element
    $('#switch_stage').change(function(){
        // Get the selected value
        var selectedValue = $(this).val();
        
        // Make an AJAX GET request with the selected value
        $.ajax({
            type: 'GET',
            url: '/switch/' + selectedValue,
            success: function(response) {
                // Redirect to the appropriate route
                window.location.href = response.redirect_url;
            },
            error: function(xhr, status, error) {
                // Handle error here
                console.error('Error:', status, error);
            }
        });
    });
});

function printErrorMsg (msg) {
    $(".print-error-msg").find("ul").html('');
    $(".print-error-msg").css('display','block');
    $(".print-error").css('display','block');
    $.each( msg, function( key, value ) {
        $(".print-error-msg").find("ul").append('<li>'+value+'</li>');
    });
}

function printErrorMESSAGE(errors) {
    $('.print-error-msg').show();
    $(".print-error-msg ul").html('');
    $(".print-error-msg").css('display','block');
    $(".print-error").css('display','block');

    $.each(errors, function (key, messages) {
        const message = messages[0];

        // Convert dot notation to bracket notation
        const inputName = key
            .replace(/\.(\d+)/g, '[$1]')
            .replace(/\.(\w+)/g, '[$1]');

        console.log('key:', key, '→ inputName:', inputName);

        $(".print-error-msg ul").append('<li>' + message + '</li>');

        const input = $(`[name="${inputName}"]`);

        if (input.length) {
            input.addClass("is-invalid");
            if (input.next('.invalid-feedback').length === 0) {
                input.after(`<div class="invalid-feedback d-block">${message}</div>`);
            }
        } else {
            console.warn('No input found for:', inputName);
        }
    });
}



// Timestamp

$(document).on('hidden.bs.modal', '.modal', function () { $("#TimestampDateTime").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#DateTimeTimestamp").remove(); $(".modal-dialog").remove(); });

$(document).on("click", ".js--setup-convert-datetime-timestamp", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/setup/convert-datetime-timestamp",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#DateTimeTimestamp').length > 0 )
                {
                    $('#DateTimeTimestamp').modal('hide');
                    $('#DateTimeTimestamp').remove();
                }
                $('body').append(response.view_content);
                $('#DateTimeTimestamp').modal('show');

            } else {
                $('#DateTimeTimestamp').modal('hide');
                $('#DateTimeTimestamp').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
                return false;
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire({
                title: data.ajax_title_response,
                text: data.ajax_message_response,
                icon: data.ajax_status_response,
                customClass: {
                confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
            return false;
        }
    });
});



$("body").delegate('.js--setup-convert-datetime-timestamp-confirm', 'click',function(e){
    e.preventDefault();
    $( '#timestamp_year-error' ).html( "" );
    $( '#timestamp_month-error' ).html( "" );
    $( '#timestamp_day-error' ).html( "" );
    $( '#timestamp_hour-error' ).html( "" );
    $( '#timestamp_minutes-error' ).html( "" );
    $( '#timestamp_secounds-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var timestamp_year = $( "#timestamp_year" ).val();
    var timestamp_month = $( "#timestamp_month" ).val();
    var timestamp_day = $( "#timestamp_day" ).val();
    var timestamp_hour = $( "#timestamp_hour" ).val();
    var timestamp_minutes = $( "#timestamp_minutes" ).val();
    var timestamp_secounds = $( "#timestamp_secounds" ).val();

    formData.append("_token", _token);
    formData.append("timestamp_year", timestamp_year);
    formData.append("timestamp_month", timestamp_month);
    formData.append("timestamp_day", timestamp_day);
    formData.append("timestamp_hour", timestamp_hour);
    formData.append("timestamp_minutes", timestamp_minutes);
    formData.append("timestamp_secounds", timestamp_secounds);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/setup/convert-datetime-timestamp");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    
                    $('#concatenation_output').html('<strong>'+ data.concatenation_output + '</strong>');
                    $('#concatenation_output_to_datestring').html('<strong>'+ data.concatenation_output_to_datestring + '</strong>');

                } else {

                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.timestamp_year){
                    $( '#timestamp_year-error' ).html( data.errors.timestamp_year[0] );
                }
                if(data.errors.timestamp_month){
                    $( '#timestamp_month-error' ).html( data.errors.timestamp_month[0] );
                }
                if(data.errors.timestamp_day){
                    $( '#timestamp_day-error' ).html( data.errors.timestamp_day[0] );
                }
                if(data.errors.timestamp_hour){
                    $( '#timestamp_hour-error' ).html( data.errors.timestamp_hour[0] );
                }
                if(data.errors.timestamp_minutes){
                    $( '#timestamp_minutes-error' ).html( data.errors.timestamp_minutes[0] );
                }
                if(data.errors.timestamp_secounds){
                    $( '#timestamp_secounds-error' ).html( data.errors.timestamp_secounds[0] );
                }
            }
        }
        if (request.status==405){
            $('#DateTimeTimestamp').modal('hide');
            $('#DateTimeTimestamp').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


$(document).on("click", ".js--setup-convert-timestamp-datetime", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/setup/convert-timestamp-datetime",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#TimestampDateTime').length > 0 )
                {
                    $('#TimestampDateTime').modal('hide');
                    $('#TimestampDateTime').remove();
                }
                $('body').append(response.view_content);
                $('#TimestampDateTime').modal('show');

            } else {
                $('#TimestampDateTime').modal('hide');
                $('#TimestampDateTime').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
                return false;
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire({
                title: data.ajax_title_response,
                text: data.ajax_message_response,
                icon: data.ajax_status_response,
                customClass: {
                confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
            return false;
        }
    });
});


$("body").delegate('.js--setup-convert-timestamp-datetime-confirm', 'click',function(e){
    e.preventDefault();
    $( '#timestamp_error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var timestamp = $( "#timestamp" ).val();

    formData.append("_token", _token);
    formData.append("timestamp", timestamp);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/setup/convert-timestamp-datetime");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    
                    $('#concatenation_output').html('<strong>'+ data.concatenation_output + '</strong>');
                    $('#concatenation_output_to_datestring').html('<strong>'+ data.concatenation_output_to_datestring + '</strong>');


                } else {

                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.timestamp){
                    $( '#timestamp-error' ).html( data.errors.timestamp[0] );
                }
                if(data.errors.form_corruption){
                    $('#form_corruption-error').html( data.errors.form_corruption[0] );
                }
            }
        }
        if (request.status==405){
            $('#TimestampDateTime').modal('hide');
            $('#TimestampDateTime').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


// Clubs

$(document).on('hidden.bs.modal', '.modal', function () { $("#ClubsCreate").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#ClubsEdit").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#ClubsDestroy").remove(); $(".modal-dialog").remove(); });

$(document).on("click", ".js--clubs-create", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/clubs/create",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#ClubsCreate').length > 0 )
                {
                    $('#ClubsCreate').modal('hide');
                    $('#ClubsCreate').remove();
                }
                $('body').append(response.view_content);
                $('#ClubsCreate').modal('show');

            } else {
                $('#ClubsCreate').modal('hide');
                $('#ClubsCreate').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
                return false;
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire({
                title: data.ajax_title_response,
                text: data.ajax_message_response,
                icon: data.ajax_status_response,
                customClass: {
                confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
            return false;
        }
    });
});


$("body").delegate('.js--clubs-create-store', 'click',function(e){
    e.preventDefault();
    $( '#clubs-error' ).html( "" );
    $( '#stage_id-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var clubs = $("input[name='clubs[]']").map(function(){return $(this).val();}).get();
    var stage_id = parseInt($("#stage_id").val());

    formData.append("_token", _token);
    formData.append("clubs", clubs);
    formData.append("stage_id", stage_id);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/clubs/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 2000);
                    $('#ClubsCreate').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ClubsCreate').modal('hide');
                    $('#ClubsCreate').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    $('#ClubsCreate').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ClubsCreate').modal('hide');
                    $('#ClubsCreate').modal('toggle');
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    return false;
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.clubs){
                    $('#clubs-error').html( data.errors.clubs[0] );
                }
                if(data.errors.stage_id){
                    $('#stage_id-error').html( data.errors.stage_id[0] );
                }
                if(data.errors.form_corruption){
                    $('#form_corruption-error').html( data.errors.form_corruption[0] );
                }
                $("#ClubsCreate").scrollTop(0);
            }
        }
        if (request.status==405){
            $('#ClubsCreate').modal('hide');
            $('#ClubsCreate').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


$(document).on("click", ".js--clubs-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/clubs/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#ClubsEdit').length > 0 )
                {
                    $('#ClubsEdit').modal('hide');
                    $('#ClubsEdit').remove();
                }
                $('body').append(response.view_content);
                $('#ClubsEdit').modal('show');

            } else {
                $('#ClubsEdit').modal('hide');
                $('#ClubsEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--clubs-update', 'click',function(e){
    e.preventDefault();
    $( '#name-error' ).html( "" );
    $( '#stage_id-error' ).html( "" );
    $( '#climbing-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var name = $("input[name='name']").val();
    var stage_id = parseInt($("#stage_id").val());
    var climbing = parseInt($("#climbing").val());

    formData.append("_token", _token);
    formData.append("name", name);
    formData.append("stage_id", stage_id);
    formData.append("climbing", climbing);
    

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/clubs/"+ $(this).data('id') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#ClubsEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ClubsEdit').modal('hide');
                    $('#ClubsEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    $('#ClubsEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ClubsEdit').modal('hide');
                    $('#ClubsEdit').modal('toggle');
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    return false;
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.name){
                    $( '#name-error' ).html( data.errors.name[0] );
                }
                if(data.errors.stage_id){
                    $( '#stage_id-error' ).html( data.errors.stage_id[0] );
                }
                if(data.errors.climbing){
                    $( '#climbing-error' ).html( data.errors.climbing[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#ClubsEdit").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#ClubsEdit').modal('hide');
            $('#ClubsEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


$(document).on("click", ".js--clubs-destroy", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/clubs/"+ $(this).data('id') +"/destroy",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#ClubsDestroy').length > 0 )
                {
                    $('#ClubsDestroy').modal('hide');
                    $('#ClubsDestroy').remove();
                }
                $('body').append(response.view_content);
                $('#ClubsDestroy').modal('show');

            } else {
                $('.modal-backdrop').remove();
                $('#ClubsDestroy').modal('hide');
                $('#ClubsDestroy').remove();
                data = JSON.parse(request.responseText);
                Swal.fire({
                    title: data.ajax_title_response,
                    text: data.ajax_message_response,
                    icon: data.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                return false;
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--clubs-destroy-confirm', 'click',function(e){
    e.preventDefault();
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    formData.append("_token", _token);
    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/clubs/"+ $(this).data('id') +"/destroy");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#ClubsDestroy').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ClubsDestroy').modal('hide');
                    $('#ClubsDestroy').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#ClubsDestroy").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#ClubsDestroy').modal('hide');
            $('#ClubsDestroy').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

// Teams

$(document).on('hidden.bs.modal', '.modal', function () { $("#TeamsCreate").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#TeamsEdit").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#TeamsDestroy").remove(); $(".modal-dialog").remove(); });

$(document).on("click", ".js--teams-create", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/teams/create",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#TeamsCreate').length > 0 )
                {
                    $('#TeamsCreate').modal('hide');
                    $('#TeamsCreate').remove();
                }
                $('body').append(response.view_content);
                $('#TeamsCreate').modal('show');

            } else {
                $('#TeamsCreate').modal('hide');
                $('#TeamsCreate').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
                return false;
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire({
                title: data.ajax_title_response,
                text: data.ajax_message_response,
                icon: data.ajax_status_response,
                customClass: {
                confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
            return false;
        }
    });
});

$("body").delegate('.js--teams-create-store', 'click',function(e){
    e.preventDefault();
    $( '#club_id-error' ).html( "" );
    $( '#name-error' ).html( "" );
    $( '#category_id-error' ).html( "" );
    $( '#number-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var club_id = parseInt($("#club_id").val());
    var name = $("input[name='name']").val();
    var category_id = parseInt($("#category_id").val());
    var number = parseInt($( "#number" ).val());

    formData.append("_token", _token);
    formData.append("club_id", parseInt(club_id));
    formData.append("name", name);
    formData.append("category_id", parseInt(category_id));
    if (number !== '' && !isNaN(number)) {
        formData.append("number", parseInt(number));
    }


    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/teams/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#TeamsCreate').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#TeamsCreate').modal('hide');
                    $('#TeamsCreate').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    $('#TeamsCreate').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#TeamsCreate').modal('hide');
                    $('#TeamsCreate').modal('toggle');
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    return false;
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.club_id){
                    $( '#club_id-error' ).html( data.errors.club_id[0] );
                }
                if(data.errors.name){
                    $( '#name-error' ).html( data.errors.name[0] );
                }
                if(data.errors.category_id){
                    $( '#category_id-error' ).html( data.errors.category_id[0] );
                }
                if(data.errors.number){
                    $( '#number-error' ).html( data.errors.number[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#TeamsCreate").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#TeamsCreate').modal('hide');
            $('#TeamsCreate').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

$(document).on("click", ".js--teams-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/teams/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#TeamsEdit').length > 0 )
                {
                    $('#TeamsEdit').modal('hide');
                    $('#TeamsEdit').remove();
                }
                $('body').append(response.view_content);
                $('#TeamsEdit').modal('show');

            } else {
                $('#TeamsEdit').modal('hide');
                $('#TeamsEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--teams-update', 'click',function(e){
    e.preventDefault();
    $( '#club_id-error' ).html( "" );
    $( '#name-error' ).html( "" );
    $( '#category_id-error' ).html( "" );
    $( '#number-error' ).html( "" );
    $( '#chipno-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var club_id = parseInt($("#club_id").val());
    var name = $("input[name='name']").val();
    var category_id = parseInt($("#category_id").val());
    var number = parseInt($( "#number" ).val());
    var chipno = parseInt($( "#chipno" ).val());

    formData.append("_token", _token);
    formData.append("club_id", parseInt(club_id));
    formData.append("name", name);
    formData.append("category_id", parseInt(category_id));

    if (number !== '' && !isNaN(number)) {
        formData.append("number", parseInt(number));
    }

    if (chipno !== '' && !isNaN(chipno)) {
        formData.append("chipno", parseInt(chipno));
    }
    
    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/teams/"+ $(this).data('id') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#TeamsEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#TeamsEdit').modal('hide');
                    $('#TeamsEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    $('#TeamsEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#TeamsEdit').modal('hide');
                    $('#TeamsEdit').modal('toggle');
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    return false;
                }
            } else {
            
                printErrorMsg(data.errors);
                if(data.errors.club_id){
                    $( '#club_id-error' ).html( data.errors.club_id[0] );
                }
                if(data.errors.name){
                    $( '#name-error' ).html( data.errors.name[0] );
                }
                if(data.errors.category_id){
                    $( '#category_id-error' ).html( data.errors.category_id[0] );
                }
                if(data.errors.number){
                    $( '#number-error' ).html( data.errors.number[0] );
                }
                if(data.errors.chipno){
                    $( '#chipno-error' ).html( data.errors.chipno[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#TeamsCreate").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#TeamsEdit').modal('hide');
            $('#TeamsEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

$(document).on("click", ".js--teams-destroy", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/teams/"+ $(this).data('id') +"/destroy",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#TeamsDestroy').length > 0 )
                {
                    $('#TeamsDestroy').modal('hide');
                    $('#TeamsDestroy').remove();
                }
                $('body').append(response.view_content);
                $('#TeamsDestroy').modal('show');

            } else {
                $('#TeamsDestroy').modal('hide');
                $('#TeamsDestroy').modal('toggle');
                Swal.fire(response.ajax_title_response, response.ajax_message_response, response.ajax_status_response);
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--teams-destroy-confirm', 'click',function(e){
    e.preventDefault();
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    formData.append("_token", _token);
    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/teams/"+ $(this).data('id') +"/destroy");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#TeamsDestroy').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#TeamsDestroy').modal('hide');
                    $('#TeamsDestroy').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    swal(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#TeamsDestroy").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#TeamsDestroy').modal('hide');
            $('#TeamsDestroy').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


// Cultural

$(document).on('hidden.bs.modal', '.modal', function () { $("#CulturalEdit").remove(); $(".modal-dialog").remove(); });

$(document).on("click", ".js--cultural-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/cultural/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#CulturalEdit').length > 0 )
                {
                    $('#CulturalEdit').modal('hide');
                    $('#CulturalEdit').remove();
                }
                $('body').append(response.view_content);
                $('#CulturalEdit').modal('show');

            } else {
                $('#CulturalEdit').modal('hide');
                $('#CulturalEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--cultural-update', 'click',function(e){
    e.preventDefault();
    $( '#scor-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var scor = parseInt($("#scor").val());

    formData.append("_token", _token);
    formData.append("scor", parseInt(scor));

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/cultural/"+ $(this).data('id') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#CulturalEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#CulturalEdit').modal('hide');
                    $('#CulturalEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.scor){
                    $( '#scor-error' ).html( data.errors.scor[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#CulturalEdit").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#CulturalEdit').modal('hide');
            $('#CulturalEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

// Knowledge

$(document).on('hidden.bs.modal', '.modal', function () { $("#KnowledgeEdit").remove(); $(".modal-dialog").remove(); });

$(document).on("click", ".js--knowledge-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/knowledge/"+ $(this).data('categoryid') + "/"+ $(this).data('teamid') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#KnowledgeEdit').length > 0 )
                {
                    $('#KnowledgeEdit').modal('hide');
                    $('#KnowledgeEdit').remove();
                }
                $('body').append(response.view_content);
                $('#KnowledgeEdit').modal('show');

            } else {
                $('#KnowledgeEdit').modal('hide');
                $('#KnowledgeEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});

$("body").delegate('.js--knowledge-update', 'click',function(e){
    e.preventDefault();
    $( '#time-error' ).html( "" );
    $( '#wrong_answers-error' ).html( "" );
    $( '#wrong_questions-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var time = $("input[name='time']").val();
    var wrong_answers = $( "#wrong_answers" ).val();
    var wrong_questions = $("input[name='wrong_questions']").val();
    var abandon = $( "#abandon" ).val();

    formData.append("_token", _token);
    formData.append("time", time);
    formData.append("wrong_answers", wrong_answers);
    formData.append("wrong_questions", wrong_questions);
    formData.append("abandon", abandon);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/knowledge/"+ $(this).data('categoryid') + "/"+ $(this).data('teamid') +"/edit",);
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#KnowledgeEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#KnowledgeEdit').modal('hide');
                    $('#KnowledgeEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.time){
                    $( '#time-error' ).html( data.errors.time[0] );
                }
                if(data.errors.wrong_answers){
                    $( '#wrong_answers-error' ).html( data.errors.wrong_answers[0] );
                }
                if(data.errors.wrong_questions){
                    $( '#wrong_questions-error' ).html( data.errors.wrong_questions[0] );
                }
                if(data.errors.abandon){
                    $( '#abandon-error' ).html( data.errors.abandon[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#KnowledgeEdit").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#KnowledgeEdit').modal('hide');
            $('#KnowledgeEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

// Orienteering

$(document).on('hidden.bs.modal', '.modal', function () { $("#OrienteeringEdit").remove(); $(".modal-dialog").remove(); });

$(document).on("click", ".js--orienteering-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/orienteering/"+ $(this).data('categoryid') + "/"+ $(this).data('teamid') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#OrienteeringEdit').length > 0 )
                {
                    $('#OrienteeringEdit').modal('hide');
                    $('#OrienteeringEdit').remove();
                }
                $('body').append(response.view_content);
                $('#OrienteeringEdit').modal('show');

            } else {
                $('#OrienteeringEdit').modal('hide');
                $('#OrienteeringEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});

$("body").delegate('.js--orienteering-update', 'click',function(e){
    e.preventDefault();
    $( '#start_time-error' ).html( "" );
    $( '#finish_time-error' ).html( "" );
    $( '#missed_posts-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var start_time = $("input[name='start_time']").val();
    var finish_time = $( "#finish_time" ).val();
    var missed_posts = $("input[name='missed_posts']").val();
    var abandon = $( "#abandon" ).val();

    formData.append("_token", _token);
    formData.append("start_time", start_time);
    formData.append("finish_time", finish_time);
    formData.append("missed_posts", missed_posts);
    formData.append("abandon", abandon);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/orienteering/"+ $(this).data('categoryid') + "/"+ $(this).data('teamid') +"/edit",);
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#OrienteeringEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#OrienteeringEdit').modal('hide');
                    $('#OrienteeringEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.start_time){
                    $( '#start_time-error' ).html( data.errors.start_time[0] );
                }
                if(data.errors.finish_time){
                    $( '#finish_time-error' ).html( data.errors.finish_time[0] );
                }
                if(data.errors.missed_posts){
                    $( '#missed_posts-error' ).html( data.errors.missed_posts[0] );
                }
                if(data.errors.abandon){
                    $( '#abandon-error' ).html( data.errors.abandon[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                if(data.errors.start_finish_time){
                    $( '#start_finish_time-error' ).html( data.errors.start_finish_time[0] );
                }
                $("#OrienteeringEdit").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#OrienteeringEdit').modal('hide');
            $('#OrienteeringEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});



// RaidMontan

$(document).on('hidden.bs.modal', '.modal', function () { $("#RaidMontanEdit").remove(); $(".modal-dialog").remove(); });

$(document).on("click", ".js--raidmontan-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/raidmontan/"+ $(this).data('categoryid') + "/"+ $(this).data('teamid') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#RaidMontanEdit').length > 0 )
                {
                    $('#RaidMontanEdit').modal('hide');
                    $('#RaidMontanEdit').remove();
                }
                $('body').append(response.view_content);
                $('#RaidMontanEdit').modal('show');

            } else {
                $('#RaidMontanEdit').modal('hide');
                $('#RaidMontanEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--raidmontan-update', 'click',function(e){
    e.preventDefault();
    $( '#missing_footwear-error' ).html( "" );
    $( '#missing_equipment_items-error' ).html( "" );
    $( '#minimum_distance_penalty-error' ).html( "" );
    $( '#abandon-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var missing_footwear = $("#missing_footwear").is(":checked")
    var missing_equipment_items = $( "#missing_equipment_items" ).val();
    var minimum_distance_penalty = $("#minimum_distance_penalty").is(":checked")
    var pfa_stations = $("input[name='pfa_stations[]']").map(function(){return $(this).is(":checked");}).get();
    var pa_stations =  $('.pa-stations-row').map(function() {
        var $this = $(this),
        startTime = $this.find('.time-start').val(),
        finishTime = $this.find('.time-finish').val();
        return {
        'time_start': startTime,
        'time_finish': finishTime
      };
    }).get();
    var pa_stations = JSON.stringify(pa_stations);
    var station_start = $("input[name='station_start']").val();
    var station_finish = $("input[name='station_finish']").val();
    
    var abandon = $( "#abandon" ).val();

    formData.append("_token", _token);
    formData.append("missing_footwear", missing_footwear);
    formData.append("missing_equipment_items", missing_equipment_items);
    formData.append("minimum_distance_penalty", minimum_distance_penalty);
    formData.append("pfa_stations", pfa_stations);
    formData.append("pa_stations", pa_stations);
    formData.append("station_start", station_start);
    formData.append("station_finish", station_finish);
    formData.append("abandon", abandon);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/raidmontan/"+ $(this).data('categoryid') + "/"+ $(this).data('teamid') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#RaidMontanEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#RaidMontanEdit').modal('hide');
                    $('#RaidMontanEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.missing_footwear){
                    $( '#missing_footwear-error' ).html( data.errors.missing_footwear[0] );
                }
                if(data.errors.missing_equipment_items){
                    $( '#missing_equipment_items-error' ).html( data.errors.missing_equipment_items[0] );
                }
                if(data.errors.minimum_distance_penalty){
                    $( '#minimum_distance_penalty-error' ).html( data.errors.minimum_distance_penalty[0] );
                }
                if(data.errors.pfa_stations){
                    $( '#pfa_stations-error' ).html( data.errors.pfa_stations[0] );
                }
                if(data.errors.pa_stations){
                    $( '#pa_stations-error' ).html( data.errors.pa_stations[0] );
                }
                if(data.errors.station_start){
                    $( '#station_start-error' ).html( data.errors.station_start[0] );
                }
                if(data.errors.station_finish){
                    $( '#station_finish-error' ).html( data.errors.station_finish[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#RaidMontanEdit").scrollTop(0);
            }
        }
        if (request.status==405){
            $('#RaidMontanEdit').modal('hide');
            $('#RaidMontanEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


// Setup Raid Montan

$(document).on('hidden.bs.modal', '.modal', function () { $("#SetupRaidMontanEdit").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#SetupRaidMontanStagesEdit").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#SetupOrienteeringStagesEdit").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#TrophyCreate").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#SetupCleanUp").remove(); $(".modal-dialog").remove(); });


$(document).on("click", ".js--setup-raid-montan-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/setup/raid-montan/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#SetupRaidMontanEdit').length > 0 )
                {
                    $('#SetupRaidMontanEdit').modal('hide');
                    $('#SetupRaidMontanEdit').remove();
                }
                $('body').append(response.view_content);
                $('#SetupRaidMontanEdit').modal('show');

            } else {
                $('#SetupRaidMontanEdit').modal('hide');
                $('#SetupRaidMontanEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--setup-raid-montan-update', 'click',function(e){
    e.preventDefault();
    $( '#stations_pa-error' ).html( "" );
    $( '#stations_pfa-error' ).html( "" );
    $( '#stations_finish-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var stations_pa = $("input[name='stations_pa[]']").map(function(){
        var val = $(this).val();
        return val === '' ? '' : parseInt(val);
    }).get();
    
    var stations_pfa = $("input[name='stations_pfa[]']").map(function(){
        var val = $(this).val();
        return val === '' ? '' : parseInt(val);
    }).get();
    
    var stations_finish = $("input[name='stations_finish']").val() || '';


    formData.append("_token", _token);
    formData.append("stations_pa", JSON.stringify(stations_pa));
    formData.append("stations_pfa", JSON.stringify(stations_pfa));    
    formData.append("stations_finish", stations_finish);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/setup/raid-montan/"+ $(this).data('id') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#SetupRaidMontanEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#SetupRaidMontanEdit').modal('hide');
                    $('#SetupRaidMontanEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMESSAGE(data.errors);
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#SetupRaidMontanEdit").scrollTop(0);
            }
        }
        if (request.status==405){
            $('#SetupRaidMontanEdit').modal('hide');
            $('#SetupRaidMontanEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor! Unul sau mai multe campuri este introdus gresit', 'error')
            $("#SetupRaidMontanEdit").scrollTop(0);
        }
    }
});


$(document).on("click", ".js--setup-raid-montan-stages-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/setup/raid-montan/stages/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#SetupRaidMontanStagesEdit').length > 0 )
                {
                    $('#SetupRaidMontanStagesEdit').modal('hide');
                    $('#SetupRaidMontanStagesEdit').remove();
                }
                $('body').append(response.view_content);
                $('#SetupRaidMontanStagesEdit').modal('show');

            } else {
                $('#SetupRaidMontanStagesEdit').modal('hide');
                $('#SetupRaidMontanStagesEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--setup-raid-montan-stages-update', 'click',function(e){
    e.preventDefault();
    $( '#post-error' ).html( "" );
    $( '#time-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $('.form-control').removeClass('is-invalid');
    $('.invalid-feedback').remove();
    $('.print-error-msg').hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var start_251 = $("input[name='start_251']").val();
    var finish_252 = $("input[name='finish_252']").val();
    var post = {};

    $("input[name^='post']").each(function () {
        var input = $(this);
        var name = input.attr('name'); // e.g. post[1]['arrived']
        var matches = name.match(/^post\[(\d+)\]\[(\w+)\]$/);
    
        if (matches) {
            var index = matches[1];  // e.g. 1
            var key = matches[2];    // e.g. 'arrived' or 'go' or 'time'
    
            if (!post[index]) {
                post[index] = {};
            }
    
            post[index][key] = input.val();
        }
    });
    

    formData.append("_token", _token);
    formData.append("start_251", start_251);
    formData.append("post", JSON.stringify(post));
    formData.append("finish_252", finish_252);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/setup/raid-montan/stages/"+ $(this).data('id') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#SetupRaidMontanStagesEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#SetupRaidMontanStagesEdit').modal('hide');
                    $('#SetupRaidMontanStagesEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                printErrorMESSAGE(data.errors);
                if(data.errors.post){
                    $( '#post-error' ).html( data.errors.post[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#SetupRaidMontanStagesEdit").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#SetupRaidMontanStagesEdit').modal('hide');
            $('#SetupRaidMontanStagesEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

$(document).on("click", ".js--setup-orienteering-stages-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/setup/orienteering/stages/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#SetupOrienteeringStagesEdit').length > 0 )
                {
                    $('#SetupOrienteeringStagesEdit').modal('hide');
                    $('#SetupOrienteeringStagesEdit').remove();
                }
                $('body').append(response.view_content);
                $('#SetupOrienteeringStagesEdit').modal('show');

            } else {
                $('#SetupOrienteeringStagesEdit').modal('hide');
                $('#SetupOrienteeringStagesEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--setup-orienteering-stages', 'click',function(e){
    e.preventDefault();
    $( '#post-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var post = $("input[name='post[]']").map(function(){return $(this).val();}).get();


    formData.append("_token", _token);
    formData.append("post", post);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/setup/orienteering/stages/"+ $(this).data('id') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#SetupOrienteeringStagesEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#SetupOrienteeringStagesEdit').modal('hide');
                    $('#SetupOrienteeringStagesEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.post){
                    $( '#post-error' ).html( data.errors.post[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#SetupOrienteeringStagesEdit").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#SetupOrienteeringStagesEdit').modal('hide');
            $('#SetupOrienteeringStagesEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

$(document).on("click", ".js--trophy-setup", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/setup/trophy",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#TrophyCreate').length > 0 )
                {
                    $('#TrophyCreate').modal('hide');
                    $('#TrophyCreate').remove();
                }
                $('body').append(response.view_content);
                $('#TrophyCreate').modal('show');

            } else {
                $('#TrophyCreate').modal('hide');
                $('#TrophyCreate').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--trophy-setup-update', 'click',function(e){
    e.preventDefault();
    $( '#name-error' ).html( "" );
    $( '#ong-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var name = $("input[name='name']").val();
    var ong = $("input[name='ong']").val();

    formData.append("_token", _token);
    formData.append("name", name);
    formData.append("ong", ong);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/setup/trophy");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#TrophyCreate').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#TrophyCreate').modal('hide');
                    $('#TrophyCreate').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.name){
                    $( '#name-error' ).html( data.errors.name[0] );
                }
                if(data.errors.ong){
                    $( '#ong-error' ).html( data.errors.ong[0] );
                }
                $("#TrophyCreate").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#TrophyCreate').modal('hide');
            $('#TrophyCreate').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


$(document).on("click", ".js--team-order-start", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/" + $(this).data('stageid') + "/setup/order-start",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#TeamOrderStart').length > 0 )
                {
                    $('#TeamOrderStart').modal('hide');
                    $('#TeamOrderStart').remove();
                }
                $('body').append(response.view_content);
                $('#TeamOrderStart').modal('show');

            } else {
                $('#TeamOrderStart').modal('hide');
                $('#TeamOrderStart').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--team-order-start-update', 'click',function(e){
    e.preventDefault();
    $('#category_1-error').html( "" );
    $('#category_2-error').html( "" );
    $('#category_3-error').html( "" );
    $('#category_4-error').html( "" );
    $('#category_5-error').html( "" );
    $('#category_6-error').html( "" );
    $('#category_7-error').html( "" );
    $('#order_date_start-error').html( "" );
    $('#order_start_minutes-error').html( "" );
    $('#form_corruption-error').html( "" );
    $('.print-error-msg').hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var category_1 = $("#category_1").val();
    var category_2 = $("#category_2").val();
    var category_3 = $("#category_3").val();
    var category_4 = $("#category_4").val();
    var category_5 = $("#category_5").val();
    var category_6 = $("#category_6").val();
    var category_7 = $("#category_7").val();
    var order_date_start = $("input[name='order_date_start']").val();
    var order_start_minutes = $("#order_start_minutes").val();

    formData.append("_token", _token);
    formData.append("category_1", category_1);
    formData.append("category_2", category_2);
    formData.append("category_3", category_3);
    formData.append("category_4", category_4);
    formData.append("category_5", category_5);
    formData.append("category_6", category_6);
    formData.append("category_7", category_7);
    formData.append("order_date_start", order_date_start);
    formData.append("order_start_minutes", order_start_minutes);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/setup/order-start");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    window.setTimeout(function() {
                        window.location.href = data.ajax_redirect_url;
                    }, 1000);
                    $('#TeamOrderStart').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#TeamOrderStart').modal('hide');
                    $('#TeamOrderStart').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.category_1){
                    $( '#category_1-error' ).html( data.errors.category_1[0] );
                }
                if(data.errors.category_2){
                    $( '#category_2-error' ).html( data.errors.category_2[0] );
                }
                if(data.errors.category_3){
                    $( '#category_3-error' ).html( data.errors.category_3[0] );
                }
                if(data.errors.category_4){
                    $( '#category_4-error' ).html( data.errors.category_4[0] );
                }
                if(data.errors.category_5){
                    $( '#category_5-error' ).html( data.errors.category_5[0] );
                }
                if(data.errors.category_6){
                    $( '#category_6-error' ).html( data.errors.category_6[0] );
                }
                if(data.errors.category_7){
                    $( '#category_7-error' ).html( data.errors.category_7[0] );
                }
                if(data.errors.order_date_start){
                    $( '#order_date_start-error' ).html( data.errors.order_date_start[0] );
                }
                if(data.errors.order_start_minutes){
                    $( '#order_start_minutes-error' ).html( data.errors.order_start_minutes[0] );
                }
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#TeamOrderStart").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#TeamOrderStart').modal('hide');
            $('#TeamOrderStart').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


$("body").delegate('.js--setup-clean-up', 'click',function(e){
    e.preventDefault();
    $( '#delete_clubs-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var delete_teams = $("#delete_teams").is(":checked")
    var delete_config_raid_montan = $("#delete_config_raid_montan").is(":checked")
    var delete_config_orienteering = $("#delete_config_orienteering").is(":checked")
    var delete_rezults_raid_montan = $("#delete_rezults_raid_montan").is(":checked")
    var delete_rezults_orienteering = $("#delete_rezults_orienteering").is(":checked")
    var delete_rezults_knowledge = $("#delete_rezults_knowledge").is(":checked")
    var delete_rezults_cultural = $("#delete_rezults_cultural").is(":checked")

    formData.append("_token", _token);
    formData.append("delete_teams", delete_teams);
    formData.append("delete_config_raid_montan", delete_config_raid_montan);
    formData.append("delete_config_orienteering", delete_config_orienteering);
    formData.append("delete_rezults_raid_montan", delete_rezults_raid_montan);
    formData.append("delete_rezults_orienteering", delete_rezults_orienteering);
    formData.append("delete_rezults_knowledge", delete_rezults_knowledge);
    formData.append("delete_rezults_cultural", delete_rezults_cultural);

    var request = new XMLHttpRequest();
    request.open("POST", "/" + $(this).data('stageid') + "/setup/destroy");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: response.ajax_title_response,
                        text: response.ajax_message_response,
                        icon: response.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-success'
                        },
                        buttonsStyling: false
                    });
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.delete_teams){
                    $( '#delete_teams-error' ).html( data.errors.delete_teams[0] );
                }
                if(data.errors.delete_config_raid_montan){
                    $( '#delete_config_raid_montan-error' ).html( data.errors.delete_config_raid_montan[0] );
                }
                if(data.errors.delete_config_orienteering){
                    $( '#delete_config_orienteering-error' ).html( data.errors.delete_config_orienteering[0] );
                }
                if(data.errors.delete_rezults_raid_montan){
                    $( '#delete_rezults_raid_montan-error' ).html( data.errors.delete_rezults_raid_montan[0] );
                }
                if(data.errors.delete_rezults_orienteering){
                    $( '#delete_rezults_orienteering-error' ).html( data.errors.delete_rezults_orienteering[0] );
                }
                if(data.errors.delete_rezults_knowledge){
                    $( '#delete_rezults_knowledge-error' ).html( data.errors.delete_rezults_knowledge[0] );
                }
                if(data.errors.delete_rezults_cultural){
                    $( '#delete_rezults_cultural-error' ).html( data.errors.delete_rezults_cultural[0] );
                }
                $("#SetupCleanUp").scrollTop( 0 );
            }
        }
        if (request.status==405){
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

// Participants

$(document).on('hidden.bs.modal', '.modal', function () { $("#ParticipantsCreate").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#ParticipantsEdit").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#ParticipantsDestroy").remove(); $(".modal-dialog").remove(); });

$(document).on("click", ".js--participants-create", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/participants/create",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#ParticipantsCreate').length > 0 )
                {
                    $('#ParticipantsCreate').modal('hide');
                    $('#ParticipantsCreate').remove();
                }
                $('body').append(response.view_content);
                $('#ParticipantsCreate').modal('show');

            } else {
                $('#ParticipantsCreate').modal('hide');
                $('#ParticipantsCreate').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-primary'
                    },
                    buttonsStyling: false
                });
                return false;
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire({
                title: data.ajax_title_response,
                text: data.ajax_message_response,
                icon: data.ajax_status_response,
                customClass: {
                confirmButton: 'btn btn-primary'
                },
                buttonsStyling: false
            });
            return false;
        }
    });
});


$("body").delegate('.js--participants-create-store', 'click',function(e){
    e.preventDefault();
    $( '#participants-error' ).html( "" );
    $( '#ci-error' ).html( "" );
    $( '#phone-error' ).html( "" );
    $( '#name-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var ci = $("#ci").val();
    var phone = $("#phone").val();
    var name = $("#name").val();

    formData.append("_token", _token);
    formData.append("ci", ci);
    formData.append("phone", phone);
    formData.append("name", name);

    var request = new XMLHttpRequest();
    request.open("POST", "/participants/create");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    $('#participants-list').DataTable().ajax.reload();
                    $('#ParticipantsCreate').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ParticipantsCreate').modal('hide');
                    $('#ParticipantsCreate').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    $('#participants-list').DataTable().ajax.reload();
                    $('#ParticipantsCreate').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ParticipantsCreate').modal('hide');
                    $('#ParticipantsCreate').modal('toggle');
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    return false;
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.name){
                    $( '#name-error' ).html( data.errors.name[0] );
                }
                if(data.errors.ci){
                    $( '#ci-error' ).html( data.errors.ci[0] );
                }
                if(data.errors.phone){
                    $( '#phone-error' ).html( data.errors.phone[0] );
                }
                if(data.errors.form_corruption){
                    $('#form_corruption-error').html( data.errors.form_corruption[0] );
                }
                $("#ParticipantsCreate").scrollTop(0);
            }
        }
        if (request.status==405){
            $('#ParticipantsCreate').modal('hide');
            $('#ParticipantsCreate').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


$(document).on("click", ".js--participants-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/participants/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#ParticipantsEdit').length > 0 )
                {
                    $('#ParticipantsEdit').modal('hide');
                    $('#ParticipantsEdit').remove();
                }
                $('body').append(response.view_content);
                $('#ParticipantsEdit').modal('show');

            } else {
                $('#ParticipantsEdit').modal('hide');
                $('#ParticipantsEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--participants-update', 'click',function(e){
    e.preventDefault();
    $( '#participants-error' ).html( "" );
    $( '#ci-error' ).html( "" );
    $( '#phone-error' ).html( "" );
    $( '#name-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var ci = $("#ci").val();
    var phone = $("#phone").val();
    var name = $("#name").val();

    formData.append("_token", _token);
    formData.append("ci", ci);
    formData.append("phone", phone);
    formData.append("name", name);

    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"+ $(this).data('id') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    $('#participants-list').DataTable().ajax.reload();
                    $('#ParticipantsEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ParticipantsEdit').modal('hide');
                    $('#ParticipantsEdit').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    $('#participants-list').DataTable().ajax.reload();
                    $('#ParticipantsEdit').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ParticipantsEdit').modal('hide');
                    $('#ParticipantsEdit').modal('toggle');
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    return false;
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.name){
                    $( '#name-error' ).html( data.errors.name[0] );
                }
                if(data.errors.ci){
                    $( '#ci-error' ).html( data.errors.ci[0] );
                }
                if(data.errors.phone){
                    $( '#phone-error' ).html( data.errors.phone[0] );
                }
                if(data.errors.form_corruption){
                    $('#form_corruption-error').html( data.errors.form_corruption[0] );
                }
                $("#ParticipantsEdit").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#ParticipantsEdit').modal('hide');
            $('#ParticipantsEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


$(document).on("click", ".js--participants-destroy", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/participants/"+ $(this).data('id') +"/destroy",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#ParticipantsDestroy').length > 0 )
                {
                    $('#ParticipantsDestroy').modal('hide');
                    $('#ParticipantsDestroy').remove();
                }
                $('body').append(response.view_content);
                $('#ParticipantsDestroy').modal('show');

            } else {
                $('.modal-backdrop').remove();
                $('#ParticipantsDestroy').modal('hide');
                $('#ParticipantsDestroy').remove();
                data = JSON.parse(request.responseText);
                Swal.fire({
                    title: data.ajax_title_response,
                    text: data.ajax_message_response,
                    icon: data.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                return false;
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--participants-destroy-confirm', 'click',function(e){
    e.preventDefault();
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    formData.append("_token", _token);
    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"+ $(this).data('id') +"/destroy");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    $('#participants-list').DataTable().ajax.reload();
                    $('#ParticipantsDestroy').remove();
                    $('.modal-backdrop').remove();
                    $('.sidebar-mini').removeClass('modal-open');
                    $('#ParticipantsDestroy').modal('hide');
                    $('#ParticipantsDestroy').modal('toggle');
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#ParticipantsDestroy").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#ParticipantsDestroy').modal('hide');
            $('#ParticipantsDestroy').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});


// Participants Stages

// Participants

$(document).on('hidden.bs.modal', '.modal', function () { $("#ParticipantsStagesEdit").remove(); $(".modal-dialog").remove(); });
$(document).on('hidden.bs.modal', '.modal', function () { $("#ParticipantsStagesDestroy").remove(); $(".modal-dialog").remove(); });


$(document).on("click", ".js--participants-stages-edit", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/participants/"+ $(this).data('stageid') +"/"+ $(this).data('id') +"/edit",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#ParticipantsStagesEdit').length > 0 )
                {
                    $('#ParticipantsStagesEdit').modal('hide');
                    $('#ParticipantsStagesEdit').remove();
                }
                $('body').append(response.view_content);
                $('#ParticipantsStagesEdit').modal('show');
                $(".select2").select2();
                $(".max-length-3").select2({
                    maximumSelectionLength: 3,
                    placeholder: "Poți selecta maxim 3 participanti"
                });

            } else {
                $('#ParticipantsStagesEdit').modal('hide');
                $('#ParticipantsStagesEdit').modal('toggle');
                Swal.fire({
                    title: response.ajax_title_response,
                    text: response.ajax_message_response,
                    icon: response.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-success'
                    },
                    buttonsStyling: false
                });
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--participants-stages-update', 'click',function(e){
    e.preventDefault();
    $( '#participants-error' ).html( "" );
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    var participants = $("#participants").val();

    formData.append("_token", _token);
    formData.append("participants", participants);


    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"+ $(this).data('stageid') +"/"+ $(this).data('id') +"/edit");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    $('#participants-stages-list').DataTable().ajax.reload();
                    $('.modal-backdrop').remove();
                    if( $('#ParticipantsStagesEdit').length > 0 )
                    {
                        $('#ParticipantsStagesEdit').modal('hide');
                        $('#ParticipantsStagesEdit').remove();
                    }
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    $('#participants-stages-list').DataTable().ajax.reload();
                    $('.modal-backdrop').remove();
                    if( $('#ParticipantsStagesEdit').length > 0 )
                    {
                        $('#ParticipantsStagesEdit').modal('hide');
                        $('#ParticipantsStagesEdit').remove();
                    }
                    data = JSON.parse(request.responseText);
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-danger'
                        },
                        buttonsStyling: false
                    });
                    return false;
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.participants){
                    $( '#participants-error' ).html( data.errors.participants[0] );
                }
                if(data.errors.form_corruption){
                    $('#form_corruption-error').html( data.errors.form_corruption[0] );
                }
                $("#ParticipantsEdit").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#ParticipantsEdit').modal('hide');
            $('#ParticipantsEdit').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});

$(document).on("click", ".js--participants-stages-destroy", function(e){
    e.preventDefault();
    $.ajax({
        type: "GET",
        url: "/participants/"+ $(this).data('stageid') +"/"+ $(this).data('id') +"/destroy",
        dataType: 'html',
        success: function (view) {
            var response = jQuery.parseJSON(view);
            if(response.ajax_status_response == 'success'){
                $('.modal-backdrop').remove();
                if( $('#ParticipantsStagesDestroy').length > 0 )
                {
                    $('#ParticipantsStagesDestroy').modal('hide');
                    $('#ParticipantsStagesDestroy').remove();
                }
                $('body').append(response.view_content);
                $('#ParticipantsStagesDestroy').modal('show');

            } else {
                $('.modal-backdrop').remove();
                $('#ParticipantsStagesDestroy').modal('hide');
                $('#ParticipantsStagesDestroy').remove();
                data = JSON.parse(request.responseText);
                Swal.fire({
                    title: data.ajax_title_response,
                    text: data.ajax_message_response,
                    icon: data.ajax_status_response,
                    customClass: {
                    confirmButton: 'btn btn-danger'
                    },
                    buttonsStyling: false
                });
                return false;
            }

        },
        error: function (data) {
            data = JSON.parse(data.responseText);
            Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
        }
    });
});


$("body").delegate('.js--participants-stages-confirm', 'click',function(e){
    e.preventDefault();
    $( '#form_corruption-error' ).html( "" );
    $( '.print-error-msg' ).hide();
    var formData = new FormData();
    var _token = $("input[name='_token']").val();
    formData.append("_token", _token);
    var request = new XMLHttpRequest();
    request.open("POST", "/participants/"+ $(this).data('stageid') +"/"+ $(this).data('id') +"/destroy");
    request.setRequestHeader("X-Requested-With", "XMLHttpRequest");
    request.send(formData);
    request.onreadystatechange=function(){
        if (request.readyState==4 && request.status==200){
            data = JSON.parse(request.responseText);
            if($.isEmptyObject(data.errors)){
                if(data.ajax_status_response == 'success'){
                    $('#participants-stages-list').DataTable().ajax.reload();
                    $('.modal-backdrop').remove();
                    if( $('#ParticipantsStagesDestroy').length > 0 )
                    {
                        $('#ParticipantsStagesDestroy').modal('hide');
                        $('#ParticipantsStagesDestroy').remove();
                    }
                    Swal.fire({
                        title: data.ajax_title_response,
                        text: data.ajax_message_response,
                        icon: data.ajax_status_response,
                        customClass: {
                        confirmButton: 'btn btn-primary'
                        },
                        buttonsStyling: false
                    });
                    return false;
                } else {
                    data = JSON.parse(request.responseText);
                    Swal.fire(data.ajax_title_response, data.ajax_message_response, data.ajax_status_response);
                }
            } else {
                printErrorMsg(data.errors);
                if(data.errors.form_corruption){
                    $( '#form_corruption-error' ).html( data.errors.form_corruption[0] );
                }
                $("#ParticipantsStagesDestroy").scrollTop( 0 );
            }
        }
        if (request.status==405){
            $('#ParticipantsStagesDestroy').modal('hide');
            $('#ParticipantsStagesDestroy').modal('toggle');
            Swal.fire('Eroare!!', 'Eroare la validarea datelor!', 'error')
        }
    }
});
