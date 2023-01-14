<?php /* Smarty version 3.1.27, created on 2016-04-03 14:45:39
         compiled from "templates/common/menu.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:532623408570164d3a6f7d5_30107640%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd994adfaf65195908e7c1d1c3070ea5281946ef3' => 
    array (
      0 => 'templates/common/menu.tpl',
      1 => 1436305212,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '532623408570164d3a6f7d5_30107640',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570164d3a8dd15_42437740',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570164d3a8dd15_42437740')) {
function content_570164d3a8dd15_42437740 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '532623408570164d3a6f7d5_30107640';
?>
<div class="navigation">
    <h3>Stafeta Muntilor</h3>
    <ul>
        <li><a href="/stafeta/?page=challenges/configure"><i class="art"></i> Configurare</a></li>
        <li><a href="/stafeta/?page=clubs/lists"><i class="clubs"></i> Cluburi</a></li>
        <li><a href="/stafeta/?page=teams/lists"><i class="user"></i> Echipe</a></li>
        <li><a href="/stafeta/?page=cultural/lists"><i class="cultural"></i> Cultural</a></li>
        <li><a href="/stafeta/?page=others/lists"><i class="other"></i> Others</a></li>
    </ul>
</div>

<div class="navigation">
    <h3>Categoria <span>Open</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=4"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=4"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=4&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=4"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Juniori</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=2"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=2"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=2&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=2"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Family</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=1"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=1"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=1&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=1"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Feminin</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=6"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=6"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=6&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=6"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Veterani</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=5"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=5"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=5&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=5"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Categoria <span>Elite</span></h3>
    <ul>
        <li><a href="/stafeta/?page=knowledge/lists&category_id=3"><i class="cunostinte"></i> Cunostinte Turistice</a></li>
        <li><a href="/stafeta/?page=orienteering/lists&category_id=3"><i class="orientare"></i> Orientare</a></li>
        <li><a href="/stafeta/?page=challenges/results&category_id=3&challenge_id=1"><i class="raidmontan"></i> Raid Montan</a></li>
        <li><a href="/stafeta/?page=ranking/lists&category_id=3"><i class="categoriecat"></i> Clasamente</a></li>
    </ul>
</div>
<div class="navigation">
    <h3>Clasament General</h3>
    <ul>
        <li><a href="<?php echo url("ranking/general");?>
"><i class="clasamentgen"></i> Vezi Clasament</a></li>
    </ul>
</div><?php }
}
?>