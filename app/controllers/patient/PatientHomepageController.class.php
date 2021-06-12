<?php

namespace app\controllers\patient;

use core\App;

class PatientHomepageController
{
    public function action_patientDashboard()
    {
        App::getSmarty()->display("patientHomepage.tpl");
    }
}