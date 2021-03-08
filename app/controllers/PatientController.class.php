<?php

namespace app\controllers;

use app\forms\patient\PatientLoginForm;
use core\App;
use core\RoleUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class PatientController {
    ###########
    # ZMIENNE #
    ###########
    private $patientLoginForm;

    public function __construct() {
        $this->patientLoginForm = new PatientLoginForm();
    }

    #############
    # LOGOWANIE #
    #############

    public function action_patientLogin() {
        $this->checkPatientCredentials();
    }

    private function checkPatientCredentials()
    {
        if (SessionUtils::load("patientSessionData", true) != null) {
            App::getRouter()->redirectTo("patientDashboard");
        }
        $this->patientLoginForm->pesel = ParamUtils::getFromRequest('pesel');
        $this->patientLoginForm->password = ParamUtils::getFromRequest('password');

        // if request method is post and validation is okay, login user
        if (($_SERVER["REQUEST_METHOD"] === "POST") && ($this->validatePatientLogin($this->patientLoginForm->pesel, $this->patientLoginForm->password))) {
            $this->loginPatient($this->patientLoginForm->pesel);
        }
        $this->generateLoginForm();
    }

    private function validatePatientLogin($email, $password)
    {
        $this->patientLoginForm->pesel = ParamUtils::getFromRequest('pesel');
        $this->patientLoginForm->password = ParamUtils::getFromRequest('password');

        if (!isset($this->patientLoginForm->pesel))
            return false;
        if (empty($this->patientLoginForm->pesel)) {
            Utils::addErrorMessage('Nie podano peselu.');
        }
        if (empty($this->patientLoginForm->password)) {
            Utils::addErrorMessage('Nie podano hasła.');
        }
        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->patientLoginForm->pesel = $v->validate($this->patientLoginForm->pesel, [
            'trim' => true,
            'required' => true
        ]);

        try {
            $patientRow = App::getDB()->get("patient", [
                "password",
                "active"
            ], [
                "pesel" => $this->patientLoginForm->pesel
            ]);
            if (!isset($patientRow)) {
                Utils::addErrorMessage('Nieprawidłowy login lub hasło.');
                return false;
            } else {
                if ($this->patientLoginForm->password != $patientRow["password"]) {
                    Utils::addErrorMessage('Nieprawidłowy login lub hasło.');
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

    private function loginPatient($pesel)
    {
        $patientData = array();
        try {
            $patientData = App::getDB()->get("patient", [
                "password",
                "active",
            ], [
                "pesel" => $pesel
            ]);
            $patientData = $patientData[0];
        } catch (\PDOException $e) {
            App::getMessages()->addMessage("Wystąpił błąd podczas logowania użytkownika. Spróbuj ponownie, lub skontaktuj się z administratorem systemu");
        }
        SessionUtils::store("patientId", $patientData["id"]);
        $patientSessionData = new \stdClass();
        $patientSessionData->name = $patientData["name"];
        $patientSessionData->secondName = $patientData["second_name"];
        SessionUtils::store("patientSessionData", $patientSessionData);
        App::getRouter()->redirectTo("patientDashboard");
    }

    public function action_patientLogout()
    {
        session_destroy();
        Utils::addInfoMessage('Zostałeś wylogowany.');
        App::getRouter()->forwardTo("showPatientLoginForm");
    }

    ##########
    # WIZYTY #
    ##########
    private function generateAppointmentTable(){
        try {
            $this->appointments = App::getDB()->select('appointment', '*');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        App::getSmarty()->assign('appointment', $this->appointments);
        App::getSmarty()->display("common_elements/tables/appointmentTable.tpl");
    }

    public function action_displayAppointmentTable()
    {
        $this->generateAppointmentTable();
    }

    ##########
    # WIDOKI #
    ##########
    public function action_showPatientLoginForm()
    {
        $this->generateLoginForm();
    }

    public function generateLoginForm()
    {
        App::getSmarty()->assign('loginForm', $this->patientLoginForm); // dane formularza do widoku
        App::getSmarty()->display('login/patientLoginForm.tpl');
    }

    public function action_patientDashboard()
    {
        App::getSmarty()->display("mainPatientPage.tpl");
    }


}
