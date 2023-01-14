    <script type="text/javascript">
        $(document).ready(function() {
            //Input fields increment limitation
            var maxField = 20;

            //Add button selector
            var addButton = $('.add_button');

            //Input field wrapper
            var wrapper = $('.numeEchipa');

            //New input field html
            var fieldHTML = '<div>Nume Echipa: <input type="text" name="team_name[]" id="numeEchipa" value="{$liststeams.team_name}" size="50" required oninvalid="this.setCustomValidity("Introduceti numele echipei")" oninput="setCustomValidity("")" >Categoria:<select name="category_id[]" id="Categorie">{foreach from=$categories item="categorie"} <option value="{$categorie.category_id}">{$categorie.category_name}</option>{/foreach}</select><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/stafeta/images/remove-icon.png"/></a> * <div></div></div>';

            //Initial field counter is 1
            var x = 1;
            //Once add button is clicked
            $(addButton).click(function() {

                //Check maximum number of input fields
                if(x < maxField){

                    //Increment field counter
                    x++;

                    // Add field html
                    $(wrapper).append(fieldHTML);
                }
            });
            $(wrapper).on('click', '.remove_button', function(e) {
                //Once remove button is clicked
                e.preventDefault();

                //Remove field html
                $(this).parent('div').remove();

                //Decrement field counter
                x--;
            });
        });
    </script>
	
			<p class="home"><strong>Adauga Echipa Cunostinte Turistice - Stafeta Muntilor</strong></p>
			<div class="total-continut">

				<form action="/stafeta/?page=teams/add" method="POST">
					<div id="aduagare-club">
				{if !empty($message)}
					{$message}
				{/if}
				<div>Nume Club: 
				
					<select name="club_id" id="numeClub">
					{foreach from=$totalclubs item="club"} 
					<option value="{$club.club_id}">{$club.club_name}</option>
					{/foreach}
					</select>
				
				</div>
				
				<div id="numeEchipa" class="numeEchipa">
						<div>Echipa: xxx :  <br />
						Intrebari Gresite: <input type="text" name="team_name[]" id="numeEchipa" value="{$teams.team_name}" size="10" required   oninvalid="this.setCustomValidity('Camp obligatoriu')" oninput="setCustomValidity('')" >
						Timp Realizat: <input type="text" name="team_name[]" id="numeEchipa" value="{$teams.team_name}" size="10" required   oninvalid="this.setCustomValidity('Camp obligatoriu')" oninput="setCustomValidity('')" >

						<a href="javascript:void(0);" class="add_button" title="Add field"><img src="/stafeta/images/add-icon.png"/></a> <span class="error"> *</span>
						</div>
						</div>
						<input type="submit" name="Trimite" id="Trimite" value="Trimite">
						<input type="reset" name="reset" id="reset" value="Reset!">
				</div>
				</form>
				
			
			</div> 