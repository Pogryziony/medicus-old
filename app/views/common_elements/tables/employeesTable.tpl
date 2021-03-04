{extends file="common.tpl"}
{block name="content"}
{include file="common_elements/navigation/employeeModuleNav.tpl"}
    <div id="featured">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista pracowników</h4>
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
                        <th>Stanowisko</th>
                        <th>Numer telefonu</th>
                        <th>Adres email</th>
                        <th>Akcja</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $employee as $emp}
                        <tr>
                            <td>{$emp["id"]}</td>
                            <td>{$emp["pesel"]}</td>
                            <td>{$emp["name"]}</td>
                            <td>{$emp["second_name"]}</td>
                            <td>{$emp["surname"]}</td>
                            <td>{$emp["profession"]}</td>
                            <td>{$emp["phone"]}</td>
                            <td>{$emp["email"]}</td>
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
                <button type="button" class="button btn-lg" onclick="location.href='{$conf->action_root}displayEmployeeRegistrationForm';">Dodaj pracownika</button>
            </div>
        </div>

    </div>
{/block}
