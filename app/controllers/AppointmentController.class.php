<?php

namespace app\controllers;

use app\forms\appointment\AppointmentForm;
use app\forms\employee\EmployeeForm;
use app\forms\patient\PatientRegisterForm;
use core\App;
use core\ParamUtils;
use core\Utils;
use core\Validator;

class AppointmentController {
    private $appointmentForm;
    private $employeeForm;
    private $patientRegisterForm;

    public function __construct() {
        $this->appointmentForm = new AppointmentForm();
        $this->employeeForm = new EmployeeForm();
        $this->patientRegisterForm = new PatientRegisterForm();
    }

    public function action_registerAppointment()
    {
        $this->registerAppointment();
    }

    private function registerAppointment()
    {
        if ($this->validateAppointmentRegistration()) {
            try {
                $patientExists = App::getDB()->get("patient", '*', [
                    "pesel" => $this->patientRegisterForm->pesel
                ]);

                $employeeExists = App::getDB()->get("employee", '*', [
                    "pesel" => $this->employeeForm->pesel
                ]);

                if (!$patientExists&&!$employeeExists) {
                    App::getDB()->insert("appointment", [
                        "pesel_patient" => $this->patientRegisterForm->pesel,
                        "pesel_employee" => $this->employeeForm->pesel,
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
            App::getRouter()->redirectTo('displayAllAppointments');
        } else {
            $this->generateAddAppointmentForm();
        }
    }

    private function validateAppointmentRegistration()
    {
        $this->patientRegisterForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacji');
        $this->appointmentForm->date = ParamUtils::getFromRequest('date',  true, 'Błędne wywołanie aplikacji');
        $this->appointmentForm->time = ParamUtils::getFromRequest('time', true, 'Błędne wywołanie aplikacji');
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

        $this->employeeForm->pesel = $v->validate($this->employeeForm->pesel, [
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

    public function action_generateAddAppointmentForm() {
        $this->generateAddAppointmentForm();
    }

    private function generateAddAppointmentForm() {
        App::getSmarty()->assign('form', $this->appointmentForm); // dane formularza dla widoku
        App::getSmarty()->display("admin/registration/addAppointmentForm.tpl");
    }
}
