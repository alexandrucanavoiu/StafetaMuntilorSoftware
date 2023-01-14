<p class="home"><strong>{$team.team_name} - Proba {$challenge.challenge_name} - Categoria {$category.category_name} </strong>
    {if !empty($categoryChallenge)}
        <small>
            - <a href="/stafeta/?page=challenges/update&challenge_id={$categoryChallenge.challenge_id}&category_id={$categoryChallenge.category_id}">vezi configuratie</a>
        </small>
        {/if}
    <br />
    Club: {$team.club.club_name}
</p>


<div class="total-continut">
    <form method="POST" action="/stafeta/?page=challenges/update_results" autocomplete="off" class="form-horizontal sm-form" role="form">
        <input type="hidden" name="category_challenge_id" value="{$categoryChallenge.category_challenge_id}"/>
        <input type="hidden" name="team_id" value="{$team.team_id}"/>

        <div class="col-sm-6">
            <div class="form-group">
                <label class="control-label col-sm-5" for="abandon">Abandon:</label>
                <div class="col-sm-2">
                    <input type="hidden" name="participation[abandonment]" value="0">
                    <input type="checkbox" id="abandon" name="participation[abandonment]" value="1" {if $participation.abandonment == 1}checked="checked"{/if}>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="missing_footwear">Lipsa bocanci:</label>
                <div class="col-sm-2">
                    <input type="hidden" name="participation[missing_footwear]" value="0">
                    <input type="checkbox" id="missing_footwear" name="participation[missing_footwear]" value="1" {if $participation.missing_footwear == 1}checked="checked"{/if}>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="gear">Lipsa echipamente:</label>
                <div class="col-sm-2">
                    <input type="number" class="form-control" id="gear" value="{$participation.missing_equipment_items|default:0}" min="0" name="participation[missing_equipment_items]">
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="minimum_distance_penalty">Nerespectare distanta intre membrii:</label>
                <div class="col-sm-2">
                    <input type="hidden" name="participation[minimum_distance_penalty]" value="0">
                    <input type="checkbox" id="minimum_distance_penalty" name="participation[minimum_distance_penalty]" value="1" {if $participation.minimum_distance_penalty == 1}checked="checked"{/if}>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5" for="abandon">Posturi:</label>
                <div class="col-sm-2">
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <table class="stations cloneable">
                {if empty($entries)}
                    {$entries = $stations}
                {/if}

                {foreach from=$entries item="entry"}
                    {if $entry.station_type == 1}
                        {$types = [1,2]}
                    {elseif $entry.station_type == 2}
                        {$types = [1,2]}
                    {else}
                        {$types = [$entry.station_type]}
                    {/if}
                    {include file="challenges/components/raid_station_result.tpl" type=$entry.station_type types=$types entry=$entry}
                {/foreach}
            </table>
        </div>


        <div class="form-group">
            <div class="col-sm-12">
                <button type="submit" class="btn btn-default">Salvează</button>
            </div>
        </div>

    </form>


</div>