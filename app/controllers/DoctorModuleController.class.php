<?php

namespace app\controllers;

use core\App;


class DoctorModuleController {
    public function action_doctorDashboard()
    {
        App::getSmarty()->display("modules/doctor_module/doctorDashboard.tpl");
    }
}
