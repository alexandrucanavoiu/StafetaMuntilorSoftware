{if isset($smarty.request.pdf)}
   <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Lista Cluburilor in functie de numarul <br /> de echipe pe categorii</strong></h3>
                <br/>
                {$organizer.name_trophy} - {$organizer.phase_trophy}
                <br/>
                Organizator {$organizer.name_organizer}
            </td>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
        </tr>
    </table>
    <br/>

{else}
    <p class="home"><strong>Lista Echipelor inscrise in functie de numar si categorie</strong>  </p>
    <div class="total-continut">
        <div class='TabelListaCluburi'>
{/if}

        <table class="afisare-tabel" style="width: 100%" >
            <tr>
                <th style="width:5%">Nr</th>
				<th style="width:45%">Nume Club</th>
                		 <th style="width:7%">Echipe Inscrise</th>
				 <th style="width:7%">Echipe Family</th>
				 <th style="width:7%">Echipe Juniori</th>
				 <th style="width:7%">Echipe Elite</th>
				 <th style="width:7%">Echipe Open</th>
				 <th style="width:7%">Echipe Veterani</th>
				 <th style="width:7%">Echipe Feminin</th>


            </tr>
            {foreach from=$totalteams item="teams"}
               <tr title="">
                    <td class="numere-tabel">{$number++}</td>
					<td class="text-tabel left">{$teams.club_name}</td>
                    <td class="numere-tabel">{$teams.echipe}</td>
					<td class="numere-tabel">{$teams.family}</td>
					<td class="numere-tabel">{$teams.juniori}</td>
					<td class="numere-tabel">{$teams.elite}</td>
					<td class="numere-tabel">{$teams.open}</td>
					<td class="numere-tabel">{$teams.veterani}</td>
					<td class="numere-tabel">{$teams.feminin}</td>
        </tr>
            {/foreach}
        </table>

		
{if !isset($smarty.request.pdf)}
        </div>
    </div>
    <br>
<a href="/stafeta/?page=teams/lists" class="btn btn-primary clone">INAPOI</a>
<a href="{$smarty.server.REQUEST_URI}&pdf=1&&orientation=L" target="_blank" class="btn btn-primary clone">Export to PDF</a>
{/if}