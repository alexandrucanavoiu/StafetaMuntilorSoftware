			<script src="js/lib/jquery.inputmask.bundle.min.js"></script>
			<script>
			$(document).ready(function() {
				if (typeof($.fn.inputmask) == 'function') {
					$(".time").inputmask("h:s:s",{ "placeholder": "hh:mm:ss" });
				}
			});
			</script>

			<center><p class="home"><strong>{$team.team_name} - (Proba Cunostinte Turistice) - Categoria {$category.category_name} </strong>
			<br />
			Club: {$team.club_name} </p>
			</center>
			<div class="total-continut">
			                  <div id="formular">
                        <div id="formular-continut" class="animate form">
			<form action="/stafeta/?page=knowledge/update&category_id={$category.category_id}&team_id={$team.team_id}" method="POST" autocomplete="off">
					
					<p>
					<label for="time1" class="time1"> Timp Realizat :</label>
					<input type="text" name="time" id="time" class="time" value="{if $knowledge}{$knowledge.time}{/if}" size="50" required placeholder="introduceti timpul in formatul: hh:mm:ss"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >
					</p>
					
					<br />
					<p>
					<label for="answer" class="answer"> Intrebari Gresite : </label>
					<input type="text" name="answers" id="answer" value="{if $knowledge}{$knowledge.answers}{/if}" size="50" required placeholder="numarul de intrebari gresite"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >				
					</p>

					<br />
					<p>
					<label for="wrongquestions" class="wrongquestions"> Sau gresit intrebarile: </label>
					<input type="text" name="wrongquestions" id="wrongquestions" value="{if $knowledge}{$knowledge.wrongquestions}{/if}" size="50" placeholder="Sa raspuns gresit la urmatoarele intrebari. Ex: 1,2,7,10 (nr intrebre gresita si virgula)"  oninvalid="this.setCustomValidity('Camp obligatoiu')" oninput="setCustomValidity('')" >				
					</p>


					<br />
					<p>
					<label for="abandon" class="abandon"> Abandon / Neprezentare:  </label>
					
					<select name="abandon" class="abandon">
							<option value="0"  {if $knowledge && $knowledge.abandon == 0}selected="selected"{/if}>Nu</option>
							<option value="1"  {if $knowledge && $knowledge.abandon == 1}selected="selected"{/if}>Da</option>
						</select>
					</p>
							<p class="formular-continut button"> 
					<input type="submit" name="submit" id="submit" value="Update">
							</p>
						
			</form>			</div>
								
						</div>
<a href="/stafeta/?page=knowledge/lists&category_id={$category.category_id}" class="btn btn-primary clone">INAPOI</a>
<br /><br />

													<div><b>Nota:</b></div>
													<p>Se va completa in felul urmator:</p>
													<p>Timp Realizat: 00:03:05  unde 00 (ore), 03 (minute), 05 (secunde).</p>
													<p>Intrebari Gresite: cate intrebari a gresit echipa ( in cifre). Exemplu: 2 </p>
													<p>Sau gresit intrebarile: care sunt intrebarile gresite. Exemplu: 2, 4, 10 </p>
													<p>Abandon / Neprezentare : se va selecta DA, doar daca echipa a abandonat sau nu s-a prezentat.</p>
													<div>
													<strong>Atunci cand este Abandon sau echipa nu s-a prezentat, este important sa adaugati 0 peste tot dupa care se va bifa : Abandon DA </strong>
													</div>
			</div>
