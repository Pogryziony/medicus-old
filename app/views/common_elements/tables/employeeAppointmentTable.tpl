{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/employeeModuleNav.tpl"}

    <div id="featured">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista wizyt</h4>
            </div>

            <div class="panel-body">
                <table class="table table-hover" align="center">
                    <thead>
                    <tr>
                        <th>Pesel pacjenta</th>
                        <th>Data wizyty</th>
                        <th>Godzina wizyty</th>
                        <th>Cel</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $employeeAppointments as $eapt}
                        <tr>
                            <td>{$eapt["pesel_patient"]}</td>
                            <td>{$eapt["date"]}</td>
                            <td>{$eapt["time"]}</td>
                            <td>{$eapt["purpose"]}</td>
                        </tr>
                    {/foreach}
                </table>
            </div>
        </div>
    </div>
{/block}
