<?php

namespace app\controllers;

use app\forms\PatientLoginForm;
use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class PatientLoginController {
    private $form;

    public function __construct() {
        $this->form = new PatientLoginForm();
    }
    public function validate()
    {
        $this->form->pesel = ParamUtils::getFromRequest('pesel');
        $this->form->password = ParamUtils::getFromRequest('password');

        if (!isset($this->form->pesel))
            return false;
        if (empty($this->form->pesel)) {
            Utils::addErrorMessage('Nie podano peselu.');
        }
        if (empty($this->form->password)) {
            Utils::addErrorMessage('Nie podano hasła.');
        }
        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->form->pesel = $v->validate($this->form->pesel, [
            'trim' => true,
            'required' => true
        ]);

        try {
            $patientRow = App::getDB()->get("patient", [
                "password",
                "active"
            ], [
                "pesel" => $this->form->pesel
            ]);
            if (!isset($patientRow)) {
                Utils::addErrorMessage('Nieprawidłowy pesel lub hasło.');
                return false;
            } else {
                if ($this->form->password != $patientRow["password"]) {
                    Utils::addErrorMessage('Nieprawidłowy pesel lub hasło.');
                    return false;
                }

                if (1 != intval($patientRow["active"])) {
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

    public function action_patientLogin() {
        if ($this->validate()) {
            //zalogowany => przekieruj na główną akcję (z przekazaniem messages przez sesję)
            App::getMessages()->addMessage(new Message('Poprawnie zalogowano do systemu', Message::INFO));
            $patientRow = App::getDB()->get('patient', ['id'],[
                "pesel" => $this->form->pesel]);
            SessionUtils::store('patientId', $patientRow['id']);
            App::getRouter()->redirectTo("patientDashboard");
        } else {
            //niezalogowany => pozostań na stronie logowania
            $this->generateView();
        }
    }

    public function action_showPatientLoginForm() {
        $this->generateView();
    }
    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // dane formularza do widoku
        App::getSmarty()->display('login/patientLoginForm.tpl');
    }
}
