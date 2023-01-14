{if isset($smarty.request.pdf)}

   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament Proba Culturala</strong></h3>
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
    <p class="home"><strong>Proba Culturala - Lista Echipe Stafeta Muntilor</strong>  </p>
    <div class="total-continut">
        <div class='TabelListaCluburi'>

{/if}
	<table class="afisare-tabel" align="center" style="width: 100%" >
            <tr>
                <th style="width:5%">Loc</th>
                <th style="width:50%">Echipa</th>
				<th style="width:10%">Cultural</th>
				{if !isset($smarty.request.pdf)}
			  <th style="width:10%"></th>
			  {/if}
            </tr>
            {foreach from=$totalclubs item="clubs" }
                <tr>
                    <td class="numere-tabel">{if $clubs.scor_cultural == 0}-{else}{$number++} {/if}</td>
                    <td class="text-tabel left">{$clubs.club_name} </td>
					<td class="numere-tabel">{$clubs.scor_cultural} </td>
				{if !isset($smarty.request.pdf)}
                    <td class="tabel-optiune"><a href="/stafeta/?page=cultural/update&club_id={$clubs.club_id}">Completeaza</a></td>
				{/if}
                </tr>
            {/foreach}
        </table>
		
		
{if !isset($smarty.request.pdf)}
    </div>
</div>
<a href="{$smarty.server.REQUEST_URI}&pdf=1" target="_blank" class="btn btn-primary clone">Export Clasament to PDF</a>
{/if}