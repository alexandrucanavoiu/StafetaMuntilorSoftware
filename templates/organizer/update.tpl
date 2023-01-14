			<p class="home"><strong>Configureaza numele organizatorul</strong></p>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
							<form action="/stafeta/?page=organizer/update&id_organizer=1" method="POST" autocomplete="off">
                                <p> 
                                    <label for="name_trophy" class="name-trophy"> Numele Etapei </label>
                                    <input type="text" name="name_trophy" id="name-trophy" value="{if $knowledge}{$knowledge.name_trophy}{/if}" size="50" required oninvalid="this.setCustomValidity('Introduceti numele etapei')" oninput="setCustomValidity('')" >
                                </p>
								<br />
                                <p> 
                                    <label for="name_organizer" class="name-organizer"> Numele Organizatorului</label>
                                    <input type="text" name="name_organizer" id="name_organizer" value="{if $knowledge}{$knowledge.name_organizer}{/if}" size="50" required oninvalid="this.setCustomValidity('Introduceti numele organizatorului')" oninput="setCustomValidity('')" >
                                </p>
								<br />
								<p>
									<label for="phase_trophy" class="phase-trophy"> Etapa este de tip: </label>
								<select name="phase_trophy" class="phase-trophy">
								<option value="Master" {if ($knowledge.phase_trophy == 'Master')}selected{/if}>Master </option>
								<option value="Challenge" {if $knowledge.phase_trophy == 'Challenge'}selected{/if}>Challenge</option>
								<option value="Amical" {if $knowledge.phase_trophy == 'Amical'}selected{/if}>Amical</option>
							</select>
							<p class="formular-continut button"> 
						<input type="submit" name="Trimite" id="Trimite" value="Trimite" class="btn btn-primary clone">
						<input type="reset" name="reset" id="reset" value="Reset!" class="btn btn-primary clone">
							</p>
							</form>
							</div>
						</div>
			
			</div> 
