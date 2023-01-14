<?php /* Smarty version 3.1.27, created on 2016-04-03 14:45:39
         compiled from "templates/layout.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1337916270570164d39c3562_17978640%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '85c5c180a34de75ce423cae9f14931c9c94f7477' => 
    array (
      0 => 'templates/layout.tpl',
      1 => 1436961470,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1337916270570164d39c3562_17978640',
  'variables' => 
  array (
    'successes' => 0,
    'errors' => 0,
    'notices' => 0,
    'template' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570164d3a68e53_86457213',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570164d3a68e53_86457213')) {
function content_570164d3a68e53_86457213 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1337916270570164d39c3562_17978640';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Campionatul National de Turism Sportiv Stafeta Muntilor Software v1.0</title>
        <link href="css/bootstrap.css" rel="stylesheet" type='text/css'/>
        <!-- Custom Theme files -->
        <link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
        <!-- Custom Theme files -->
        <?php echo '<script'; ?>
 src="js/jquery.min.js"><?php echo '</script'; ?>
>
        
        <!-- Custom Theme files -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="keywords" content="stafeta muntilor"/>
        <?php echo '<script'; ?>
 type="application/x-javascript"> addEventListener("load", function () {
                setTimeout(hideURLbar, 0);
            }, false);
            function hideURLbar() {
                window.scrollTo(0, 1);
            } <?php echo '</script'; ?>
>


        <?php echo '<script'; ?>
 src="js/jquery.easydropdown.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/jquery.nicescroll.js"><?php echo '</script'; ?>
>

        <link href="css/jqvmap.css" media="screen" rel="stylesheet" type="text/css"/>
        <?php echo '<script'; ?>
 src="js/lib/jquery/1.9.1/jquery.min.js" type="text/javascript"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/jquery.vmap.js" type="text/javascript"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/jquery.vmap.world.js" type="text/javascript"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/jquery.vmap.sampledata.js" type="text/javascript"><?php echo '</script'; ?>
>

        <?php echo '<script'; ?>
 src="js/lib/bootstrap.min.js"><?php echo '</script'; ?>
>


        <!----Calender -------->
        <link rel="stylesheet" href="css/clndr.css" type="text/css"/>
        <?php echo '<script'; ?>
 src="js/underscore-min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/moment-2.2.1.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/clndr.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/site.js"><?php echo '</script'; ?>
>
        <!----End Calender -------->
        <?php echo '<script'; ?>
 src="js/easyResponsiveTabs.js" type="text/javascript"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 type="text/javascript">

        <?php echo '</script'; ?>
>
        <link href="css/nav.css" rel="stylesheet" type="text/css" media="all"/>
        <?php echo '<script'; ?>
 src="js/main.js"><?php echo '</script'; ?>
>
        <!-- Resource jQuery -->
        <!-- chart -->
        <?php echo '<script'; ?>
 src="js/Chart1.js"><?php echo '</script'; ?>
>
        <!-- //chart -->

        <?php echo '<script'; ?>
 src="js/lib/jquery-cloneya.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/lib/jquery.inputmask.bundle.min.js"><?php echo '</script'; ?>
>
        <?php echo '<script'; ?>
 src="js/raid.js"><?php echo '</script'; ?>
>

    </head>
    <body>
        <div class="total-content">
            <div class="col-md-3 side-bar">
                <div class="logo text-center">
                    <a href="/stafeta/"><img src="images/logo.png" alt=""/></a>
                </div>
                <?php echo $_smarty_tpl->getSubTemplate ("common/menu.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

            </div>
            <div class="col-md-9 content">
                <div class="clearfix"></div>

                <div class="list_of_members">
                    <?php echo $_smarty_tpl->getSubTemplate ("common/top-dreapta.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

                </div>
                <div class="total-continut notifications">
                <?php echo $_smarty_tpl->getSubTemplate ("common/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"success",'messages'=>$_smarty_tpl->tpl_vars['successes']->value), 0);
?>

                <?php echo $_smarty_tpl->getSubTemplate ("common/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"error",'messages'=>$_smarty_tpl->tpl_vars['errors']->value), 0);
?>

                <?php echo $_smarty_tpl->getSubTemplate ("common/messages.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array('type'=>"notice",'messages'=>$_smarty_tpl->tpl_vars['notices']->value), 0);
?>

                </div>

                <?php echo $_smarty_tpl->getSubTemplate ($_smarty_tpl->tpl_vars['template']->value, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

            </div>
            <div class="clearfix"></div>
        </div>
        <div class="footer">
            <?php echo $_smarty_tpl->getSubTemplate ("common/footer.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

        </div>
    </body>
</html><?php }
}
?>