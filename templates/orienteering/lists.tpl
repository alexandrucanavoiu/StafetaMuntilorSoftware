<p class="home"><strong>Proba Orientare - Categoria  {$category.category_name} - Lista Echipe Stafeta Muntilor</strong></p>
<div class="total-continut">
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel">
            <tr>
                <td class="tabel-optiune">Nr</td>
                <td class="tabel-nume"><div class="text-top-tabel">Echipa</div></td>
				<td class="tabel-optiune">Start</td>
				<td class="tabel-optiune">Finish</td>
				<td class="tabel-optiune">Abandon</td>
				<td class="tabel-optiune">Posturi ratate</td>
                <td class="tabel-optiune"></td>
            </tr>
            {foreach from=$totalteams item="team" }
                <tr>
                    <td class="numere-tabel">{$number++} </div></td>
                    <td class=""><a href="/stafeta/?page=orienteering/update&category_id={$category_id}&team_id={$team.team_id}"> {$team.team_name} </a> </div></td>
					<td class="numere-tabel">{$team.start} </div></td>
					<td class="numere-tabel">{$team.finish} </div></td>
					<td class="numere-tabel">{if $team.abandon == 0 } NU {elseif $team.abandon == 1} DA {else} {/if} </div></td>
					<td class="numere-tabel">{$team.missed_posts} </div></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=orienteering/update&category_id={$category_id}&team_id={$team.team_id}">Completeaza</a></div></td>
                </tr>
            {/foreach}
        </table>
    </div>
</div>
