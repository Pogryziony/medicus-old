{if $msgs->isWarning()}
    <ul>
        {foreach $msgs->getMessages() as $msg}
            <li>{$msg->text}</li>
        {/foreach}
    </ul>
{/if}
