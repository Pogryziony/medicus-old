<?php

namespace app\controllers;

use app\forms\DoctorLoginForm;
use app\forms\LoginForm;
use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class DoctorLoginController {
    private $form;

    public function __construct() {
        $this->form = new DoctorLoginForm();
    }
    public function validate()
    {
        $this->form->email = ParamUtils::getFromRequest('email');
        $this->form->password = ParamUtils::getFromRequest('password');

        if (!isset($this->form->email))
            return false;
        if (empty($this->form->email)) {
            Utils::addErrorMessage('Nie podano emaila.');
        }
        if (empty($this->form->password)) {
            Utils::addErrorMessage('Nie podano hasła.');
        }
        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->form->email = $v->validate($this->form->email, [
            'trim' => true,
            'required' => true
        ]);

        try {
            $doctorRow = App::getDB()->get("doctor", [
                "password",
                "active"
            ], [
                "email" => $this->form->email
            ]);
            if (!isset($doctorRow)) {
                Utils::addErrorMessage('Nieprawidłowy login lub hasło.');
                return false;
            } else {
                if ($this->form->password != $doctorRow["password"]) {
                    Utils::addErrorMessage('Nieprawidłowy login lub hasło.');
                    return false;
                }

                if (1 != intval($doctorRow["active"])) {
                    Utils::addErrorMessage('Konto użytkownika nie jest aktywne.');
                    return false;
                }
            }
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas logowania.');
            if (App::getConf()->debug)
            App::getMessages()->addMessage($e->getMessage());
        }

        return !App::getMessages()->isError();
}

    public function action_doctorLogin() {
        if ($this->validate()) {
            //zalogowany => przekieruj na główną akcję (z przekazaniem messages przez sesję)
            App::getMessages()->addMessage(new Message('Poprawnie zalogowano do systemu', Message::INFO));
            $row = App::getDB()->get('doctor', ['id'],[
                "email" => $this->form->email]);
            SessionUtils::store('doctorId', $row['id']);
            App::getRouter()->redirectTo("doctorDashboard");
        } else {
            //niezalogowany => pozostań na stronie logowania
            $this->generateView();
        }
    }
    public function action_doctorLogout() {
        session_destroy();
        Utils::addInfoMessage('Zostałeś wylogowany.');
        App::getRouter()->forwardTo("showDoctorLoginForm");
    }

    public function action_showDoctorLoginForm() {
        $this->generateView();
    }
    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // dane formularza do widoku
        App::getSmarty()->display('login/doctorLoginForm.tpl');
    }
}
