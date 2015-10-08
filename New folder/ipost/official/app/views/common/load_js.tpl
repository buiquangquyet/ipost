    {* ------------- Load : Javascript [Start] ------------- *}
    {if isset($js) && is_array($js)}
      {foreach from=$js item=entry}
        {$entry}
      {/foreach}
    {/if}
    {* ------------- Load : Javascript [End]   ------------- *}
