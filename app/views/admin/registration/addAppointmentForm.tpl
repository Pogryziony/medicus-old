{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/employeeModuleNav.tpl"}
    <div id="featured">
        <div class="container" xmlns="http://www.w3.org/1999/html">
            <h2>Formularz rejestracji wizyty</h2>
            <form method="POST" action="{$conf->action_url}registerAppointment">
                <div class="row-cols-xl-auto " align="center">
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pacjenta</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="{$form->patientPesel}" required>
                        <br/>
                    </div>
                    <div class="col-xl-3 ">
                        <label for="pesel">Pesel pracownika</label>
                        <input type="text" class="form-control" name="pesel" placeholder="Pesel" value="{$form->employeePesel}" required>
                        <br/>
                    </div>
                    <div class="col-xl-3">
                        <label for="date">Data</label>
                        <input class="datepicker active" type="text" name="date" id="date" placeholder="Data" value="{$form->date|substr:0:10}" required>
                    </div>
                    <div class="col-xl-3">
                        <label for="time">Godzina</label>
                        <input class="hour_picker" type="text" name="time" id="time" placeholder="Godzina" value="{$form->time|substr:11:5}" required>
                    </div>
                    <div class="col-xl-3">
                        <label for="purpose">Cel wizyty</label>
                        <input type="purpose" class="form-control" name="purpose"  value="{$form->purpose}" placeholder="Cel wizyty" required>
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
