{extends file="common.tpl"}
{block name="content"}
    {include file="common_elements/navigation/patientModuleNav.tpl"}

    <div id="featured">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h4>Lista wizyt</h4>
            </div>

            <div class="panel-body">
                <table class="table table-hover" align="center">
                    <thead>
                    <tr>
                        <th>Data wizyty</th>
                        <th>Godzina wizyty</th>
                        <th>Cel</th>
                    </tr>
                    </thead>
                    <tbody>
                    {foreach $patientAppointments as $papt}
                        <tr>
                            <td>{$papt["date"]}</td>
                            <td>{$papt["time"]}</td>
                            <td>{$papt["purpose"]}</td>
                        </tr>
                    {/foreach}
                </table>
            </div>
        </div>

    </div>
{/block}
