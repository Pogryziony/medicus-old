{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/employeeModuleNav.tpl"}
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz rejestracji pacjenta</h2>
            <form method="POST" action="{$conf->action_url}registerNewAppointment">
                <div class="row-cols-xl-auto " align="center">
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pacjenta</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="{$form->pesel}" required>
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="date">Data wizyty</label>
                        <input class="datepicker" type="text" name="date" id="date" placeholder="Data">
                        <br/>
                    </div>

                    <div class="col-xl-3">
                        <label for="purpose">Cel wizyty</label>
                        <input type="city" class="form-control" name="purpose"  value="{$form->city}" placeholder="Cel wizyty" required>
                        <br/>
                    </div>

                    <button type="submit" class="btn btn-default btn-lg">Dodaj wizytę</button>
                </div>
            </form>
        </div>
    </div>
{/block}
