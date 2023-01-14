<p class="home"><strong>Lista Echipelor Participante - Stafeta Muntilor</strong></p>
<div class="total-continut">
    <div><a href="/stafeta/?page=teams/add" class="btn btn-primary clone">ADAUGA ECHIPA</a></div>
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel">
            <tr>
                
				<td class="tabel-nume"><div class="text-top-tabel">Club</div></td>
                <td class="tabel-nume"><div class="text-top-tabel">Echipa</div></td>
				<td class="afisare-categorie"><div class="text-top-tabel">Categorie</div></td>
                <td class="tabel-optiune"></td>
                <td class="tabel-optiune"></td>
            </tr>
            {foreach from=$totalteams item="teams"}
                <tr>
                    
					<td><div class="text-tabel">{$teams.club_name}</div></td>
                    <td><div class="text-tabel">{$teams.team_name}</div></td>
					<td><div class="text-tabel">{$teams.category_name}</div></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=teams/update&team_id={$teams.team_id}">Editare</a></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=teams/delete&team_id={$teams.team_id}">Sterge</a></td>
                </tr>
            {/foreach}
        </table>
    </div>
</div>
