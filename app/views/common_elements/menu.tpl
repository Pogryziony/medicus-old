<div id="sidebar">
    <div class="inner">
        <nav id="menu">
            <header class="major">
                <h2>Menu</h2>
            </header>
        <ul>
            <li><a href="{$conf->action_url}dashboard">Strona główna</a></li>
            <li>
                    <span class="opener">Godziny</span>
                    <ul>
                        <li><a href="{$conf->action_url}dashboard">Bieżący miesiąc</a></li>
{*                        <li><a href="#">Poprzednie miesiące</a></li>*}
                    </ul>
                </li>
                <li><a href="{$conf->action_url}showReports">Raporty</a></li>
                <li>
                    <span class="opener">Konfiguracja Email</span>
                    <ul>
                        <li><a href="{$conf->action_url}showRecipients">Odbiorcy</a></li>
                        <li><a href="{$conf->action_url}showEmailTemplates">Szablony wiadomości</a></li>
{*                        <li><a href="#">Wysłane wiadomości</a></li>*}
{*                        <li><a href="#">Wyślij</a></li>*}
                    </ul>
                </li>
                <li><a href="{$conf->action_url}logout">Wyloguj</a></li>
            </ul>
        </nav>
    </div>
</div>
