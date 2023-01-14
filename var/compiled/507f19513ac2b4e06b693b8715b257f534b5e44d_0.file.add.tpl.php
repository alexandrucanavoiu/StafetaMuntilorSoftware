<?php /* Smarty version 3.1.27, created on 2016-07-28 13:21:26
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\teams\add.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:22525799dca6eb5a91_51976752%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '507f19513ac2b4e06b693b8715b257f534b5e44d' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\teams\\add.tpl',
      1 => 1469643686,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '22525799dca6eb5a91_51976752',
  'variables' => 
  array (
    'liststeams' => 0,
    'categories' => 0,
    'categorie' => 0,
    'message' => 0,
    'totalclubs' => 0,
    'club' => 0,
    'teams' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799dca7222f43_50949461',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799dca7222f43_50949461')) {
function content_5799dca7222f43_50949461 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '22525799dca6eb5a91_51976752';
?>
    <?php echo '<script'; ?>
 type="text/javascript">
        $(document).ready(function() {
            //Input fields increment limitation
            var maxField = 20;

            //Add button selector
            var addButton = $('.add_button');

            //Input field wrapper
            var wrapper = $('.numeEchipa');

            //New input field html
            var fieldHTML = '<div><strong>Nume Echipa :</strong> <input type="text" name="team_name[]" id="numeEchipa" value="<?php echo $_smarty_tpl->tpl_vars['liststeams']->value['team_name'];?>
" size="50" required oninvalid="this.setCustomValidity(\'Introduceti numele echipei\')" oninput="this.setCustomValidity(\'\')" > <strong>Categoria :</strong> <select name="category_id[]" id="Categorie"><?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["categorie"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["categorie"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["categorie"]->value) {
$_smarty_tpl->tpl_vars["categorie"]->_loop = true;
$foreach_categorie_Sav = $_smarty_tpl->tpl_vars["categorie"];
?> <option value="<?php echo $_smarty_tpl->tpl_vars['categorie']->value['category_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['categorie']->value['category_name'];?>
</option><?php
$_smarty_tpl->tpl_vars["categorie"] = $foreach_categorie_Sav;
}
?></select><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/stafeta/images/remove-icon.png"/></a> * <div></div></div>';

            //Initial field counter is 1
            var x = 1;
            //Once add button is clicked
            $(addButton).click(function() {

                //Check maximum number of input fields
                if(x < maxField){

                    //Increment field counter
                    x++;

                    // Add field html
                    $(wrapper).append(fieldHTML);
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
    <?php echo '</script'; ?>
>
	
			<p class="home"><strong>Adauga Echipe Participante - Stafeta Muntilor</strong></p>
			<div class="total-continut">

				<form action="/stafeta/?page=teams/add" method="POST">
					<div id="aduagare-club">
				<?php if (!empty($_smarty_tpl->tpl_vars['message']->value)) {?>
					<?php echo $_smarty_tpl->tpl_vars['message']->value;?>

				<?php }?>
				<div class="club1"><strong>Nume Club : </strong>
				
					<select name="club_id" id="numeClub">
					<?php
$_from = $_smarty_tpl->tpl_vars['totalclubs']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["club"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["club"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["club"]->value) {
$_smarty_tpl->tpl_vars["club"]->_loop = true;
$foreach_club_Sav = $_smarty_tpl->tpl_vars["club"];
?> 
					<option value="<?php echo $_smarty_tpl->tpl_vars['club']->value['club_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['club']->value['club_name'];?>
</option>
					<?php
$_smarty_tpl->tpl_vars["club"] = $foreach_club_Sav;
}
?>
					</select>
				
				</div>
				
				<div id="numeEchipa" class="numeEchipa">
						<div><strong>Nume Echipa : </strong> <input type="text" name="team_name[]" id="numeEchipa" value="<?php echo $_smarty_tpl->tpl_vars['teams']->value['team_name'];?>
" size="50" required   oninvalid="this.setCustomValidity('Introduceti numele echipei')" oninput="this.setCustomValidity('')" >
						
						<strong>Categoria :</strong> 
						<select name="category_id[]" id="Categorie">
						<?php
$_from = $_smarty_tpl->tpl_vars['categories']->value;
if (!is_array($_from) && !is_object($_from)) {
settype($_from, 'array');
}
$_smarty_tpl->tpl_vars["categorie"] = new Smarty_Variable;
$_smarty_tpl->tpl_vars["categorie"]->_loop = false;
foreach ($_from as $_smarty_tpl->tpl_vars["categorie"]->value) {
$_smarty_tpl->tpl_vars["categorie"]->_loop = true;
$foreach_categorie_Sav = $_smarty_tpl->tpl_vars["categorie"];
?> 
						<option value="<?php echo $_smarty_tpl->tpl_vars['categorie']->value['category_id'];?>
"><?php echo $_smarty_tpl->tpl_vars['categorie']->value['category_name'];?>
</option>
						<?php
$_smarty_tpl->tpl_vars["categorie"] = $foreach_categorie_Sav;
}
?>
						</select>
						<a href="javascript:void(0);" class="add_button" title="Add field"><img src="/stafeta/images/add-icon.png"/></a> <span class="error"> *</span>
						</div>
						</div>
						<div class="button-add">
						<input type="submit" name="Trimite" id="Trimite" class="btn btn-primary clone" value="Trimite">
						<input type="reset" name="reset" id="reset" class="btn btn-primary clone" value="Reset!">
						</div>
				</div>
				</form>
				
			
			</div> 
<div class="button-inapoi">			
<a href="/stafeta/?page=teams/lists" class="btn btn-primary clone">INAPOI</a>
</div><?php }
}
?>