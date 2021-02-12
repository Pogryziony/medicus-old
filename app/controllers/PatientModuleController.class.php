<?php

namespace app\controllers;

use app\forms\PatientLoginForm;
use core\App;

class PatientModuleController {
    private $form;

    public function __construct() {
        $this->form = new PatientLoginForm();
    }

    public function action_patientDashboard()
    {
        App::getSmarty()->display("modules/patient_module/patientDashboard.tpl");
    }
}
