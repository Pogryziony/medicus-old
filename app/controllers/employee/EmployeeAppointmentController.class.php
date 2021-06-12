<?php

namespace app\controllers\employee;

use app\forms\appointment\AppointmentForm;
use app\forms\employee\EmployeeForm;
use app\forms\patient\PatientRegisterForm;
use core\App;
use core\ParamUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;

class EmployeeAppointmentController
{
    protected $appointmentForm;
    protected $employeeForm;
    protected $patientRegisterForm;

    public function __construct()
    {
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
                $employeeExists = App::getDB()->get(
                    "employee",
                    '*',
                    [
                        "pesel" => $this->employeeForm->pesel
                    ]
                );
                if ($employeeExists) {
                    App::getDB()->insert(
                        "appointment",
                        [
                            "pesel_patient" => $this->patientRegisterForm->pesel,
                            "pesel_employee" => $this->employeeForm->pesel,
                            "date" => $this->appointmentForm->date,
                            "time" => $this->appointmentForm->time,
                            "purpose" => $this->appointmentForm->purpose,
                        ]
                    );
                } else {
                    Utils::addErrorMessage('Pracownik o takim peselu nie istnieje');
                    $this->generateAddAppointmentForm();
                }
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
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
        $this->appointmentForm->date = ParamUtils::getFromRequest('date', true, 'Błędne wywołanie aplikacji');
        $this->appointmentForm->time = ParamUtils::getFromRequest('time', true, 'Błędne wywołanie aplikacji');
        $this->appointmentForm->purpose = ParamUtils::getFromRequest('purpose', true, 'Błędne wywołanie aplikacji');

        if (App::getMessages()->isError()) {
            return false;
        }

        $v = new Validator();

        $this->patientRegisterForm->pesel = $v->validate(
            $this->patientRegisterForm->pesel,
            [
                'trim' => true,
                'required' => true,
                'length' => 11,
                'validator_message' => 'Pesel musi mieć 11 znaków.',
            ]
        );

        $this->employeeForm->pesel = $v->validate(
            $this->employeeForm->pesel,
            [
                'trim' => true,
                'required' => true,
                'length' => 11,
                'validator_message' => 'Pesel musi mieć 11 znaków.',
            ]
        );

        $this->appointmentForm->purpose = $v->validate(
            $this->appointmentForm->purpose,
            [
                'trim' => true,
                'required' => true,
                'max_length' => 60,
                'validator_message' => 'Cel wizyty może mieć maksymalnie 60 znaków',
            ]
        );

        if (App::getMessages()->isError()) {
            return false;
        }

        return !App::getMessages()->isError();
    }

    private function generateAddAppointmentForm()
    {
        App::getSmarty()->assign('form', $this->appointmentForm); // dane formularza dla widoku
        App::getSmarty()->display("admin/registration/addAppointmentForm.tpl");
    }


    public function action_displayEmployeeAppointments()
    {
        $this->displayEmployeeAppointments();
    }

    private function displayEmployeeAppointments()
    {
        $employeeAppointments = array();
        $employeeData = SessionUtils::loadObject('employeeData', true);
        $this->employeeForm->pesel = $employeeData->pesel;
        try {
            $employeeAppointments = App::getDB()->select(
                "appointment",
                "*",
                [
                    "pesel_employee" => $this->employeeForm->pesel
                ]
            );
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        App::getSmarty()->assign('employeeAppointments', $employeeAppointments);
        App::getSmarty()->display("common_elements/tables/employeeAppointmentTable.tpl");
    }

    public function action_generateAddAppointmentForm()
    {
        $this->generateAddAppointmentForm();
    }


}