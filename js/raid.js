/**
 * Created by WSergio on 24/06/2015.
 */
var stations = [0, 0, 0, 0];




$(document).ready(function() {

    $('.confirm-submit').click(function(e){
        e.preventDefault();
    });
    $('.confirm-ok').click(function(e){
        var $this = $(this)
            , formSelector = $this.data('form')
            , $form = $(formSelector)
            ;
        $('.modal').modal('hide');
        $form.submit();
    });



    if (typeof($.fn.inputmask) == 'function') {
        $(".time").inputmask("h:s:s",{ "placeholder": "hh:mm:ss" });
    }

    var $container = $('.cloneable');
    $container.cloneya({
        minimum      	: 3,
        valueClone      : true,
        dataClone       : false,
        deepClone       : false
    });

    $container.on('after_append.cloneya', function (event, toClone, newClone) {
        var $el = $(newClone);
        var selectValue = $el.find('select').val();
        var type = $el.data('type');
        $el.find('select').val(type);
        $el.find('.station-id').val('');
    });
    $container.on('after_append.cloneya after_delete.cloneya', function (event, toClone, newClone) {
        checkTheFuckingSelects();
    });


    $('.stations .station select').on('change', function(event) {
        var $select = $(this);
        var $parent = $select.parent();
        var type = $select.val();
        $parent.data('type', type);
        checkTheFuckingSelects();
    });

    checkTheFuckingSelects();
});


function checkTheFuckingSelects()
{
    stations = [0, 0, 0, 0];
    $('.stations').find('.station').each(function(i, el) {
        checkTheFuckingSelect(i, el);
    });
}
function checkTheFuckingSelect(i, el)
{
    var $el = $(el);
    var type = $el.data('type');
    stations[type]++;
    var types = ['S', 'PA', 'PFA', 'F'];
    var label = types[type];
    var index = stations[type];
    var valueLabel = '';


    if (type == 1) {
        label = label + "-" + index;
        valueLabel = "minute (timp maxim)";
    }
    else if (type == 2) {
        label = label + "-" + index;
        valueLabel = "puncte (scor)";
    } else {
    }
    $el.find('.number').html(label);
    $el.find('.label').html(label);
    $el.find('.value-label').html(valueLabel);

}