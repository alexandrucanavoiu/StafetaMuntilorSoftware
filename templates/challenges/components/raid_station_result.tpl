{$s_placeholder = 'plecare'}
{$f_placeholder = 'sosire'}

{$sid = $entry.station_id}
{$s_class = ''}
{$f_class = ''}

{$s_attr = ''}
{$f_attr = ''}

{if isset($type)}
    {if $type == 3}
        {$hide_input = true}
        {$s_attr = 'readonly="readonly"'}
    {elseif ($type == 0)}
        {$hide_input = true}
        {$f_attr = 'readonly="readonly"'}
	{else}
        {$is_station = true}
    {/if}
{/if}

<tr class="toclone station {if $is_station}is-station{/if}" {if isset($type)}data-type="{$type}"{/if}>
    <td>
        <span class="name">{getStationName($entry)}</span>
        <input type="hidden" name="entries[{$sid}][station_id]" class="station-id" value="{if $entry}{$entry.station_id}{else}0{/if}" />
        <input type="hidden" name="entries[{$sid}][entry_id]" value="{$entry.entry_id|default:0}" />
    </td>

    <td>
        <span class="label">{getStationLabel($entry)}</span>
    </td>

    <td>
        {if $type == 2}
            <input type="hidden" name="entries[{$sid}][hits]" value="1" />
            <label><input type="checkbox" name="entries[{$sid}][hits]" value="0" {if isset($entry.hits) && $entry.hits == 0}checked="checked"{/if} /> Post ratat</label>

        {else}
            <input type="text" name="entries[{$sid}][time_finish]" placeholder="{$f_placeholder}" class="{$f_class} time" {$f_attr} value="{$entry.time_finish|default:''}" />
            <input type="text" name="entries[{$sid}][time_start]"  placeholder="{$s_placeholder}" class="{$s_class} time" {$s_attr} value="{$entry.time_start|default:''}" />
        {/if}
    </td>

    <td>
        <span class="value">{if $entry.station_type == 1}{$entry.maximum_time}{elseif $entry.station_type == 2}{$entry.score}{/if}</span>
    </td>

    <td>
        <span class="value-label"></span>
    </td>
    <td>
    </td>

</tr>