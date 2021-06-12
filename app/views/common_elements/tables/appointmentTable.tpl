{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/employeeModuleNav.tpl"}

    <div id="featured">

        <nav class="menu">
            <ul>
                <li>
                    <span class="filter opener">Filtrowanie</span>
                    <ul class="row">
                        <input class="col-2 inline" type="text" name="place" id="place" placeholder="Data wizyty">
                        <input class="col-2 inline" type="text" name="hours" id="hours" placeholder="Godzina wizyty">

                        <button class="button" id="entry_search_button">Filtruj</button>
                    </ul>
                </li>
        </nav>

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista wizyt</h4>
            </div>

            <div class="panel-body">
                <table class="table table-hover" align="center">
                    <thead>
                    <tr>
                        <th>Pesel pacjenta</th>
                        <th>Pesel lekarza</th>
                        <th>Data wizyty</th>
                        <th>Godzina wizyty</th>
                        <th>Cel</th>
                        <th>Akcja</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $appointments as $apt}
                        <tr>
                            <td>{$apt["pesel_employee"]}</td>
                            <td>{$apt["pesel_patient"]}</td>
                            <td>{$apt["date"]}</td>
                            <td>{$apt["time"]}</td>
                            <td>{$apt["purpose"]}</td>
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
                                        <li><a class="glyphicon glyphicon-pencil" aria-hidden="true" onclick="location.href='{$conf->action_url}editAppointment/{$apt['id']}';" >Edytuj</a></li>
                                        <li><a class="glyphicon glyphicon-trash" aria-hidden="true" onclick="location.href='{$conf->action_url}deleteAppointment/{$apt['id']}';">Usuń</a></li>
                                    </ul>
                                </div>
                            </td>

                        </tr>
                    {/foreach}
                </table>
            </div>

            <div class="panel-footer">
                <button type="button" class="button btn-lg" onclick="location.href='{$conf->action_root}generateAddAppointmentForm';">Dodaj wizytę</button>
                <span class="col-2">Wyników na stronie:</span>
                <select id='size_select' class="col-1">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
                <ul id="pagination_buttons" class="pagination col-4 align-right">
                    <li>
                        <button id="prev_btn" class="button disabled">Prev</button>
                    </li>
                    {for $start=1 to $pages_count}
                        <li>
                            <button class="page {if $start==1}active{/if}">{$start}</button>
                        </li>
                    {/for}
                    <li>
                        <button id="next_btn" class="button">Next</button>
                    </li>
                </ul>
                {if $action == "displayAllAppointments"}
                    <div class="col-2 col-12-medium margin-top-1">
                        <a class="button fit" href="{$conf->action_url}{$action}">Powrót</a>
                    </div>
                    <div class="col-10 col-0-medium"></div>
                {/if}
            </div>
            <span id="pages_count"></span>
            <span id="page_num">{$page}</span>
        </div>

    </div>
{/block}
