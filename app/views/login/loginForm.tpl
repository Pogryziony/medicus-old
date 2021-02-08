{extends file="login.tpl"}
{block name="content"}

<div class="container">
    <div id="logo">
        <section id="banner">
            <div class="content">
                <header>
                    <div class="align-center">
                    <h2 align="center">Zaloguj się</h2>
                     </div>
                </header>
        <form method="POST" action="{$conf->action_url}login">
            <div class="row gtr-uniform">
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-12-small col-8-large">
                    <input type="text" name="email" id="email" placeholder="Email">
                </div>
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-12-small col-8-large">
                    <input type="password" name="password" id="password" placeholder="Hasło">
                </div>
                <div class="col-4 col-2-large"></div>

                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-12-small col-8-large">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="demo-copy">Zapamiętaj mnie</label>
                </div>
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-2-large"></div>
                <div class="col-4 col-12-small col-8-large">
                    <input type="submit" value="Zaloguj" class="primary fit">
                    <input type="button" value="Zarejestruj się" class="primary fit">
                </div>
                <div class="col-12">

                </div>
            </div>
{/block}
