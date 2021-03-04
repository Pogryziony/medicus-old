{if !$msgs->isEmpty()}
    <ul class="list-group alert-danger">
        {foreach $msgs->getMessages() as $msg}
            <li class="list-group-item">{$msg->text}</li>
        {/foreach}
    </ul>
{/if}
</div>
