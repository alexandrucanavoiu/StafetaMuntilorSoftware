<p class="home"><strong>Editare Echipa Participante - Stafeta Muntilor</strong></p>
<div class="total-continut">
<div id="formular">
<div id="formular-continut" class="animate form">
						
				<form action="/stafeta/?page=teams/update&team_id={$row.team_id}" method="POST" autocomplete="off">
				

				{if !empty($message)}
					{$message}
				{/if}
				
					<p>
					<label for="club_id" class="club_id"> Nume Club:</label>
				
					<select name="club_id" id="club_id">
					{foreach from=$totalclubs item="club"} 
					<option value="{$club.club_id}" {if ($club.club_id == $row.club_id) } { selected } {/if}>{$club.club_name}</option>
					{/foreach}
					</select>
					</p>
					
					<br />
				
					<p>
					<label for="team_name" class="club_id"> Nume Echipa:</label>
					<input type="text" name="team_name" id="numeEchipa" value="{$row.team_name}" size="50" required   oninvalid="this.setCustomValidity('Introduceti numele echipei')" oninput="setCustomValidity('')" >
					</p>
					
					<p>
					<label for="category_id" class="category_id"> Categoria:</label>
						<select name="category_id" id="Categorie">
						{foreach from=$categories item="categorie"} 
						<option value="{$categorie.category_id}" {if ($categorie.category_id == $row.category_id) } { selected } {/if} >{$categorie.category_name}</option>
						{/foreach}
						</select>
					</p>
					
					<p class="formular-continut button"> 
						<input type="submit" name="Trimite" id="Trimite" value="Trimite">
						<input type="reset" name="reset" id="reset" value="Reset!">
					</p>

				</form>
				
</div>
</div>
<a href="/stafeta/?page=teams/lists" class="btn btn-primary clone">INAPOI</a>
<br /><br />
													<div><b>Nota:</b></div>
													<p>Se va completa in felul urmator:</p>
													<p>Nume Club: se va selecta Clubul dorit.</p>
													<p>Nume Echipa: se va modifica numele echipei care va participa din partea clubului selectat mai sus.</p>
													<p>Categoria: se va selecta categoria la care va participa echipa introdusa mai sus.</p>
</div> 