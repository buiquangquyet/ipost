    {* ------------- Load : CSS [Start] ------------- *}
    {if isset($css) && is_array($css)}
      {foreach from=$css item=entry}
        {$entry}
      {/foreach}
    {/if}
    {* ------------- Load : CSS [End]   ------------- *}
