{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/employeeModuleNav.tpl"}
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz rejestracji wizyty</h2>
            <form method="POST" action="{$conf->action_url}editAppointment">
                <div class="row-cols-xl-auto " align="center">
                    <input type="id" class="form-control visually-hidden" name="id" placeholder="id" value="{if $action === "editAppointment"}{$form->id}{/if}" required>
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pacjenta</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="{if $action === "editAppointment"}{$form->patientPesel}{/if}" required>
                        <br/>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pracownika</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="{if $action === "editAppointment"}{$form->employeePesel}{/if}" required>
                        <br/>
                    </div>
                    <div class="col-xl-3">
                        <label for="date">Data</label>
                        <input class="datepicker active" type="text" name="date" id="date" placeholder="Data" value="{if $action === "editAppointment"}{$form->date}{/if}" required>
                    </div>
                    <div class="col-xl-3">
                        <label for="time">Godzina</label>
                        <input class="hour_picker" type="text" name="time" id="time" placeholder="Godzina" value="{if $action === "editAppointment"}{$form->time}{/if}" required>
                    </div>
                    <div class="col-xl-3">
                        <label for="purpose">Cel wizyty</label>
                        <input type="purpose" class="form-control" name="purpose"  value="{if $action === "editAppointment"}{$form->purpose}{/if}" placeholder="Cel wizyty" required>
                        <br/>
                    </div>

                    <button type="submit" class="button btn-lg">Dodaj wizytę</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{$conf->assets_url}js/datepicker/picker.js"></script>
    <script src="{$conf->assets_url}js/datepicker/datepicker.min.js"></script>
    <script src="{$conf->assets_url}js/datepicker/addAppointmentForm.js"></script>
{/block}
