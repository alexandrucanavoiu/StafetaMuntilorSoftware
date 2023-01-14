<?php /* Smarty version 3.1.27, created on 2016-04-03 23:15:35
         compiled from "D:\UwAmp\UwAmp\www\stafeta\templates\ranking\general.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:7374570179e7200851_37246775%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '627670e1242e19d88863d36bf2271a352c0c6c51' => 
    array (
      0 => 'D:\\UwAmp\\UwAmp\\www\\stafeta\\templates\\ranking\\general.tpl',
      1 => 1459361483,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7374570179e7200851_37246775',
  'variables' => 
  array (
    'organizer' => 0,
    'categories' => 0,
    'category' => 0,
    'ranking' => 0,
    'item' => 0,
    'cid' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570179e7309359_16859824',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570179e7309359_16859824')) {
function content_570179e7309359_16859824 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '7374570179e7200851_37246775';
if (isset($_REQUEST['pdf'])) {?>
    <table border=0 align="center" >
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament General conform <br /> Regulament Stafeta Muntilor </strong></h3>
                <br />
                <?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_trophy'];?>
 - <?php echo $_smarty_tpl->tpl_vars['organizer']->value['phase_trophy'];?>

                <br />
                Organizator <?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_organizer'];?>

				<br />
				<?php if (($_smarty_tpl->tpl_vars['organizer']->value['phase_trophy'] == "Amical")) {?>
				Acest clasament nu se cumuleaza in cadrul Stafeta Muntilor.
				<?php }?>
            </td>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
        </tr>
    </table>
<?php } else { ?>
    <p class="home"><strong>Clasament General conform Regulament Stafeta Muntilor </strong></p>
<?php }?>

<div class="total-continut">
	<br />	
    <div class='TabelListaCluburi'>
        <table style="width: 100%" class="afisare-tabel">
            <tr>
                <td style="width: 3% text-align: center" class="tabel-optiune">Loc</td>
                <td style="width: 40%" class="tabel-nume">Club</td>
                <?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["category"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["category"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["category"]->value) {
$_smarty_tpl->tpl_vars["category"]->_loop = true;
$foreach_category_Sav = $_smarty_tpl->tpl_vars["category"];
?>
                    <td style="width: 6%"  class="tabel-optiune"><?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
</td>
                <?php
$_smarty_tpl->tpl_vars["category"] = $foreach_category_Sav;
}
?>
                <td style="width: 6%" class="tabel-optiune">Cultural</td>
                <td style="width: 6%" class="tabel-optiune">Bonus echipe</td>
                <td style="width: 6%" class="tabel-optiune">Total</td>
            </tr>
			
			<?php
$_from = $_smarty_tpl->tpl_vars['ranking']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["item"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["item"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["item"]->value) {
$_smarty_tpl->tpl_vars["item"]->_loop = true;
$foreach_item_Sav = $_smarty_tpl->tpl_vars["item"];
?>
			
				 <tr>
                    <td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['item']->value['rank'];?>
</td>
                    <td class="text-tabel"><?php echo $_smarty_tpl->tpl_vars['item']->value['club_name'];?>
</td>
                     <?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["category"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["category"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["category"]->value) {
$_smarty_tpl->tpl_vars["category"]->_loop = true;
$foreach_category_Sav = $_smarty_tpl->tpl_vars["category"];
?>
                         <?php $_smarty_tpl->tpl_vars['cid'] = new Smarty_Variable($_smarty_tpl->tpl_vars['category']->value['category_id'], null, 0);?>
                         <td class="numere-tabel">
                             <?php if (array_key_exists($_smarty_tpl->tpl_vars['cid']->value,$_smarty_tpl->tpl_vars['item']->value['ignored_ranking'])) {?><s><?php }?>
                             <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['ranking'][$_smarty_tpl->tpl_vars['cid']->value])) {?>
                                 <?php echo $_smarty_tpl->tpl_vars['item']->value['ranking'][$_smarty_tpl->tpl_vars['cid']->value];?>

                             <?php }?>
                             <?php if (array_key_exists($_smarty_tpl->tpl_vars['cid']->value,$_smarty_tpl->tpl_vars['item']->value['ignored_ranking'])) {?></s><?php }?>
                         </td>
                     <?php
$_smarty_tpl->tpl_vars["category"] = $foreach_category_Sav;
}
?>
                     <td class="numere-tabel">
                         <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['scor_cultural'])) {?>
                             <?php echo $_smarty_tpl->tpl_vars['item']->value['scor_cultural'];?>

                         <?php }?>
                     </td>
                     <td class="numere-tabel">
                         <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['bonus'])) {?>
                             <?php echo $_smarty_tpl->tpl_vars['item']->value['bonus'];?>

                         <?php }?>
                     </td>
                     <td class="numere-tabel">
                         <?php if (!empty($_smarty_tpl->tpl_vars['item']->value['total'])) {?>
                             <?php echo $_smarty_tpl->tpl_vars['item']->value['total'];?>

                         <?php }?>
                     </td>
                 </tr>
				
			<?php
$_smarty_tpl->tpl_vars["item"] = $foreach_item_Sav;
}
?>		

        </table>
    </div>
</div>

<?php if (!isset($_REQUEST['pdf'])) {?>
    <a href="<?php echo $_SERVER['REQUEST_URI'];?>
&pdf=1&orientation=L" target="_blank" class="btn btn-primary clone">Export to PDF</a>
<?php }

}
}
?>