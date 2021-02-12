{extends file="login/doctorLogin.tpl"}
{block name="content"}

<div class="container">
    <div id="logo">

                <header>
                    <div class="align-center">
                    <h2 align="center">Zaloguj się</h2>
                     </div>
                </header>

        <form method="POST" action="{$conf->action_url}doctorLogin">
            <div class="row-cols-xl-auto" align="center">
                <div class="col-xl-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
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
            <button type="submit" class="btn btn-default">Zaloguj</button>
        </form>
    </div>
</div>

{/block}
