<div class="col-sm-12">
    <div class="stations cloneable">
        {if empty($stations)}
            {include file="challenges/components/raid_station.tpl" type=0 types=[0]}
            {include file="challenges/components/raid_station.tpl" type=1 types=[1,2] index=1}
            {include file="challenges/components/raid_station.tpl" type=3 types=[3]}
        {else}
            {foreach from=$stations item="station"}
                {if $station.station_type == 1}
                    {$types = [1,2]}
                {elseif $station.station_type == 2}
                    {$types = [1,2]}
                {else}
                    {$types = [$station.station_type]}
                {/if}
                {include file="challenges/components/raid_station.tpl" type=$station.station_type types=$types station=$station}
            {/foreach}
        {/if}
    </div>
</div>