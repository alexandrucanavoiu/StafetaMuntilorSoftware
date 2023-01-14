			<p class="home"><strong>Editare - Nume Club - Participare - Stafeta Muntilor</strong></p>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
						
			<form action="/stafeta/?page=clubs/update&club_id={$row.club_id}" method="POST" autocomplete="off">
 
				<p>
				<label for="club_name" class="club-name"> Nume Club :</label>
				<input type="text" name="club_name" id="club-name" value="{$row.club_name}" size="50" required   oninvalid="this.setCustomValidity('Introduceti numele clubului')" oninput="setCustomValidity('')" >
				</p>
					
				<p class="formular-continut button"> 
					<input type="hidden" name="club_id" value="{$row.club_id}">
					<input type="submit" name="submit" id="submit" value="Update">
				</p>
					

			</div>
			</form>
			</div>
			</div>
			</div>
			<a href="/stafeta/?page=clubs/lists" class="btn btn-primary clone">INAPOI</a>