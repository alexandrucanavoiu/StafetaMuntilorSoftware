<?php /* Smarty version 3.1.27, created on 2016-07-28 14:27:08
         compiled from "C:\Users\Test\Desktop\imprimanta driver\Stafeta_Muntilor_Software\Stafeta Muntilor Software\www\stafeta\templates\challenges\update.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:18365799ec0ced72d1_57517607%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '4143b1b33b95703f9d563232ecf0e94394fe3ad6' => 
    array (
      0 => 'C:\\Users\\Test\\Desktop\\imprimanta driver\\Stafeta_Muntilor_Software\\Stafeta Muntilor Software\\www\\stafeta\\templates\\challenges\\update.tpl',
      1 => 1469643684,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18365799ec0ced72d1_57517607',
  'variables' => 
  array (
    'challenge' => 0,
    'category' => 0,
    'challenge_id' => 0,
    'category_id' => 0,
    'categoryChallenge' => 0,
  ),
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_5799ec0d190c41_59776332',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_5799ec0d190c41_59776332')) {
function content_5799ec0d190c41_59776332 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '18365799ec0ced72d1_57517607';
?>
<p class="home"><strong>Configurare proba <?php echo $_smarty_tpl->tpl_vars['challenge']->value['challenge_name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['category']->value['category_name'];?>
</strong></p>
	
<div class="total-continut">

    <form method="POST" action="/stafeta/?page=challenges/update" autocomplete="off" class="form-horizontal sm-form" role="form">
        <input type="hidden" name="challenge_id" value="<?php echo $_smarty_tpl->tpl_vars['challenge_id']->value;?>
"/>
        <input type="hidden" name="category_id" value="<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
"/>
        <div class="">
            <?php if ($_smarty_tpl->tpl_vars['categoryChallenge']->value['challenge_id'] == 1) {?>
                <?php echo $_smarty_tpl->getSubTemplate ("challenges/components/raid.tpl", $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, 0, $_smarty_tpl->cache_lifetime, array(), 0);
?>

            <?php }?>
        </div>
		<div class="sm-buttons">
            <input type="submit" class="btn btn-primary" value="Salveaza" />
            <?php if (!empty($_smarty_tpl->tpl_vars['categoryChallenge']->value['category_challenge_id'])) {?>
                <a class="btn btn-default" href="/stafeta/?page=challenges/delete&category_challenge_id=<?php echo $_smarty_tpl->tpl_vars['categoryChallenge']->value['category_challenge_id'];?>
">Șterge</a>
                <a class="btn btn-default" href="/stafeta/?page=challenges/results&category_id=<?php echo $_smarty_tpl->tpl_vars['category_id']->value;?>
&challenge_id=<?php echo $_smarty_tpl->tpl_vars['challenge_id']->value;?>
">Adaugă rezultate</a>
            <?php }?>
        </div>
    </form>


</div>

<?php }
}
?>