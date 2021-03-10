{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/loginNav.tpl"}
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz rejestracji pacjenta</h2>
            <form method="POST" action="{$conf->action_url}registerPatient">
                <div class="row-cols-xl-auto " align="center">
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="{$form->pesel}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="name">Imie</label>
                        <input type="name" class="form-control" name="name" placeholder="Imie" value="{$form->name}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="second_name">Drugie imie</label>
                        <input type="second_name" class="form-control" name="second_name" value="{$form->second_name}" placeholder="Drugie imie">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="surname">Nazwisko</label>
                        <input type="surname" class="form-control" name="surname" placeholder="Nazwisko" value="{$form->surname}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="voivodeship">Województwo</label>
                        <input type="voivodeship" class="form-control" name="voivodeship" value="{$form->voivodeship}" placeholder="Województwo">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="city">Miasto</label>
                        <input type="city" class="form-control" name="city"  value="{$form->city}" placeholder="Miasto" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="street">Ulica</label>
                        <input type="street" class="form-control" name="street" placeholder="Ulica" value="{$form->street}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="house_number">Numer domu lub bloku</label>
                        <input type="house_number" class="form-control" name="house_number" placeholder="Numer domu lub bloku" value="{$form->house_number}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="flat_number">Numer mieszkania</label>
                        <input type="flat_number" class="form-control" name="flat_number" placeholder="Numer mieszkania" value="{$form->flat_number}">
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
                    <button type="submit" class="btn btn-default btn-lg">Zarejestruj</button>
                </div>
            </form>
        </div>
    </div>
{/block}
