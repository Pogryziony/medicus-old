<?php

namespace app\controllers\employee;

use core\App;

class EmployeeHomepageController
{
    public function action_employeeDashboard()
    {
        App::getRouter()->redirectTo('displayEmployeeAppointments');
    }
}