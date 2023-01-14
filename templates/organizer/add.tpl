			<p class="home"><strong>Organizatorul etapei</strong></p>
			<div class="total-continut">

				<form action="/stafeta/?page=organizer/add" method="POST">
					<div id="aduagare-organizator">
						<div id="name-trophy" class="name-trophy">
							<div>Nume Etapa : <input type="text" name="name_trophy" id="name-trophy" value="{$addorg.name_trophy}" size="50" required oninvalid="this.setCustomValidity('Introduceti numele etapei')" oninput="setCustomValidity('')" >
							</div>
						</div>
						
						<div id="name-organizer" class="name-organizer">
							<div>Nume Organizator: <input type="text" name="name_organizer" id="name_organizer" value="{$addorg.name_organizer}" size="50" required oninvalid="this.setCustomValidity('Introduceti numele organizatorului')" oninput="setCustomValidity('')" >
							</div>
						</div>
						
						<div id="phase-trophy">Etapa este de tip
							<select name="phase_trophy" class="phase-trophy">
								<option value="" selected>-- selecteaza --</option>
								<option value="Master">Master</option>
								<option value="Challange">Challange</option>
								<option value="Amical">Amical</option>
							</select>
						</div>
						<input type="submit" name="Trimite" id="Trimite" value="Trimite" class="btn btn-primary clone">
						<input type="reset" name="reset" id="reset" value="Reset!" class="btn btn-primary clone">
					</div>
				</form>
				
			
			</div> 
