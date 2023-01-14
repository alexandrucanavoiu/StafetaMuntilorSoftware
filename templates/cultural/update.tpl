			<p class="home"><strong>{$club.club_name} - Proba Culturala</strong></p>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
		
			<form action="/stafeta/?page=cultural/update&club_id={$club.club_id}" method="POST" autocomplete="off">
    
			<p>
					<label for="scor_cultural" class="scor-cultural"> Scor Cultural </label>
					<input type="number" name="scor_cultural" id="scor_cultural" value="{if $club}{$club.scor_cultural}{/if}" size="50" required placeholder="introduceti punctajul"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
			</p>
			<p class="formular-continut button"> 
				<input type="submit" name="submit" id="submit" value="Update">
			</p>
			</form>
							</div>
						</div>
			</div>
			<a href="/stafeta/?page=cultural/lists" class="btn btn-primary clone">INAPOI</a>