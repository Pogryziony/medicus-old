<?php

namespace app\controllers;

use app\forms\patient\PatientRegisterForm;
use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class PatientController {
    private $patientRegisterForm;

    public function __construct()
    {
        $this->patientRegisterForm = new PatientRegisterForm();
    }


    public function validatePatientLogin(): bool
    {
        $this->patientRegisterForm->pesel = ParamUtils::getFromRequest('pesel');
        $this->patientRegisterForm->password = ParamUtils::getFromRequest('password');

        if (!isset($this->patientRegisterForm->pesel))
            return false;
        if (empty($this->patientRegisterForm->pesel)){
            Utils::addErrorMessage('Nie podano peselu.');
        }
        if (empty($this->patientRegisterForm->password)) {
            Utils::addErrorMessage('Nie podano hasła.');
        }

        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->patientRegisterForm->pesel = $v->validate($this->patientRegisterForm->pesel, [
            'trim' => true,
            'required' => true
        ]);

        try{
            $patientRow = App::getDB()->get("patient", [
                "password",
                "active"
            ], [
                "pesel" => $this->patientRegisterForm->pesel
            ]);

            if(!isset($patientRow)){
                Utils::addErrorMessage('Nieprawidłowy pesel lub hasło.');
                return false;
            }else {
                if ($this->patientRegisterForm->password != $patientRow["password"]) {
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

    public function action_showLogin() {
        $this->generatePatientLoginView();
    }

    public function action_patientLogin() {
        if ($this->validatePatientLogin()) {
            //zalogowany => przekieruj na główną akcję (z przekazaniem messages przez sesję)
            App::getMessages()->addMessage(new Message('Poprawnie zalogowano do systemu', Message::INFO));
            $row = App::getDB()->get('patient', ['id','pesel'],[
                "pesel" => $this->patientRegisterForm->pesel]);
            SessionUtils::store('pat_id', $row['id']);
            SessionUtils::store('pat_pesel', $row['pesel']);
            App::getRouter()->redirectTo("patientDashboard");
        } else {
            //niezalogowany => pozostań na stronie logowania
            $this->generatePatientLoginView();
        }
    }

    public function generatePatientLoginView() {
        App::getSmarty()->assign('form', $this->patientRegisterForm); // dane formularza do widoku
        App::getSmarty()->display('login/patientLoginForm.tpl');
    }


    public function generateView() {
        App::getSmarty()->assign('patientRegisterForm', $this->patientRegisterForm); // dane formularza do widoku
        App::getSmarty()->display('login/patientLoginForm.tpl');
    }

    public function action_patientLogout()
    {
        session_destroy();
        Utils::addInfoMessage('Zostałeś wylogowany.');
        App::getRouter()->forwardTo("showPatientLoginForm");
    }

    public function action_showPatientLoginForm()
    {
        $this->generatePatientLoginForm();
    }

    public function generatePatientLoginForm()
    {
        App::getSmarty()->assign('loginForm', $this->patientRegisterForm); // dane formularza do widoku
        App::getSmarty()->display('login/patientLoginForm.tpl');
    }

    public function action_patientDashboard()
    {
        App::getSmarty()->display("mainPatientPage.tpl");
    }
}
