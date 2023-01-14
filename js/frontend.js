$(document).ready(function(c) {
    $('.alert-close').on('click', function(c){
        $('.calender-left').fadeOut('slow', function(c){
            $('.calender-left').remove();
        });
    });
});
$(document).ready(function(c) {
    $('.alert-close1').on('click', function(c){
        $('.calender-right').fadeOut('slow', function(c){
            $('.calender-right').remove();
        });
    });
});
$(document).ready(function(c) {
    $('.alert-close2').on('click', function(c){
        $('.graph').fadeOut('slow', function(c){
            $('.graph').remove();
        });
    });
});
$(document).ready(function(c) {
    $('.alert-close3').on('click', function(c){
        $('.site-report').fadeOut('slow', function(c){
            $('.site-report').remove();
        });
    });
});
$(document).ready(function(c) {
    $('.alert-close4').on('click', function(c){
        $('.total-sale').fadeOut('slow', function(c){
            $('.total-sale').remove();
        });
    });
});
$(document).ready(function(c) {
    $('.alert-close5').on('click', function(c){
        $('.to-do').fadeOut('slow', function(c){
            $('.to-do').remove();
        });
    });
});
$(document).ready(function(c) {
    $('.alert-close7').on('click', function(c){
        $('.user-trends').fadeOut('slow', function(c){
            $('.user-trends').remove();
        });
    });
});
$(document).ready(function(c) {
    $('.alert-close6').on('click', function(c){
        $('.world-map').fadeOut('slow', function(c){
            $('.world-map').remove();
        });
    });
});
(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
    (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
    m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

//ga('create', 'UA-48014931-1', 'codyhouse.co');
//ga('send', 'pageview');

jQuery(document).ready(function($){
    $('.close-carbon-adv').on('click', function(){
        $('#carbonads-container').hide();
    });
});
jQuery(document).ready(function() {
    jQuery('#vmap').vectorMap({
        map: 'world_en',
        backgroundColor: '#333333',
        color: '#ffffff',
        hoverOpacity: 0.7,
        selectedColor: '#666666',
        enableZoom: true,
        showTooltip: true,
        values: sample_data,
        scaleColors: ['#C8EEFF', '#006491'],
        normalizeFunction: 'polynomial'
    });
});


$(document).ready(function () {
    $('#horizontalTab,#horizontalTab1,#horizontalTab2').easyResponsiveTabs({
        type: 'default', //Types: default, vertical, accordion
        width: 'auto', //auto or any width like 600px
        fit: true   // 100% fit in a container
    });
});











var barChartData = {
    labels : ["Etapa I","Etapa II","Etapa III","Etapa IV","Etapa V","Etapa VI"],
    datasets : [
        {
            fillColor : "rgba(255, 137, 167, 0.78)",
            strokeColor : "rgba(220,220,220,1)",
            data : [65,59,90,81,56,55]
        },
        {
            fillColor : "rgba(140, 145, 255, 0.69)",
            strokeColor : "rgba(151,187,205,1)",
            data : [28,48,40,19,96,27]
        }
    ]

}

var myLine = new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);
