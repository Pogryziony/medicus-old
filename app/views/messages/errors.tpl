{if $msgs->isError()}
    <ul>
        {foreach $msgs->getMessages() as $msg}
            <li>{$msg->text}</li>
        {/foreach}
    </ul>
{/if}
