<?php /* Smarty version 3.1.27, created on 2016-04-03 20:12:09
         compiled from "D:\UwAmp\UwAmp\www\stafeta\templates\index\index.tpl" */ ?>
<?php
/*%%SmartyHeaderCode:1677157017919380ce2_66540418%%*/
if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_valid = $_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'dee4bc3a7002ea66306380ce3f655e6c09954306' => 
    array (
      0 => 'D:\\UwAmp\\UwAmp\\www\\stafeta\\templates\\index\\index.tpl',
      1 => 1459358042,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1677157017919380ce2_66540418',
  'has_nocache_code' => false,
  'version' => '3.1.27',
  'unifunc' => 'content_570179193df873_54682064',
),false);
/*/%%SmartyHeaderCode%%*/
if ($_valid && !is_callable('content_570179193df873_54682064')) {
function content_570179193df873_54682064 ($_smarty_tpl) {

$_smarty_tpl->properties['nocache_hash'] = '1677157017919380ce2_66540418';
?>
<p class="home"><strong>Statistici Campionatul National de Turism Sportiv "Stafeta Muntilor"</strong></p>

<div class="total-continut">
    <div class="user-trends">

        <canvas id="bar4" height="340" width="675"></canvas>
        <?php echo '<script'; ?>
>

            var barChartData = {
                labels : ["Etapa I 2015","Etapa II 2015","Etapa III 2015","Etapa IV 2015","Etapa V 2015"],
                datasets : [
                    {
                        fillColor : "rgba(255, 137, 167, 0.78)",
                        strokeColor : "rgba(220,220,220,1)",
                        data : [40,23,16,18,15,16,23,15,16]
                    },
                    {
                        fillColor : "rgba(22, 160, 133, 0.69)",
                        strokeColor : "rgba(151,187,205,1)",
                        data : [74,64,56,67,39,55,58,50,64]
                    },
					                    {
                        fillColor : "rgba(140, 145, 255, 0.69)",
                        strokeColor : "rgba(151,187,205,1)",
                        data : [228,192,168,201,117,183,174,150,192]
                    }
					
                ]

            }

            var myLine = new Chart(document.getElementById("bar4").getContext("2d")).Bar(barChartData);

        <?php echo '</script'; ?>
>
		
    </div>
    <div class="to-do">
        <h3>Anul 2015</h3>
        <div class="lista-importanta">
			<ul>
			<li><div><span>Etape organizate: </span> 9 concursuri</div></li>
			<li><div><span>Cluburi participante: </span> 84 cluburi</div></li>
			<li><div><span>Participanti: </span> 2153 persoane</div></li>
			<li><div><span>Family: </span> 116 echipaje</div></li>
			<li><div><span>Juniori: </span> 31 echipaje</div></li>
			<li><div><span>Elite: </span> 83 echipaje</div></li>
			<li><div><span>Open: </span> 190 echipaje</div></li>
			<li><div><span>Feminin: </span> 27 echipaje</div></li>
			<li><div><span>Veterani: </span> 48 echipaje</div></li>
			</ul>
        </div>
		<br />
			<div class='my-legend'>
				<div class='legend-title'>Legenda 2015</div>
				<div class='legend-scale'>
				  <ul class='legend-labels'>
					<li><span style='background:#ff89a7; opacity: 0.4;'></span>Cluburi</li>
					<li><span style='background:#16a085; opacity: 0.69;'></span>Echipe</li>
					<li><span style='background:#8c91ff; opacity: 0.69;'></span>Participanti</li>
				  </ul>
				</div>
			</div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="total-continut">
    <div class="user-trends">

        <canvas id="bar" height="340" width="780"></canvas>
        <?php echo '<script'; ?>
>

            var barChartData = {
                labels : ["Etapa I 2014","Etapa II 2014","Etapa III 2014","Etapa IV 2014","Etapa V 2014","Etapa VI 2014"],
                datasets : [
                    {
                        fillColor : "rgba(255, 137, 167, 0.78)",
                        strokeColor : "rgba(220,220,220,1)",
                        data : [14,13,30,21,13,11]
                    },
                    {
                        fillColor : "rgba(22, 160, 133, 0.69)",
                        strokeColor : "rgba(151,187,205,1)",
                        data : [35,43,56,63,27,44]
                    },
					                    {
                        fillColor : "rgba(140, 145, 255, 0.69)",
                        strokeColor : "rgba(151,187,205,1)",
                        data : [260,182,390,320,170,210]
                    }
					
                ]

            }

            var myLine = new Chart(document.getElementById("bar").getContext("2d")).Bar(barChartData);

        <?php echo '</script'; ?>
>

    </div>
    <div class="to-do">
        <h3>Anul 2014</h3>
        <div class="lista-importanta">
			<ul>
			<li><div><span>Etape organizate: </span> 6 concursuri</div></li>
			<li><div><span>Cluburi participante: </span> 52 cluburi</div></li>
			<li><div><span>Participanti: </span> 1.530 persoane</div></li>
			<li><div><span>Copii: </span> 24 echipaje</div></li>
			<li><div><span>Juniori: </span> 31 echipaje</div></li>
			<li><div><span>Elite: </span> 58 echipaje</div></li>
			<li><div><span>Open: </span> 108 echipaje</div></li>
			<li><div><span>Feminin: </span> 27 echipaje</div></li>
			<li><div><span>Veterani: </span> 24 echipaje</div></li>
			</ul>
			
		<br />
			<div class='my-legend'>
				<div class='legend-title'>Legenda 2014</div>
				<div class='legend-scale'>
				  <ul class='legend-labels'>
					<li><span style='background:#ff89a7; opacity: 0.4;'></span>Cluburi</li>
					<li><span style='background:#16a085; opacity: 0.69;'></span>Echipe</li>
					<li><span style='background:#8c91ff; opacity: 0.69;'></span>Participanti</li>
				  </ul>
				</div>
			</div>
			
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="total-continut">
    <div class="user-trends">

        <canvas id="bar2" height="340" width="675"></canvas>
        <?php echo '<script'; ?>
>

            var barChartData = {
                labels : ["Etapa I 2013","Etapa II 2013","Etapa III 2013","Etapa IV 2013","Etapa V 2013","Etapa VI 2013","Etapa VII 2013"],
                datasets : [
                    {
                        fillColor : "rgba(255, 137, 167, 0.78)",
                        strokeColor : "rgba(220,220,220,1)",
                        data : [17,7,9,23,18,11,19]
                    },
                    {
                        fillColor : "rgba(22, 160, 133, 0.69)",
                        strokeColor : "rgba(151,187,205,1)",
                        data : [22,34,32,53,35,36,28]
                    },
					                    {
                        fillColor : "rgba(140, 145, 255, 0.69)",
                        strokeColor : "rgba(151,187,205,1)",
                        data : [210,150,120,280,260,180,230]
                    }
					
                ]

            }

            var myLine = new Chart(document.getElementById("bar2").getContext("2d")).Bar(barChartData);

        <?php echo '</script'; ?>
>

    </div>
    <div class="to-do">
        <h3>Anul 2013</h3>
        <div class="lista-importanta">
			<ul>
			<li><div><span>Etape organizate: </span> 7 concursuri</div></li>
			<li><div><span>Cluburi participante: </span> 43 cluburi</div></li>
			<li><div><span>Participanti: </span> 1.430 persoane</div></li>
			<li><div><span>Copii: </span> 21 echipaje</div></li>
			<li><div><span>Juniori: </span> 55 echipaje</div></li>
			<li><div><span>Elite: </span> 66 echipaje</div></li>
			<li><div><span>Open: </span> 98 echipaje</div></li>
			</ul>
        </div>
		<br />
			<div class='my-legend'>
				<div class='legend-title'>Legenda 2013</div>
				<div class='legend-scale'>
				  <ul class='legend-labels'>
					<li><span style='background:#ff89a7; opacity: 0.4;'></span>Cluburi</li>
					<li><span style='background:#16a085; opacity: 0.69;'></span>Echipe</li>
					<li><span style='background:#8c91ff; opacity: 0.69;'></span>Participanti</li>
				  </ul>
				</div>
			</div>
    </div>
    <div class="clearfix"></div>
</div>

<div class="total-continut">
    <div class="user-trends">

        <canvas id="bar3" height="340" width="675"></canvas>
        <?php echo '<script'; ?>
>

            var barChartData = {
                labels : ["Etapa I 2012","Etapa II 2012","Etapa III 2012","Etapa IV 2012","Etapa V 2012"],
                datasets : [
                    {
                        fillColor : "rgba(255, 137, 167, 0.78)",
                        strokeColor : "rgba(220,220,220,1)",
                        data : [19,10,8,17,14]
                    },
                    {
                        fillColor : "rgba(22, 160, 133, 0.69)",
                        strokeColor : "rgba(151,187,205,1)",
                        data : [18,12,23,27,31]
                    },
					                    {
                        fillColor : "rgba(140, 145, 255, 0.69)",
                        strokeColor : "rgba(151,187,205,1)",
                        data : [200,60,90,290,250]
                    }
					
                ]

            }

            var myLine = new Chart(document.getElementById("bar3").getContext("2d")).Bar(barChartData);

        <?php echo '</script'; ?>
>
		
    </div>
    <div class="to-do">
        <h3>Anul 2012</h3>
        <div class="lista-importanta">
			<ul>
			<li><div><span>Etape organizate: </span> 5 concursuri</div></li>
			<li><div><span>Cluburi participante: </span> 37 cluburi</div></li>
			<li><div><span>Participanti: </span> 890 persoane</div></li>
			<li><div><span>Juniori: </span> 23 echipaje</div></li>
			<li><div><span>Elite: </span> 37 echipaje</div></li>
			<li><div><span>Open: </span> 43 echipaje</div></li>
			</ul>
        </div>
		<br />
			<div class='my-legend'>
				<div class='legend-title'>Legenda 2012</div>
				<div class='legend-scale'>
				  <ul class='legend-labels'>
					<li><span style='background:#ff89a7; opacity: 0.4;'></span>Cluburi</li>
					<li><span style='background:#16a085; opacity: 0.69;'></span>Echipe</li>
					<li><span style='background:#8c91ff; opacity: 0.69;'></span>Participanti</li>
				  </ul>
				</div>
			</div>
    </div>
    <div class="clearfix"></div>
</div>

<br /><br />

    <div class="total-continut">

            <h3>Documentatie Stafeta Muntilor</h3>
			<br />
        <div class="lista-importanta">
			<ul>
			<li><div><a href="/stafeta/documente/regulament_2016.doc" target="_blank">Regulament Competitional 2016</a></div></li>
			<li><div><a href="/stafeta/documente/ghidul_oganizatorului_stafeta_muntilor_2015.pdf" target="_blank">Ghidul Organizatorului 2015</a></div></li>
			<li><div><a href="/stafeta/documente/tabel_nominal_de_participare.doc" target="_blank">Tabel nominal cu participantii in cadrul etapei; ( Anexa 1 )</a></div></li>
			<li><div><a href="/stafeta/documente/formular_teste_teoretice.doc" target="_blank">Fisa proba Cunostinte Turistice; ( Anexa 2 )</a></div></li>
			<li><div><a href="/stafeta/documente/tabel_verificare_echipament.doc" target="_blank">Tabel verificare echipament; ( Anexa 3 )</a></div></li>
			<li><div><a href="/stafeta/documente/fisa_raid_montan_2015.doc" target="_blank">Fisa Raid Montan; ( Anexa 4 )</a></div></li>
			<li><div><a href="/stafeta/documente/declaratie_de_participare.doc" target="_blank">Declaratie pe propria raspundere categoria OPEN, ELITE, VETERANI, JUNIORI, FEMININ, FAMILY; ( Anexa 5 )</a></li>
			</ul>
        </div>

        <div class="clearfix"></div>
    </div><?php }
}
?>