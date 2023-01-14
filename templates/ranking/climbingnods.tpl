{if isset($smarty.request.pdf)}
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
				<h3><strong>Clasament Proba Escalada Noduri 
			<br />
				- Categoria  {$category.category_name} - </strong></h3>
			<br />
				{$organizer.name_trophy} - {$organizer.phase_trophy}
			<br />
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
    <p class="home"><strong>Clasament Proba Escalada Noduri  - Categoria  {$category.category_name} </strong>  </p>
	<br />
    <div class="total-continut">
        <div class='TabelListaCluburi'>
{/if}
	<table class="afisare-tabel" style="width: 100% " >
            <tr>
                <th style="width:5%">Loc</th>
				<th style="width:35%">Echipa</th>
				<th style="width:20%">Nume Participant</th>
				<th style="width:10%">Noduri Lipsa</th>
				<th style="width:10%">Timp</th>

            </tr>
            {foreach from=$lists item="teams" }
                <tr>
                    <td class="numere-tabel">{if $teams.abandon == 1} - {else}  {$teams.rank}   {/if}</td>
                    <td class="text-tabel left"><a href="/stafeta/?page=climbing/update&category_id={$category_id}&team_id={$teams.team_id}">{$teams.team_name} </a></td>
					<td class="text-tabel left">{$teams.name_participant} </td>
					<td class="numere-tabel">{if $teams.abandon == 1} - {else} {$teams.missed_nods}  {/if}  </td>
					<td class="numere-tabel">{if $teams.abandon == 1} Abandon {else} {$teams.timp} {/if}</td>
                   
                </tr>
            {/foreach}
        </table>
		
		
{if !isset($smarty.request.pdf)}
    </div>
</div>

<a href="/stafeta/?page=others/lists" class="btn btn-primary clone">INAPOI</a>
<a href="/stafeta/?page=climbing/lists&category_id={$category.category_id}" class="btn btn-primary clone">Completeaza</a>
<a href="{$smarty.server.REQUEST_URI}&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
{/if}