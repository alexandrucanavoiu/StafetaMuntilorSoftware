{if isset($smarty.request.pdf)}
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament Proba Orientare
			<br />
				- Categoria  {$category.category_name} - </strong></h3>
                <br/>
                {$organizer.name_trophy} - {$organizer.phase_trophy}
                <br/>
                Organizator {$organizer.name_organizer}
				<br />
				{if ($organizer.phase_trophy == "Amical") }
				Acest clasament nu se cumuleaza in cadrul Stafeta Muntilor.
				{/if}
            </td>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
        </tr>
    </table>
    <br/>

{else}
    <p class="home"><strong>Clasament Proba Orientare - Categoria  {$category.category_name}</strong>  </p>

    <div class="total-continut">
        <div class='TabelListaCluburi'>
{/if}

        <table class="afisare-tabel" style="width: 100%" >
				<tr>
					<th style="width:5%"><strong>Loc</strong></th>
					<th style="width:40%"><strong>Echipa</strong></th>
					<th style="width:30%"><strong>Nume Concurent</strong></th>
					<th style="width:10%"><strong>Timp Realizat</strong></th>
					<th style="width:10%"><strong>Punctaj</strong></th>

				</tr>
				
				{foreach from=$ranking item="team"}
					<tr>
						<td class="numere-tabel">{if empty($team.orienteering_id) || $team.orienteering_abandon == 1 || $team.missed_posts > 0}{else}{$team.rank}{/if}</td>
						<td class="text-tabel left"><a href="{url('orienteering/update', ['category_id' => $category.category_id, 'team_id' => $team.team_id])}">{$team.team_name}</a></td>
						<td class="text-tabel left">{$team.name_participant|default:'-'}</td>
						<td class="numere-tabel">{if $team.orienteering_abandon == 1 || empty($team.orienteering_id)} Abandon {elseif $team.missed_posts >= 1} Post Lipsa {else} {$team.total}  {/if}</td>
						<td class="numere-tabel">{if $team.orienteering_abandon == 1} 0 {elseif $team.missed_posts >= 1} 0 {else} {$team.score} {/if}</td>
					</tr>
				{/foreach}
			</table>

{if !isset($smarty.request.pdf)}
    </div>
</div>

<a href="/stafeta/?page=ranking/lists&category_id={$category.category_id}" class="btn btn-primary clone">INAPOI</a>
<a href="{$smarty.server.REQUEST_URI}&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
{/if}