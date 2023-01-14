<p class="home"><strong>Cunostinte Turistice - Categoria  {$category.category_name} - Lista Echipe Stafeta Muntilor</strong></p>
<div class="total-continut">
	<br />	
    <div class='{if isset($smarty.request.pdf)} print {else} TabelListaCluburi {/if}'>
        <table class="afisare-tabel"> 
            <tr>
                <td class="tabel-optiune">Nr</td>
                <td class="tabel-nume"><div class="text-top-tabel">Echipa</div></td>
				<td class="tabel-optiune">Nr. Greseli</td>
				<td class="tabel-optiune">Intrebari Gresite</td>
				<td class="tabel-optiune">Timp Realizat</td>
				<td class="tabel-optiune">Abandon</td>
                <td class="tabel-optiune"></td>
            </tr>
            {foreach from=$totalteams item="teams" }
                <tr>
                    <td class="numere-tabel"><div>{$number++} </div></td>
                    <td class="text-tabel"><div><a href="/stafeta/?page=knowledge/update&category_id={$category_id}&team_id={$teams.team_id}">{$teams.team_name} </a></div></td>
					<td class="numere-tabel"><div>{$teams.answers} </div></td>
					<td class="numere-tabel"><div>{$teams.wrongquestions} </div></td>
					<td class="numere-tabel"><div>{$teams.time} </div></td>
					<td class="numere-tabel"><div>{if $teams.abandon == 0 } NU {elseif $teams.abandon == 1} DA {else} {/if}</div></td>
                    <td class="tabel-optiune"><div><a href="/stafeta/?page=knowledge/update&category_id={$category_id}&team_id={$teams.team_id}">Completeaza</a></div></td>
                </tr>
            {/foreach}
        </table>
    </div>
</div>
