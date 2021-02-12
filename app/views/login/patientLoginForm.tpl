{extends file="login/patientLogin.tpl"}
{block name="content"}

<div class="container" xmlns="http://www.w3.org/1999/html">
    <div id="logo" >
            <div class="content">
                <header>
                    <div class="align-center">
                    <h2 align="center">Zaloguj się</h2>
                     </div>
                </header>

                <form method="POST" action="{$conf->action_url}patientLogin">
                    <div class="row-cols-xl-auto" align="center">
                    <div class="col-xl-3">
                        <label for="pesel">Pesel</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel">
                    </div>
                    <div class="col-xl-3">
                        <label for="password">Hasło</label>
                        <input type="password" class="form-control" name="password" placeholder="Hasło">
                    </div>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" id="remember-me" name="remember-me">
                        <label for="demo-copy">Zapamiętaj mnie</label>
                    </div>
                        <button type="submit" class="btn btn-default btn-lg">Zaloguj</button>
                        <button type="button" class="btn btn-default btn-lg" onclick="location.href='{$conf->action_root}registerShowForm';">Zarejestruj</button>
                </form>
            </div>
    </div>
</div>
{/block}
