<?php /* Smarty version 3.1.27, created on 2016-07-27 21:45:21
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\teams\listsbyteams.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:21711579901416c1735_42239608%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '3742225000eb5c756ebcbe9bf664144c2e0935d4' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\teams\\listsbyteams.tpl',
      1 => 1469643686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '21711579901416c1735_42239608',
  'variables' => 
  array (
    'organizer' => 0,
    'totalteams' => 0,
    'number' => 0,
    'teams' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_579901419809e0_15339892',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_579901419809e0_15339892')) {
function content_579901419809e0_15339892 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '21711579901416c1735_42239608';
if (isset($_REQUEST['pdf'])) {?>
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Lista Cluburilor in functie de numarul <br /> de echipe pe categorii</strong></h3>
                <br/>
                <?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_trophy'];?>
 - <?php echo $_smarty_tpl->tpl_vars['organizer']->value['phase_trophy'];?>

                <br/>
                Organizator <?php echo $_smarty_tpl->tpl_vars['organizer']->value['name_organizer'];?>

            </td>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
        </tr>
    </table>
    <br/>

<?php } else { ?>
    <p class="home"><strong>Lista Echipelor inscrise in functie de numar si categorie</strong>  </p>
    <div class="total-continut">
        <div class='TabelListaCluburi'>
<?php }?>

        <table class="afisare-tabel" style="width: 100%" >
            <tr>
                <th style="width:5%">Nr</th>
				<th style="width:45%">Nume Club</th>
                		 <th style="width:7%">Echipe Inscrise</th>
				 <th style="width:7%">Echipe Family</th>
				 <th style="width:7%">Echipe Juniori</th>
				 <th style="width:7%">Echipe Elite</th>
				 <th style="width:7%">Echipe Open</th>
				 <th style="width:7%">Echipe Veterani</th>
				 <th style="width:7%">Echipe Feminin</th>


            </tr>
            <?php
$_from = $_smarty_tpl->tpl_vars['totalteams']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["teams"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["teams"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["teams"]->value) {
$_smarty_tpl->tpl_vars["teams"]->_loop = true;
$foreach_teams_Sav = $_smarty_tpl->tpl_vars["teams"];
?>
               <tr title="">
                    <td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['number']->value++;?>
</td>
					<td class="text-tabel left"><?php echo $_smarty_tpl->tpl_vars['teams']->value['club_name'];?>
</td>
                    <td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['echipe'];?>
</td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['family'];?>
</td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['juniori'];?>
</td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['elite'];?>
</td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['open'];?>
</td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['veterani'];?>
</td>
					<td class="numere-tabel"><?php echo $_smarty_tpl->tpl_vars['teams']->value['feminin'];?>
</td>
        </tr>
            <?php
$_smarty_tpl->tpl_vars["teams"] = $foreach_teams_Sav;
}
?>
        </table>

		
<?php if (!isset($_REQUEST['pdf'])) {?>
        </div>
    </div>
    <br>
<a href="/stafeta/?page=teams/lists" class="btn btn-primary clone">INAPOI</a>
<a href="<?php echo $_SERVER['REQUEST_URI'];?>
&pdf=1&&orientation=L" target="_blank" class="btn btn-primary clone">Export to PDF</a>
<?php }
}
}
?>