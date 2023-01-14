{if isset($smarty.request.pdf)}
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament Proba Cunostinte Turistice			<br />
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
    <p class="home"><strong>Clasament Proba Cunostinte Turistice - Categoria  {$category.category_name} - </strong>  </p>
    <div class="total-continut">
        <div class='TabelListaCluburi'>
{/if}

        <table class="afisare-tabel" style="width: 100%" >
			<tr>
                <th style="width:8%">Loc</th>
               <th style="width:30%">Nume Echipa</th>
				<th style="width:10%">Greseli</th>
				<th style="width:auto">{if !isset($smarty.request.pdf)} Intrebarile gresite {/if}{if isset($smarty.request.pdf)} Ai gresit la <br /> intrebarile cu numarul {/if}</th>
				<th style="width:10%">Scor</th>
				<th style="width:9%">Timp</th>

            </tr>
            {foreach from=$lists item="teams" }
                <tr>
                    <td class="numere-tabel">{$teams.rank|default:'-'}</td>
                    <td class="text-tabel left"><a href="/stafeta/?page=knowledge/update&category_id={$category_id}&team_id={$teams.team_id}">{$teams.team_name} </a></td>
					<td class="numere-tabel">{if $teams.abandon == 1} - {else} {$teams.answers} {/if}</td>
					<td class="numere-tabel">{if $teams.abandon == 1} - {else} {$teams.wrongquestions} {/if}</td>
					<td class="numere-tabel">{if $teams.abandon == 1} Abandon {else} {$teams.scor}  {/if}  </td>
					<td class="numere-tabel">{if $teams.abandon == 1} - {else} {$teams.time} {/if}</td>
                   
                </tr>
            {/foreach}
        </table>
		
{if !isset($smarty.request.pdf)}
    </div>
</div>

<a href="/stafeta/?page=ranking/lists&category_id={$category.category_id}" class="btn btn-primary clone">INAPOI</a>
<a href="{$smarty.server.REQUEST_URI}&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
{/if}