<!DOCTYPE html>
<html>
    <head>
        <title>Campionatul National de Turism Sportiv Stafeta Muntilor Software v1.0</title>
        <link href="css/bootstrap.css" rel="stylesheet" type='text/css'/>
        <!-- Custom Theme files -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <!-- Custom Theme files -->
        <script src="js/jquery.min.js"></script>
        {*<link rel="stylesheet" href="css/font-awesome.css">*}
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="keywords" content="stafeta muntilor"/>
        <script type="application/x-javascript"> addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);
            function hideURLbar() {
                window.scrollTo(0, 1);
            } </script>

{*        <script src="js/zingchart.min.js"></script>
        <script src="js/zingchart.jquery.js"></script>*}
        <script src="js/jquery.easydropdown.js"></script>
        <script src="js/jquery.nicescroll.js"></script>

        <link href="css/jqvmap.css" media="screen" rel="stylesheet" type="text/css"/>
        <script src="js/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
        <script src="js/jquery.vmap.js" type="text/javascript"></script>
        <script src="js/jquery.vmap.world.js" type="text/javascript"></script>
        <script src="js/jquery.vmap.sampledata.js" type="text/javascript"></script>

        <script src="js/lib/bootstrap.min.js"></script>


        <!----Calender -------->
        <link rel="stylesheet" href="css/clndr.css" type="text/css"/>
        <script src="js/underscore-min.js"></script>
        <script src="js/moment-2.2.1.js"></script>
        <script src="js/clndr.js"></script>
        <script src="js/site.js"></script>
        <!----End Calender -------->
        <script src="js/easyResponsiveTabs.js" type="text/javascript"></script>
        <script type="text/javascript">

        </script>
        <link href="css/nav.css" rel="stylesheet" type="text/css" media="all"/>
        <script src="js/main.js"></script>
        <!-- Resource jQuery -->
        <!-- chart -->
        <script src="js/Chart1.js"></script>
        <!-- //chart -->

        <script src="js/lib/jquery-cloneya.js"></script>
        <script src="js/lib/jquery.inputmask.bundle.min.js"></script>
        <script src="js/raid.js"></script>

    </head>
    <body>
        <div class="total-content">
            <div class="col-md-3 side-bar">
                <div class="logo text-center">
                    <a href="/stafeta/"><img src="images/logo.png" alt=""/></a>
                </div>
                {include file="common/menu.tpl"}
            </div>
            <div class="col-md-9 content">
                <div class="clearfix"></div>

                <div class="list_of_members">
                    {include file="common/top-dreapta.tpl"}
                </div>
                <div class="total-continut notifications">
                {include file="common/messages.tpl" type="success" messages=$successes}
                {include file="common/messages.tpl" type="error" messages=$errors}
                {include file="common/messages.tpl" type="notice" messages=$notices}
                </div>

                {include file=$template}
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="footer">
            {include file="common/footer.tpl"}
        </div>
    </body>
</html>