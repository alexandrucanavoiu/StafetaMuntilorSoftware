			<script src="js/lib/jquery.inputmask.bundle.min.js"></script>
			<script>
			$(document).ready(function() {
				if (typeof($.fn.inputmask) == 'function') {
					$(".time").inputmask("h:s:s",{ "placeholder": "hh:mm:ss" });
				}
			});
			</script>

			<center><p class="home"><strong>{$team.team_name} - (Proba Escalada) - Categoria {$category.category_name} </strong>
			<br />
			Club: {$team.club_name} </p>
			</center>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
			<form action="/stafeta/?page=climbing/update&category_id={$category.category_id}&team_id={$team.team_id}" method="POST" autocomplete="off">
    
					<p>
					<label for="name_participant" class="name-participant"> Nume Participant :</label>
					<input type="text" name="name_participant" id="name-participant" value="{if $climbing}{$climbing.name_participant}{/if}" size="50" required placeholder="introduceti numele participantului"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="timp" class="timp"> Timp :</label>
					<input type="text" name="timp" id="timp" class="time" value="{if $climbing}{$climbing.timp}{/if}" size="50" required placeholder="introduceti timpul in formatul: hh:mm:ss"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="missed_nods" class="missed-nods"> Noduri Lipsa :</label>
					<input type="text" name="missed_nods" id="missed_nods" value="{if $climbing}{$climbing.missed_nods}{/if}" size="50" required placeholder="in cifre"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="top" class="top"> Inaltime Atinsa:</label> 
						<select name="top" class="top">
							<option value=""  {if $climbing && $climbing.top == ""}selected="selected"{/if}>-</option>
							<option value="99"  {if $climbing && $climbing.top == 99}selected="selected"{/if}>Top</option>
							<option value="30"  {if $climbing && $climbing.top == 30}selected="selected"{/if}>30 m</option>
							<option value="29.5"  {if $climbing && $climbing.top == 29.5}selected="selected"{/if}>29.5 m</option>
							<option value="29"  {if $climbing && $climbing.top == 29}selected="selected"{/if}>29 m</option>
							<option value="28.5"  {if $climbing && $climbing.top == 28.5}selected="selected"{/if}>28.5 m</option>
							<option value="28"  {if $climbing && $climbing.top == 28}selected="selected"{/if}>28 m</option>
							<option value="27.5"  {if $climbing && $climbing.top == 27.5}selected="selected"{/if}>27.5 m</option>
							<option value="27"  {if $climbing && $climbing.top == 27}selected="selected"{/if}>27 m</option>
							<option value="26.5"  {if $climbing && $climbing.top == 26.5}selected="selected"{/if}>26.5 m</option>
							<option value="26"  {if $climbing && $climbing.top == 26}selected="selected"{/if}>26 m</option>
							<option value="25.5"  {if $climbing && $climbing.top == 25.5}selected="selected"{/if}>25.5 m</option>
							<option value="25"  {if $climbing && $climbing.top == 25}selected="selected"{/if}>25 m</option>
							<option value="24.5"  {if $climbing && $climbing.top == 24.5}selected="selected"{/if}>24.5 m</option>
							<option value="24"  {if $climbing && $climbing.top == 24}selected="selected"{/if}>24 m</option>
							<option value="23.5"  {if $climbing && $climbing.top == 23.5}selected="selected"{/if}>23.5 m</option>
							<option value="23"  {if $climbing && $climbing.top == 23}selected="selected"{/if}>23 m</option>
							<option value="22.5"  {if $climbing && $climbing.top == 22.5}selected="selected"{/if}>22.5 m</option>
							<option value="22"  {if $climbing && $climbing.top == 22}selected="selected"{/if}>22 m</option>
							<option value="21.5"  {if $climbing && $climbing.top == 21.5}selected="selected"{/if}>21.5 m</option>
							<option value="21"  {if $climbing && $climbing.top == 21}selected="selected"{/if}>21 m</option>
							<option value="20.5"  {if $climbing && $climbing.top == 20.5}selected="selected"{/if}>20.5 m</option>
							<option value="20"  {if $climbing && $climbing.top == 20}selected="selected"{/if}>20 m</option>
							<option value="19.5"  {if $climbing && $climbing.top == 19.5}selected="selected"{/if}>19.5 m</option>
							<option value="19"  {if $climbing && $climbing.top == 19}selected="selected"{/if}>19 m</option>
							<option value="18.5"  {if $climbing && $climbing.top == 18.5}selected="selected"{/if}>18.5 m</option>
							<option value="18"  {if $climbing && $climbing.top == 18}selected="selected"{/if}>18 m</option>
							<option value="17.5"  {if $climbing && $climbing.top == 17.5}selected="selected"{/if}>17.5 m</option>
							<option value="17"  {if $climbing && $climbing.top == 17}selected="selected"{/if}>17 m</option>
							<option value="16.5"  {if $climbing && $climbing.top == 16.5}selected="selected"{/if}>16.5 m</option>
							<option value="16"  {if $climbing && $climbing.top == 16}selected="selected"{/if}>16 m</option>
							<option value="15.5"  {if $climbing && $climbing.top == 15.5}selected="selected"{/if}>15.5 m</option>
							<option value="15"  {if $climbing && $climbing.top == 15}selected="selected"{/if}>15 m</option>
							<option value="14.5"  {if $climbing && $climbing.top == 14.5}selected="selected"{/if}>14.5 m</option>
							<option value="14"  {if $climbing && $climbing.top == 14}selected="selected"{/if}>14 m</option>
							<option value="13.5"  {if $climbing && $climbing.top == 13.5}selected="selected"{/if}>13.5 m</option>
							<option value="13"  {if $climbing && $climbing.top == 13}selected="selected"{/if}>13 m</option>
							<option value="12.5"  {if $climbing && $climbing.top == 12.5}selected="selected"{/if}>12.5 m</option>
							<option value="12"  {if $climbing && $climbing.top == 12}selected="selected"{/if}>12 m</option>
							<option value="11.5"  {if $climbing && $climbing.top == 11.5}selected="selected"{/if}>11.5 m</option>
							<option value="11"  {if $climbing && $climbing.top == 11}selected="selected"{/if}>11 m</option>
							<option value="10.5"  {if $climbing && $climbing.top == 10.5}selected="selected"{/if}>10.5 m</option>
							<option value="10"  {if $climbing && $climbing.top == 10}selected="selected"{/if}>10 m</option>
							<option value="9.5"  {if $climbing && $climbing.top == 9.5}selected="selected"{/if}>9.5 m</option>
							<option value="9"  {if $climbing && $climbing.top == 9}selected="selected"{/if}>9 m</option>
							<option value="8.5"  {if $climbing && $climbing.top == 8.5}selected="selected"{/if}>8.5 m</option>
							<option value="8"  {if $climbing && $climbing.top == 8}selected="selected"{/if}>8 m</option>
							<option value="7.5"  {if $climbing && $climbing.top == 7.5}selected="selected"{/if}>7.5 m</option>
							<option value="7"  {if $climbing && $climbing.top == 7}selected="selected"{/if}>7 m</option>
							<option value="6.5"  {if $climbing && $climbing.top == 6.5}selected="selected"{/if}>6.5 m</option>
							<option value="6"  {if $climbing && $climbing.top == 6}selected="selected"{/if}>6 m</option>
							<option value="5.5"  {if $climbing && $climbing.top == 5.5}selected="selected"{/if}>5.5 m</option>
							<option value="5"  {if $climbing && $climbing.top == 5}selected="selected"{/if}>5 m</option>
							<option value="4.5"  {if $climbing && $climbing.top == 4.5}selected="selected"{/if}>4.5 m</option>
							<option value="4"  {if $climbing && $climbing.top == 4}selected="selected"{/if}>4 m</option>
							<option value="3.5"  {if $climbing && $climbing.top == 3.5}selected="selected"{/if}>3.5 m</option>
							<option value="3"  {if $climbing && $climbing.top == 3}selected="selected"{/if}>3 m</option>
							<option value="2.5"  {if $climbing && $climbing.top == 2.5}selected="selected"{/if}>2.5 m</option>
							<option value="2"  {if $climbing && $climbing.top == 2}selected="selected"{/if}>2 m</option>
							<option value="1.5"  {if $climbing && $climbing.top == 1.5}selected="selected"{/if}>1.5 m</option>
							<option value="1"  {if $climbing && $climbing.top == 1}selected="selected"{/if}>1 m</option>
							<option value="0"  {if $climbing && $climbing.top == 0}selected="selected"{/if}>0 m</option>
					</select>
					</p>
					<br />
					<p>
					<label for="abandon" class="abandon"> Abandon / Neprezentare:</label> 
						<select name="abandon" class="abandon">
							<option value="0"  {if $climbing && $climbing.top == 0}selected="selected"{/if}>Nu</option>
							<option value="1"  {if $climbing && $climbing.top == 1}selected="selected"{/if}>Da</option>
					</select>
					</p>
			<p class="formular-continut button"> 
				<input type="submit" name="submit" id="submit" value="Update">
				
			</p>
			</form>
							</div>

						
						</div>
<a href="/stafeta/?page=climbing/lists&category_id={$category.category_id}" class="btn btn-primary clone">Inapoi</a>	
<br /><br />
													<div><b>Nota:</b></div>
													<p>Se va completa in felul urmator:</p>
													<p>Nume Participant: se va introduce numele participantui.</p>
													<p>Timp: 12:03:05  unde 00 (ore), 05 (minute), 05 (secunde).</p>
													<p>Noduri Lipsa: numarul de noduri pe care nu le-a realizat in timp: 1,2,3,4 ( in cifre).</p>
													<p>Abandon / Neprezentare : se va selecta DA, doar daca echipa a abandonat sau nu s-a prezentat.</p>
			</div>
