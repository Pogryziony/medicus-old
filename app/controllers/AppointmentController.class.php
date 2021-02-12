<?php

namespace app\controllers;

use app\forms\LoginForm;
use core\App;
use core\Message;
use core\RoleUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class AppointmentController {
    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }


}
