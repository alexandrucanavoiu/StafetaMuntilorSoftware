<p class="home"><strong>Lista Cluburi Participante - Stafeta Muntilor</strong></p>
<div class="total-continut">
    <div><a href="/stafeta/?page=clubs/add" class="btn btn-primary clone">ADAUGA CLUB</a></div>
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel">
            <tr>
				<td class="tabel-optiune"><div class="text-top-tabel">Nr.</div></td>
                <td class="tabel-nume"><div class="text-top-tabel">Nume Club</div></td>
                <td class="tabel-optiune"></td>
                <td class="tabel-optiune"></td>
            </tr>
            {foreach from=$totalclubs item="club"}
                <tr>
					<td class="numere-tabel">{$number++}</td>
                    <td><div class="t">{$club.club_name}</div></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=clubs/update&club_id={$club.club_id}">Editare</a></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=clubs/delete&club_id={$club.club_id}">Sterge</a></td>
                </tr>
            {/foreach}
        </table>
    </div>

</div>