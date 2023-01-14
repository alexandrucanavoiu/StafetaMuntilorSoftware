<?php /* Smarty version 3.1.27, created on 2016-04-03 23:15:30
         compiled from "D:\UwAmp\UwAmp\www\stafeta\templates\cultural\lists.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:27088570179e20e3949_79676771%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '89de17d9fe7b2755472c0173b2378c0f2d142e4d' => 
    array (
      0 => 'D:\\UwAmp\\UwAmp\\www\\stafeta\\templates\\cultural\\lists.tpl',
      1 => 1459361059,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '27088570179e20e3949_79676771',
  'variables' => 
  array (
    'organizer' => 0,
    'totalclubs' => 0,
    'clubs' => 0,
    'number' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570179e219a6e3_58688672',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570179e219a6e3_58688672')) {
function content_570179e219a6e3_58688672 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '27088570179e20e3949_79676771';
if (isset($_REQUEST['pdf'])) {?>

   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament Proba Culturala</strong></h3>
                <br/>
                <?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_trophy'];?>
 - <?php echo $_smarty_tpl->tpl_vars['organizer']->value['phase_trophy'];?>

                <br/>
                Organizator <?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_organizer'];?>

				<br />
				<?php if (($_smarty_tpl->tpl_vars['organizer']->value['phase_trophy'] == "Amical")) {?>
				Acest clasament nu se cumuleaza in cadrul Stafeta Muntilor.
				<?php }?>
            </td>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
        </tr>
    </table>
    <br/>

<?php } else { ?>
    <p class="home"><strong>Proba Culturala - Lista Echipe Stafeta Muntilor</strong>  </p>
    <div class="total-continut">
        <div class='TabelListaCluburi'>

<?php }?>
	<table class="afisare-tabel" align="center" style="width: 100%" >
            <tr>
                <th style="width:5%">Loc</th>
                <th style="width:50%">Echipa</th>
				<th style="width:10%">Cultural</th>
				<?php if (!isset($_REQUEST['pdf'])) {?>
			  <th style="width:10%"></th>
			  <?php }?>
            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['totalclubs']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["clubs"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["clubs"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["clubs"]->value) {
$_smarty_tpl->tpl_vars["clubs"]->_loop = true;
$foreach_clubs_Sav = $_smarty_tpl->tpl_vars["clubs"];
?>
                <tr>
                    <td class="numere-tabel"><?php if ($_smarty_tpl->tpl_vars['clubs']->value['scor_cultural'] == 0) {?>-<?php } else {
echo $_smarty_tpl->tpl_vars['number']->value++;?>
 <?php }?></td>
                    <td class="text-tabel left"><?php echo $_smarty_tpl->tpl_vars['clubs']->value['club_name'];?>
 </td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['clubs']->value['scor_cultural'];?>
 </td>
				<?php if (!isset($_REQUEST['pdf'])) {?>
                    <td class="tabel-optiune"><a href="/stafeta/?page=cultural/update&club_id=<?php echo $_smarty_tpl->tpl_vars['clubs']->value['club_id'];?>
">Completeaza</a></td>
				<?php }?>
                </tr>
            <?php
$_smarty_tpl->tpl_vars["clubs"] = $foreach_clubs_Sav;
}
?>
        </table>
		
		
<?php if (!isset($_REQUEST['pdf'])) {?>
    </div>
</div>
<a href="<?php echo $_SERVER['REQUEST_URI'];?>
&pdf=1" target="_blank" class="btn btn-primary clone">Export Clasament to PDF</a>
<?php }
}
}
?>