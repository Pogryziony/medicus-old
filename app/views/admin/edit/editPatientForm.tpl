{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/employeeModuleNav.tpl"}
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz edycji pacjenta</h2>
            <form method="post" action="{$conf->action_url}savePatient">
                <div class="row-cols-xl-auto" align="center">
                    <input type="id" class="form-control visually-hidden" name="id" placeholder="id" value="{if $action === "editPatient"}{$form->id}{/if}" required>
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel</label>
                        <input type="pesel" class="form-control" name="pesel" placeholder="Pesel" value="{if $action === "editPatient"}{$form->pesel}{/if}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="name">Imie</label>
                        <input type="name" class="form-control" name="name" placeholder="Imie" value="{if $action === "editPatient"}{$form->name}{/if}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="second_name">Drugie imie</label>
                        <input type="second_name" class="form-control" name="second_name" value="{if $action === "editPatient"}{$form->secondName}{/if}" placeholder="Drugie imie">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="surname">Nazwisko</label>
                        <input type="surname" class="form-control" name="surname" placeholder="Nazwisko" value="{if $action === "editPatient"}{$form->surname}{/if}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="voivodeship">Województwo</label>
                        <input type="voivodeship" class="form-control" name="voivodeship" placeholder="Województwo" value="{if $action === "editPatient"}{$form->voivodeship}{/if}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="city">Miasto</label>
                        <input type="city" class="form-control" name="city" placeholder="Miasto" value="{if $action === "editPatient"}{$form->city}{/if}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="street">Ulica</label>
                        <input type="street" class="form-control" name="street" placeholder="Ulica" value="{if $action === "editPatient"}{$form->street}{/if}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="house_number">Numer domu</label>
                        <input type="house_number" class="form-control" name="house_number" placeholder="Numer domu" value="{if $action === "editPatient"}{$form->houseNumber}{/if}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="flat_number">Zawód</label>
                        <input type="flat_number" class="form-control" name="flat_number" placeholder="Numer mieszkania" value="{if $action === "editPatient"}{$form->flatNumber}{/if}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="phone">Numer telefonu</label>
                        <input type="phone" class="form-control" name="phone" placeholder="Numer telefonu" value="{if $action === "editPatient"}{$form->phone}{/if}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="email">Adres e-mail</label>
                        <input type="email" class="form-control" name="email" placeholder="Adres e-mail" value="{if $action === "editPatient"}{$form->email}{/if}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="password">Hasło</label>
                        <input type="password" class="form-control" name="password" placeholder="Hasło" value="{if $action === "editPatient"}{$form->password}{/if}">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <label for="flexRadioDefault">Czy użytkownik jest aktywny:</label>
                            </div>
                            <div class="panel-body">
                                <div class="form-check">
                                    <input type="checkbox" id="active" name="active" value="true" {if {$form->isActive}}checked{/if}>
                                    <label for="active">Aktywny</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <button type="submit" class="btn btn-default btn-lg">Edytuj</button>
        </form>
    </div>

{/block}
