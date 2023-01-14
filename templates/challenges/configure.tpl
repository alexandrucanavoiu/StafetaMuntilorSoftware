<p class="home"><strong>Configurare Etapa - Stafeta Muntilor</strong></p>
<div class="total-continut">
    <div class="organizator"><strong>Organizator:</strong>
        <div class="modifica"><a href="/stafeta/?page=organizer/update&id_organizer=1">MODIFICA </a></div>
    </div>
	
    {foreach from=$categories item="category"}
        <div class="organizator"><strong>Categoria {$category.category_name}:</strong>
            {foreach from=$challenges item="challenge"}
				{if $challenge.challenge_id == 1}
                <div>
                    {$challenge.challenge_name}
                    <div class="adauga"><a href="/stafeta/?page=challenges/update&challenge_id={$challenge.challenge_id}&category_id={$category.category_id}">Configureaza</a></div>
                </div>
				{/if}
            {/foreach}
        </div>
    {/foreach}

    <br>
    <br>
    <br>
    <form method="POST" action="{url('challenges/configure')}" autocomplete="off" class="form-horizontal sm-form" role="form" id="eraseForm">

        <div class="col-sm-6">
            <div class="panel panel-danger">
                <div class="panel-heading">Ștergere date</div>
                <div class="panel-body">
                    {foreach from=$tables item="relatedTables" key="label"}
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="tables[]" value="{','|implode:$relatedTables}" checked="checked">
                                {$label}
                            </label>
                        </div>
                    {/foreach}
                    <div class="form-group">
                        <div class="col-sm-12">
                            <br>
                            <button type="submit" class="btn btn-danger confirm-submit" data-toggle="modal" data-target="#confirm">Șterge</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>


    <div class="modal fade" id="confirm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    Confirmare ștergere date
                </div>
                <div class="modal-body">
                    Esti sigur ca vrei să ștergi datele?
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Anulare</button>
                    <a href="#" id="submit" class="btn btn-danger danger confirm-ok" data-form="#eraseForm">Șterge</a>
                </div>
            </div>
        </div>
    </div>

</div>