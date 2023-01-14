{if !empty($messages)}
    {$type = $type|default:"notice"}
    {$class = "info"}
    {$title = "Notificare"}

    {if $type == 'error'}
        {$class = "danger"}
        {$title = "Eroare"}
    {/if}

    {if $type == 'success'}
        {$class = "success"}
        {$title = "Succes"}
    {/if}

    {foreach from=$messages item="message"}
        <div class="alert alert-{$class} fade in alert-dismissible" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <strong>{$title}</strong>
            {$message}
        </div>
    {/foreach}
{/if}