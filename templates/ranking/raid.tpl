{$showLogs = isset($smarty.request.logs)}
{if isset($smarty.request.pdf)}
    <table border=0 align="center">
        <tr>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
            <td style="border:none;" align="center">
                <h3><strong>Clasament Proba Raid Montan
                        <br/>
                        - Categoria  {$category.category_name} - </strong></h3>
                <br/>
                {$organizer.name_trophy} - {$organizer.phase_trophy}
                <br/>
                Organizator {$organizer.name_organizer}
				<br />
				{if ($organizer.phase_trophy == "Amical") }
				Acest clasament nu se cumuleaza in cadrul Stafeta Muntilor.
				{/if}
            </td>
            <td style="border:none;"><img src="images/logo.png" width="100"></td>
        </tr>
    </table>
    <br/>
{else}
    <p class="home"><strong>Clasament proba <a href="{url("challenges/update", ['challenge_id' => $challenge.challenge_id, 'category_id' => $category.category_id])}">{$challenge.challenge_name} - Categoria  {$category.category_name}</a> </strong>  </p>
    <a href="/stafeta/?page=ranking/raid&category_id={$category.category_id}&logs=1" class="btn btn-primary clone">Vezi clasament cu loguri</a>
    <div class="total-continut">
        <div class='TabelListaCluburi'>
{/if}


<table class="afisare-tabel" style="width: 100%" >
    <tr>
        <th style="width:8%">Loc</th>
        <th style="width:50%">Echipa</th>
        <th style="width:6%">Scor</th>
        <th style="width:10%">Timp total</th>
        {if $showLogs}
           <th class="text-left" style="width:47%">Depunctarea</th>
        {/if}
    </tr>
    {foreach from=$ranks item="team" }
        <tr title="">
            <td class="numere-tabel">{$team.rank}</td>
            <td class="text-tabel left"><a href="{url("challenges/update_results", ['category_challenge_id' => $categoryChallengeId, 'team_id' => $team.team_id])}">{$team.team_name}</a></td>
            <td class="numere-tabel">{$team.score}</td>
            <td class="numere-tabel" title="{$team.raid_total_time_text_log}">{$team.raid_total_time_text}</td>
            {if $showLogs}
                <td class="logs left">
                    {if !empty($team.logs)}
                        {foreach from=$team.logs item="log"}
                            {$log}<br>
                        {/foreach}
                    {else}
                        <span>Fara penalizare</span>
                    {/if}
                </td>
            {/if}
        </tr>
    {/foreach}
</table>

{if !isset($smarty.request.pdf)}
        </div>
    </div>
    <br>
    <a href="/stafeta/?page=ranking/lists&category_id={$category.category_id}" class="btn btn-primary clone">INAPOI</a>
    <a href="{$smarty.server.REQUEST_URI}&pdf=1&orientation=L" target="_blank" class="btn btn-primary clone">Export to PDF</a>
{/if}