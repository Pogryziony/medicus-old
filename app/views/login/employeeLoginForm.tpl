{extends file="common.tpl"}
{block name="content"}
{include file="common_elements/navigation/loginNav.tpl"}
<div id="featured">
    <div class="container" xmlns="http://www.w3.org/1999/html"  >
        <div class="align-center">
            <h2 align="center">Zaloguj się</h2>
        </div>

        <form method="POST" action="{$conf->action_url}employeeLogin">
            <div class="row-cols-xl-auto" align="center">
                <div class="col-xl-3">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Email">
                </div>
                <div class="col-xl-3">
                    <label for="password">Hasło</label>
                    <input type="password" class="form-control" name="password" placeholder="Hasło">
                </div>
                <div class="col-xl-3">
                    <input type="checkbox" id="remember-me" name="remember-me">
                    <label for="demo-copy">Zapamiętaj mnie</label>
                </div>
                <div class="col-xl-3">
                    <button type="submit" class="btn btn-default btn-lg btn-block">Zaloguj</button>
                </div>
            </div>
        </form>
    </div>

{/block}
