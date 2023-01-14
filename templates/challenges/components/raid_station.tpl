{if isset($type)}
    {if $type == 3}
        {$hide_add_button = true}
        {$hide_delete_button = true}
        {$hide_input = false}
    {elseif ($type == 0)}
        {$hide_add_button = true}
        {$hide_delete_button = true}
        {$hide_input = true}
	{else}
        {$is_station = true}
    {/if}
{/if}


<div class="toclone station {if $is_station}is-station{/if}" {if isset($type)}data-type="{$type}"{/if}>
	<input type="hidden" name="station_id[]" class="station-id" value="{if $station}{$station.station_id}{else}0{/if}" />
	<span class="label">{$index|default:""}</span>
	{if isset($types) && count($types) == 1}
		<input type="hidden" name="station_type[]" value="{$types.0}" />
            <span class="station-type">
			{$first = $types.0}
			{$station_types.$first}
            </span>
	{else}
		<select name="station_type[]">
			{foreach from=$station_types item="station_name" key="station_type"}
				{if !isset($types) || in_array($station_type, $types)}
					{assign var="selected" value=false}
					{if isset($station) && $station.station_type == $station_type}
						{assign var="selected" value=true}
					{/if}
					{if isset($type) && $type == $station_type}
						{assign var="selectedx" value=true}
					{/if}
					<option {if $selected}selected="selected" {/if} value="{$station_type}">{$station_name}</option>
				{/if}
			{/foreach}
		</select>
	{/if}

	
	<input name="value[]" placeholder="" class="value" type="{if $hide_input}hidden{else}text{/if}" {if $station}value="{if $station.station_type == 1 || $station.station_type == 3}{$station.maximum_time}{elseif $station.station_type == 2}{$station.score}{/if}"{/if} />
	<span class="value-label"></span>

	
	{if !$hide_add_button}
		<a href="#" class="btn btn-primary clone">adaugă</a>
	{/if}

	{if !$hide_delete_button}
		<a href="#" class="btn btn-default delete">șterge</a>
	{/if}
</div>