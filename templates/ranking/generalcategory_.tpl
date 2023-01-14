<p class="home"><strong>Clasament General Categoria  {$category.category_name} </strong></p>
<div class="total-continut">
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel"> 
            <tr>
                <td class="tabel-optiune">Loc</td>
                <td class="tabel-nume">Echipa</td>
				<td class="tabel-nume">Raid Montan</td>
				<td class="tabel-optiune">Orientare</td>
				<td class="tabel-optiune">Cunostinte Turistice</td>
				<td class="tabel-optiune">Total</td>
				<td class="tabel-optiune">Punctaj Stafeta Muntilor</td>
            </tr>
			
			{foreach from=$orienteering item="teams" name="orienteeringName" }
			
				 <tr>
                    <td class="numere-tabel"></td>
                    <td class="text-tabel">{$teams.team_name}</td>
					<td class="numere-tabel">0</td>
					<td class="numere-tabel">{if $teams.abandon == 1} 0 {elseif $teams.missed_posts >= 1} 0 {else} {$results[$smarty.foreach.orienteeringName.index].score} {/if}</td>
                    <td class="numere-tabel">{if $teams.abandon == 1} 0 {else} {$teams.scor} {/if}</td>
					<td class="numere-tabel">{$results[$smarty.foreach.orienteeringName.index].score + $teams.scor}</td>
					<td class="numere-tabel"></td>
                </tr>
				
			{/foreach}		

        </table>
    </div>
</div>

<a href="/stafeta/?page=ranking/lists&category_id={$category.category_id}" class="btn btn-primary clone">INAPOI</a>
<a href="{$smarty.server.REQUEST_URI}&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>