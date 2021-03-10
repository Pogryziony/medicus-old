<?php

namespace app\controllers;

use app\forms\appointment\AppointmentForm;
use app\forms\employee\EmployeeRegisterForm;
use app\forms\patient\PatientRegisterForm;
use core\App;
use core\ParamUtils;
use core\Utils;
use core\Validator;

class AppointmentController {
    private $appointmentForm;
    private $employeeRegisterForm;
    private $patientRegisterForm;

    public function __construct() {
        $this->appointmentForm = new AppointmentForm();
        $this->employeeRegisterForm = new EmployeeRegisterForm();
        $this->patientRegisterForm = new PatientRegisterForm();
    }

    public function action_displayAllAppointments() {
       $this->displayAllAppointments();
    }

    private function displayAllAppointments()
    {
        try {
            $this->appointments = App::getDB()->select('appointment', '*');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        App::getSmarty()->assign('appointments', $this->appointments);
        App::getSmarty()->display("common_elements/tables/appointmentTable.tpl");
    }

    public function action_displaySelfEmployeeAppointments()
    {
        $this->displaySelfEmployeeAppointments();
    }

    private function displaySelfEmployeeAppointments(){
        try {
            $this->appointments = App::getDB()->select("appointment", '*', [
                        "pesel_employee" => $this->appointmentForm->employeePesel,
            ]);
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        App::getSmarty()->assign('appointments', $this->appointments);
        App::getSmarty()->display("common_elements/tables/appointmentTable.tpl");
    }

    public function action_registerNewAppointment()
    {
        $this->registerNewAppointment();
    }

    private function registerNewAppointment()
    {
        if ($this->validatePatientRegistration()) {
            try {
                $patientExists = App::getDB()->get("patient", '*', [
                    "pesel" => $this->patientRegisterForm->pesel
                ]);
                $employeeExists = App::getDB()->get("employee", '*', [
                    "pesel" => $this->employeeRegisterForm->pesel
                ]);
                if (!$patientExists || !$employeeExists) {
                    App::getDB()->insert("appointment", [
                        "pesel_patient" => $this->patientRegisterForm->pesel,
                        "pesel_employee" => $this->employeeRegisterForm->pesel,
                        "date" => $this->appointmentForm->date,
                        "time" => $this->appointmentForm->time,
                        "purpose" => $this->appointmentForm->purpose,
                    ]);
                } else {
                    Utils::addErrorMessage('Email lub nazwa użytkownika już istnieje..');
                    $this->generateAddAppointmentForm();
                }
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Rejestracja zakończona pomyślnie');
            App::getRouter()->forwardTo('displayEmployeeTable');
        } else {
            $this->generateAddAppointmentForm();
        }
    }

    public function action_editAppointment()
    {
        $this->editAppointment();
    }

    private function editAppointment()
    {
        if ($this->validatePatientRegistration()) {
            try {
                $patientExists = App::getDB()->get("patient", '*', [
                    "pesel" => $this->patientRegisterForm->pesel
                ]);
                $employeeExists = App::getDB()->get("employee", '*', [
                    "pesel" => $this->employeeRegisterForm->pesel
                ]);
                    App::getDB()->update("appointment", [
                        "pesel_patient" => $this->patientRegisterForm->pesel,
                        "pesel_employee" => $this->employeeRegisterForm->pesel,
                        "date" => $this->appointmentForm->date,
                        "time" => $this->appointmentForm->time,
                        "purpose" => $this->appointmentForm->purpose,
                    ]);
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Rejestracja zakończona pomyślnie');
            App::getRouter()->forwardTo('displayEmployeeTable');
        } else {
            $this->generateAddAppointmentForm();
        }
    }

    private function validatePatientRegistration()
    {
        $this->patientRegisterForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacjipesel1');
        $this->employeeRegisterForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacjipesel2');
        $this->appointmentForm->date = ParamUtils::getFromRequest('date',  true, 'Błędne wywołanie aplikacjiasd');
        $this->appointmentForm->time = ParamUtils::getFromRequest('time', true, 'Błędne wywołanie aplikacjiasdsad');
        $this->appointmentForm->purpose = ParamUtils::getFromRequest('purpose', true, 'Błędne wywołanie aplikacji');

        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->patientRegisterForm->pesel = $v->validate($this->patientRegisterForm->pesel, [
            'trim' => true,
            'required' => true,
            'length' => 11,
            'validator_message' => 'Pesel musi mieć 11 znaków.',
        ]);

        $this->employeeRegisterForm->pesel = $v->validate($this->employeeRegisterForm->pesel, [
            'trim' => true,
            'required' => true,
            'length' => 11,
            'validator_message' => 'Pesel musi mieć 11 znaków.',
        ]);

        $this->appointmentForm->date = $v->validate($this->appointmentForm->date, [
            "trim"=>"true",
            "min_length"=>10,
            "max_length"=>10,
            "date_format"=>"Y-m-d",
            "validator_message"=>'Niepoprawny format "Data do" (wymagany: YYYY-mm-dd)'
        ]);

        $this->appointmentForm->time = $v->validate($this->appointmentForm->time, [
            "date_format"=>"H:i",
            "validator_message"=>'Niepoprawny format "Godzina od" (wymagany: HH:MM)'
        ]);

        $this->appointmentForm->purpose = $v->validate($this->appointmentForm->purpose, [
            'trim' => true,
            'required' => true,
            'max_length' => 60,
            'validator_message' => 'Cel wizyty może mieć maksymalnie 60 znaków',
        ]);

        if (App::getMessages()->isError())
            return false;

        return !App::getMessages()->isError();
    }

    public function action_displayAppointmentTable()
    {
        $this->generateAppointmentTable();
    }

    private function renderChooseEntryMonth() {
        App::getSmarty()->assign("description", "Wybierz miesiąc");
        App::getSmarty()->display("common_elements/chooseDate.tpl");
    }

    public function action_generateAddAppointmentForm() {
        $this->generateAddAppointmentForm();
    }

    private function generateAddAppointmentForm() {
        App::getSmarty()->assign('form', $this->appointmentForm); // dane formularza dla widoku
        App::getSmarty()->display("admin/registration/addAppointmentForm.tpl");
    }

    private function generateEditAppointmentForm() {
        App::getSmarty()->assign('form', $this->appointmentForm); // dane formularza dla widoku
        App::getSmarty()->display("admin/registration/addAppointmentForm.tpl");
    }

    private function showEditAppointmentForm($id) {
        App::getSmarty()->assign("description", "Edytuj wizytę");
        App::getSmarty()->assign("appointment", $this->getAppointments($id));
        App::getSmarty()->display("editEntryForm.tpl");
    }


}

