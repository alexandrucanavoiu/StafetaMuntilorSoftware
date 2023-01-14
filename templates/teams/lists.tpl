<p class="home"><strong>Lista Echipelor Participante - Stafeta Muntilor</strong></p>
<div class="total-continut">
    <div><a href="/stafeta/?page=teams/add" class="btn btn-primary clone">ADAUGA ECHIPA</a>
	<a href="/stafeta/?page=teams/listsbyteams" class="btn btn-primary clone">LISTA ECHIPE IN FUNCTIE DE CATEGORII</a></div>
	
	
			<form action="" method="POST" id="sort-clubs">
				<strong>Filtreaza in functie de categorie: </strong>
				
					<select name="category_id" id="category_id">
					<option value="">Toate</option>
					<option value="1" {if $categorie == 1} selected {/if}>Family</option>
					<option value="2" {if $categorie == 2} selected {/if}>Juniori</option>
					<option value="3" {if $categorie == 3} selected {/if}>Elite</option>
					<option value="4" {if $categorie == 4} selected {/if}>Open</option>
					<option value="5" {if $categorie == 5} selected {/if}>Veterani</option>
					<option value="6" {if $categorie == 6} selected {/if}>Feminin</option>
					</select>

						<input type="submit" class="btn btn-primary clone" name="Aplica" id="Aplica" value="Aplica">

				</form>
	
	
	
	<br />	
    <div class='TabelListaCluburi'>
        <table class="afisare-tabel">
            <tr>
                <td class="tabel-optiune"><div class="text-top-tabel">Nr</div></td>
				<td class="tabel-nume"><div class="text-top-tabel">Club</div></td>
                <td class="tabel-nume"><div class="text-top-tabel">Echipa</div></td>
				<td class="afisare-categorie"><div class="text-top-tabel">Categorie</div></td>
                <td class="tabel-optiune"></td>
                <td class="tabel-optiune"></td>
            </tr>
            {foreach from=$totalteams item="teams"}
                <tr>
                    <td><div class="tabel-centrat">{$number++}</div></td>
					<td><div class="text-tabel">{$teams.club_name}</div></td>
                    <td><div class="text-tabel">{$teams.team_name}</div></td>
					<td><div class="tabel-centrat">{$teams.category_name}</div></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=teams/update&team_id={$teams.team_id}">Editare</a></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=teams/delete&team_id={$teams.team_id}">Sterge</a></td>
                </tr>
            {/foreach}
        </table>
    </div>
</div>
