<p class="home"><strong>Rezultate Proba - {$category.category_name} - {$challenge.challenge_name}</strong></p>

<div class="total-continut">
    {if !empty($categoryChallenge.category_challenge_id)}
        <table class="afisare-tabel">
            <tr>
                <th>Nume Echipa</th>
                <th></th>
            </tr>
            {foreach from=$entries item="entry"}
                <tr>
                    <td><a href="/stafeta/?page=teams/update&team_id={$entry.team_id}">{$entry.team_name}</a></td>
                    <td class="tabel-optiune"><a href="/stafeta/?page=challenges/update_results&category_challenge_id={$categoryChallenge.category_challenge_id}&team_id={$entry.team_id}">Modifica</a></td>
                </tr>
            {/foreach}
        </table>
    {else}
        Inainte de a introduce rezultatele probei, te rugam sa <a href="/stafeta/?page=challenges/update&challenge_id={$challenge.challenge_id}&category_id={$category.category_id}"><b>configurezi proba aici</b></a>.
    {/if}


</div>