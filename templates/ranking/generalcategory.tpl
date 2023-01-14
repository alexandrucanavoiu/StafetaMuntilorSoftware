{if isset($smarty.request.pdf)}
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament General <br /> - Categoria  {$category.category_name} -</strong></h3>
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
    <p class="home"><strong>Clasament General - Categoria  {$category.category_name} -</strong>  </p>
    <div class="total-continut">
        <div class='TabelListaCluburi'>
{/if}

        <table class="afisare-tabel" style="width: 100%" >
            <tr>
                 <th style="width:5%">Loc</th>
				<th style="width:40%">Echipa</th>
				<th style="width:10%">Raid Montan</th>
				<th style="width:10%">Orientare</th>
				<th style="width:12%">Cunostinte Turistice</th>
				<th style="width:10%">Total</th>
				<th style="width:12%">Punctaj Stafeta Muntilor</th>
            </tr>
			
			{foreach from=$items item="item" name="orienteeringName" }
			
				 <tr>
                    <td class="numere-tabel">{$item.rank}</td>
                    <td class="text-tabel left">{$item.team_name}</td>
					<td class="numere-tabel">{if empty($item.raid_abandon)}{$item.raid_score}{else}Abandon{/if}</td>
					<td class="numere-tabel">{if empty($item.orienteering_abandon)}{$item.orienteering_score}{else}Abandon{/if}</td>
					<td class="numere-tabel">{if empty($item.knowledge_abandon)}{$item.knowledge_score}{else}Abandon{/if}</td>
					<td class="numere-tabel">{$item.score}</td>
					<td class="numere-tabel">{$item.sm_score}</td>
                </tr>
				
			{/foreach}		

        </table>
		
{if !isset($smarty.request.pdf)}
    </div>
</div>

<a href="/stafeta/?page=ranking/lists&category_id={$category.category_id}" class="btn btn-primary clone">INAPOI</a>
<a href="{$smarty.server.REQUEST_URI}&pdf=1" target="_blank" class="btn btn-primary clone">Export to PDF</a>
{/if}