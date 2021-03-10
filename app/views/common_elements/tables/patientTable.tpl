{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/employeeModuleNav.tpl"}

    <div id="featured">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista pacjentów</h4>
            </div>

            <div class="panel-body">
                <table class="table table-hover" align="center">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>Pesel</th>
                        <th>Imię</th>
                        <th>Drugie imię</th>
                        <th>Nazwisko</th>
                        <th>Województwo</th>
                        <th>Miasto</th>
                        <th>Ulica</th>
                        <th>Numer domu</th>
                        <th>Numer mieszkania</th>
                        <th>Numer telefonu</th>
                        <th>Adres email</th>
                        <th>Akcja</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $patient as $pat}
                        <tr>
                            <td>{$pat["id"]}</td>
                            <td>{$pat["pesel"]}</td>
                            <td>{$pat["name"]}</td>
                            <td>{($pat["second_name"]) ? $pat["second_name"] : "---"}</td>
                            <td>{$pat["surname"]}</td>
                            <td>{$pat["voivodeship"]}</td>
                            <td>{$pat["city"]}</td>
                            <td>{$pat["street"]}</td>
                            <td>{$pat["house_number"]}</td>
                            <td>{($pat["flat_number"]) ? $pat["flat_number"] : "---"}</td>
                            <td>{$pat["phone"]}</td>
                            <td>{$pat["email"]}</td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-default dropdown-toggle"
                                            type="button" id="actionDrop"
                                            data-toggle="dropdown"
                                            aria-haspopup="true"
                                            aria-expanded="true">
                                        Rozwiń
                                    </button>
                                    <ul class="dropdown-menu" aria-labelledby="actionDrop">
                                        <li><a class="glyphicon glyphicon-pencil" aria-hidden="true" data-target="#" href="#" >Edytuj</a></li>
                                        <li><a class="glyphicon glyphicon-trash" aria-hidden="true" href="#">Usuń</a></li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    {/foreach}
                </table>
            </div>

            <div class="panel-footer">
                <button type="button" class="button btn-lg" onclick="location.href='{$conf->action_root}generateAdminPatientRegistrationView';">Dodaj pacjenta</button>
            </div>
        </div>

    </div>
{/block}
