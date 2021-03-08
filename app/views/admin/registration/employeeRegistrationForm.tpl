{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/loginNav.tpl"}
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz rejestracji pracownika</h2>
            <form method="post" action="{$conf->action_url}registerEmployee">
                <div class="row-cols-xl-auto" align="center">
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel</label>
                        <input type="pesel" class="form-control" name="pesel" placeholder="Pesel" value="{$form->pesel}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="name">Imie</label>
                        <input type="name" class="form-control" name="name" placeholder="Imie" value="{$form->name}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="second_name">Drugie imie</label>
                        <input type="second_name" class="form-control" name="second_name" value="{$form->secondName}" placeholder="Drugie imie">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="surname">Nazwisko</label>
                        <input type="surname" class="form-control" name="surname" placeholder="Nazwisko" value="{$form->surname}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="profession">Zawód</label>
                        <input type="profession" class="form-control" name="profession" placeholder="Zawód" value="{$form->profession}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="phone">Numer telefonu</label>
                        <input type="phone" class="form-control" name="phone" placeholder="Numer telefonu" value="{$form->phone}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="email">Adres e-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Adres e-mail" value="{$form->email}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="password">Hasło</label>
                        <input type="password" class="form-control" name="password" placeholder="Hasło" value="{$form->password}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <div class="panel panel-info" width="50%">
                            <div class="panel-heading">
                                <label for="flexRadioDefault">Wybierz rolę:</label>
                            </div>
                            <div class="panel-body">
                                <select name="role">
                                    <option value="user" {if $form->role === "user"}selected{/if}>Użytkownik</option>
                                    <option value="admin" {if $form->role === "admin"}selected{/if}>Administrator</option>
                                </select>
                                </div>
                            </div>
                        </div>
                    <div class="col-xl-3">
                        <div class="panel panel-info" width="50%">
                        <div class="panel-heading">
                            <label for="flexRadioDefault">Czy użytkownik jest aktywny:</label>
                        </div>
                        <div class="panel-body">
                            <div class="form-check">
                                <input type="checkbox" id="active" name="active" value="true" {if $form->isActive === "true"} checked{/if}>
                                <label for="active">Aktywny</label>
                            </div>

                        </div>
                        </div>
                    </div>
                </div>
        </div>
                    <button type="submit" class="btn btn-default btn-lg">Zarejestruj</button>
                </div>
            </form>
        </div>
    </div>
{/block}
