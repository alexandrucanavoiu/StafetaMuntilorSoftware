{if isset($smarty.request.pdf)}
    <table border=0 align="center" >
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament General conform <br /> Regulament Stafeta Muntilor </strong></h3>
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
{else}
    <p class="home"><strong>Clasament General conform Regulament Stafeta Muntilor </strong></p>
{/if}

<div class="total-continut">
	<br />	
    <div class='TabelListaCluburi'>
        <table style="width: 100%" class="afisare-tabel">
            <tr>
                <td style="width: 3% text-align: center" class="tabel-optiune">Loc</td>
                <td style="width: 40%" class="tabel-nume">Club</td>
                {foreach from=$categories item="category"}
                    <td style="width: 6%"  class="tabel-optiune">{$category.category_name}</td>
                {/foreach}
                <td style="width: 6%" class="tabel-optiune">Cultural</td>
                <td style="width: 6%" class="tabel-optiune">Bonus echipe</td>
                <td style="width: 6%" class="tabel-optiune">Total</td>
            </tr>
			
			{foreach from=$ranking item="item" }
			
				 <tr>
                    <td class="numere-tabel">{$item.rank}</td>
                    <td class="text-tabel">{$item.club_name}</td>
                     {foreach from=$categories item="category"}
                         {$cid = $category.category_id}
                         <td class="numere-tabel">
                             {if array_key_exists($cid, $item.ignored_ranking)}<s>{/if}
                             {if !empty($item.ranking.$cid)}
                                 {$item.ranking.$cid}
                             {/if}
                             {if array_key_exists($cid, $item.ignored_ranking)}</s>{/if}
                         </td>
                     {/foreach}
                     <td class="numere-tabel">
                         {if !empty($item.scor_cultural)}
                             {$item.scor_cultural}
                         {/if}
                     </td>
                     <td class="numere-tabel">
                         {if !empty($item.bonus)}
                             {$item.bonus}
                         {/if}
                     </td>
                     <td class="numere-tabel">
                         {if !empty($item.total)}
                             {$item.total}
                         {/if}
                     </td>
                 </tr>
				
			{/foreach}		

        </table>
    </div>
</div>

{if !isset($smarty.request.pdf)}
    <a href="{$smarty.server.REQUEST_URI}&pdf=1&orientation=L" target="_blank" class="btn btn-primary clone">Export to PDF</a>
{/if}
