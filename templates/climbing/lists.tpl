<p class="home"><strong>Proba Escalada - Categoria  {$category.category_name} - Lista Echipe Stafeta Muntilor</strong></p>
<div class="total-continut">
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel">
            <tr>
                <td class="tabel-optiune">Nr</td>
                <td class="tabel-nume"><div class="text-top-tabel">Echipa</div></td>
				<td class="tabel-nume">Nume Participant</td>				
				<td class="tabel-optiune">Noduri Lipsa</td>
				<td class="tabel-optiune">Inaltime</td>
				<td class="tabel-optiune">Timp</td>
                <td class="tabel-optiune"></td>
            </tr>
            {foreach from=$totalteams item="team" }
                <tr>
                    <td class="numere-tabel">{$number++} </div></td>
                    <td class="">{$team.team_name} </div></td>
					<td class="numere-tabel">{$team.name_participant} </div></td>
					<td class="numere-tabel">{$team.missed_nods} </div></td>
					<td class="numere-tabel">{if $team.top == 99} TOP {else} {$team.top} {/if}</div></td>
					<td class="numere-tabel">{$team.timp} </div></td>
                    			<td class="tabel-optiune"><a href="/stafeta/?page=climbing/update&category_id={$category_id}&team_id={$team.team_id}">Completeaza</a></div></td>
                </tr>
            {/foreach}
        </table>
    </div>
	<br />

	<a href="/stafeta/?page=others/lists" class="btn btn-primary clone">INAPOI</a>

</div>
