			<script src="js/lib/jquery.inputmask.bundle.min.js"></script>
			<script>
			$(document).ready(function() {
				if (typeof($.fn.inputmask) == 'function') {
					$(".time").inputmask("h:s:s",{ "placeholder": "hh:mm:ss" });
				}
			});
			</script>

			<center><p class="home"><strong>{$team.team_name} - (Proba Orientare) - Categoria {$category.category_name} </strong>
			<br />
			Club: {$team.club_name} </p>
			</center>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
			<form action="/stafeta/?page=orienteering/update&category_id={$category.category_id}&team_id={$team.team_id}" method="POST" autocomplete="off">
    
					<p>
					<label for="name_participant" class="name-participant"> Nume Participant :</label>
					<input type="text" name="name_participant" id="name-participant" value="{if $orienteering}{$orienteering.name_participant}{/if}" size="50" required placeholder="introduceti numele participantului"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="start" class="start"> Timp Start :</label>
					<input type="text" name="start" class="time" id="start" value="{if $orienteering}{$orienteering.start}{/if}" size="50" required placeholder="introduceti timpul in formatul: hh:mm:ss"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="finish" class="finish"> Timp Finish :</label>
					<input type="text" name="finish" class="time" id="finish" value="{if $orienteering}{$orienteering.finish}{/if}" size="50" required placeholder="introduceti timpul in formatul: hh:mm:ss"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="missed_posts" class="missed_posts"> Posturi Ratate :</label>
					<input type="text" name="missed_posts" id="missed_posts" value="{if $orienteering}{$orienteering.missed_posts}{/if}" size="50" required placeholder="in cifre"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					<br />
					<p>
					<label for="abandon" class="abandon"> Abandon / Neprezentare:</label> 
						<select name="abandon" class="abandon">
							<option value="0"  {if $orienteering && $orienteering.abandon == 0}selected="selected"{/if}>Nu</option>
							<option value="1"  {if $orienteering && $orienteering.abandon == 1}selected="selected"{/if}>Da</option>
					</select>
					</p>
			<p class="formular-continut button"> 
				<input type="submit" name="submit" id="submit" value="Update">
			</p>
			</form>
							</div>
						</div>
<a href="/stafeta/?page=orienteering/lists&category_id={$category.category_id}" class="btn btn-primary clone">INAPOI</a>
<br /><br />
													<div><b>Nota:</b></div>
													<p>Se va completa in felul urmator:</p>
													<p>Nume Participant: se va introduce numele participantui.</p>
													<p>Timp Start: 12:03:05  unde 00 (ore), 05 (minute), 05 (secunde).</p>
													<p>Timp Finish: 12:10:03  unde 00 (ore), 03 (minute), 03 (secunde).</p>
													<p>Posturi ratate: cate posturi a ratat participantul: 1,2,3,4 ( in cifre).</p>
													<p>Abandon / Neprezentare : se va selecta DA, doar daca echipa a abandonat sau nu s-a prezentat.</p>
													<div>
													<strong>Atunci cand este Abandon sau echipa nu s-a prezentat, este important sa adaugati 0 peste tot dupa care se va bifa : Abandon DA </strong>
													</div>
													
			</div>