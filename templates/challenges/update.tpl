<p class="home"><strong>Configurare proba {$challenge.challenge_name} - {$category.category_name}</strong></p>
	
<div class="total-continut">

    <form method="POST" action="/stafeta/?page=challenges/update" autocomplete="off" class="form-horizontal sm-form" role="form">
        <input type="hidden" name="challenge_id" value="{$challenge_id}"/>
        <input type="hidden" name="category_id" value="{$category_id}"/>
        <div class="">
            {if $categoryChallenge.challenge_id == 1}
                {include file="challenges/components/raid.tpl"}
            {/if}
        </div>
		<div class="sm-buttons">
            <input type="submit" class="btn btn-primary" value="Salveaza" />
            {if !empty($categoryChallenge.category_challenge_id)}
                <a class="btn btn-default" href="/stafeta/?page=challenges/delete&category_challenge_id={$categoryChallenge.category_challenge_id}">Șterge</a>
                <a class="btn btn-default" href="/stafeta/?page=challenges/results&category_id={$category_id}&challenge_id={$challenge_id}">Adaugă rezultate</a>
            {/if}
        </div>
    </form>


</div>

