<script src="../js/main.js"></script> <!-- Resource jQuery -->

    <script type="text/javascript">
        $(document).ready(function() {
            //Input fields increment limitation
            var maxField = 20;

            //Add button selector
            var addButton = $('.add_button');

            //Input field wrapper
            var wrapper = $('.club_name1');

            //New input field html
            var fieldHTML = '<div class="club_name2"><strong>Nume Club : </strong><input type="text" name="club_name[]" id="club_name" value="" size="50" required ><a href="javascript:void(0);" class="remove_button" title="Remove field"><img src="/stafeta/images/remove-icon.png"/></a> * <div></div></div>';

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


			<p class="home"><strong>Adauga Cluburi Participante - Stafeta Muntilor</strong></p>
			<div class="total-continut">

				<form action="/stafeta/?page=clubs/add" method="POST">
					<div id="aduagare-club">
				{if !empty($message)}
					{$message}
				{/if}
						<div id="club_name1" class="club_name1">
							<div class="club_name2"><strong>Nume Club : </strong> <input type="text" name="club_name[]" id="club_name" value="" size="50" required oninvalid="this.setCustomValidity('Introduceti numele Clubului')" oninput="this.setCustomValidity('')" >
								<a href="javascript:void(0);" class="add_button" title="Add field"><img src="/stafeta/images/add-icon.png"/></a> <span class="error"> *</span>
							</div>
						</div>
						<div class="button-add">
						<input type="submit" name="Trimite" id="Trimite" class="btn btn-primary clone" value="Trimite">
						<input type="reset" name="reset" id="reset" class="btn btn-primary clone" value="Reset!">
						</div>
					</div>
				</form>
				
			
			</div> 
<div class="button-inapoi">
<a href="/stafeta/?page=clubs/lists" class="btn btn-primary clone">INAPOI</a>
</div>