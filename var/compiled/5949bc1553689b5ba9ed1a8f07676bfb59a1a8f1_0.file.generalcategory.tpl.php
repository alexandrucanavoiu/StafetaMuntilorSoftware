<?php /* Smarty version 3.1.27, created on 2016-07-31 21:50:35
         compiled from "C:\Users\MarketingRomania\Desktop\Stafeta Muntilor Software\www\stafeta\templates\ranking\generalcategory.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:2316579e487b83ebd3_97037914%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '5949bc1553689b5ba9ed1a8f07676bfb59a1a8f1' => 
    array (
      0 => 'C:\\Users\\MarketingRomania\\Desktop\\Stafeta Muntilor Software\\www\\stafeta\\templates\\ranking\\generalcategory.tpl',
      1 => 1469643685,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2316579e487b83ebd3_97037914',
  'variables' => 
  array (
    'category' => 0,
    'organizer' => 0,
    'items' => 0,
    'item' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579e487b9193e6_06972805',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579e487b9193e6_06972805')) {
function content_579e487b9193e6_06972805 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '2316579e487b83ebd3_97037914';
if (isset($_REQUEST['pdf'])) {?>
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament General <br /> - Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 -</strong></h3>
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
    <p class="home"><strong>Clasament General - Categoria  <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
 -</strong>  </p>
    <div class="total-continut">
        <div class='TabelListaCluburi'>
<?php }?>

        <table class="afisare-tabel" style="width: 100%" >
            <tr>
                 <th style="width:5%">Loc</th>
				<th style="width:40%">Echipa</th>
				<th style="width:10%">Raid Montan</th>
				<th style="width:10%">Orientare</th>
				<th style="width:12%">Cunostinte Turistice</th>
				<th style="width:10%">Total</th>
				<th style="width:12%">Punctaj Stafeta Muntilor</th>
            </tr>
			
			<?php
$_from = $_smarty_tpl->tpl_vars['items']->value;
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
                    <td class="text-tabel left"><?php echo $_smarty_tpl->tpl_vars['item']->value['team_name'];?>
</td>
					<td class="numere-tabel"><?php if (empty($_smarty_tpl->tpl_vars['item']->value['raid_abandon'])) {
echo $_smarty_tpl->tpl_vars['item']->value['raid_score'];
} else { ?>Abandon<?php }?></td>
					<td class="numere-tabel"><?php if (empty($_smarty_tpl->tpl_vars['item']->value['orienteering_abandon'])) {
echo $_smarty_tpl->tpl_vars['item']->value['orienteering_score'];
} else { ?>Abandon<?php }?></td>
					<td class="numere-tabel"><?php if (empty($_smarty_tpl->tpl_vars['item']->value['knowledge_abandon'])) {
echo $_smarty_tpl->tpl_vars['item']->value['knowledge_score'];
} else { ?>Abandon<?php }?></td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['item']->value['score'];?>
</td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['item']->value['sm_score'];?>
</td>
                </tr>
				
			<?php
$_smarty_tpl->tpl_vars["item"] = $foreach_item_Sav;
}
?>		

        </table>
		
<?php if (!isset($_REQUEST['pdf'])) {?>
    </div>
</div>

<a href="/stafeta/?page=ranking/lists&category_id=<?php echo $_smarty_tpl->tpl_vars['category']->value['category_id'];?>
" class="btn btn-primary clone">INAPOI</a>
<a href="<?php echo $_SERVER['REQUEST_URI'];?>
&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
<?php }
}
}
?>