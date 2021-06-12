<?php

namespace app\controllers\admin;

use app\forms\appointment\AppointmentForm;
use app\forms\employee\EmployeeForm;
use app\forms\patient\PatientRegisterForm;
use core\App;
use core\ParamUtils;
use core\Utils;
use core\Validator;
use PDOException;

class AdminAppointmentController
{
    private $patientRegisterForm;

    private $employeeForm;

    private $appointmentForm;

    public function __construct()
    {
        $this->patientRegisterForm = new PatientRegisterForm();
        $this->employeeForm = new EmployeeForm();
        $this->appointmentForm = new AppointmentForm();
    }

    public function action_editAppointment()
    {
        if ($this->validateAppointmentEdit()) {
            $this->generateAppointmentEditForm();
        } else {
            App::getRouter()->forwardTo('displayAllAppointments');
        }
    }

    public function validateAppointmentEdit()
    {
        $this->appointmentForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try {
            $record = App::getDB()->get(
                "appointment",
                "*",
                [
                    "id" => $this->appointmentForm->id
                ]
            );
            $this->appointmentForm->employeePesel = $record['pesel_employee'];
            $this->appointmentForm->patientPesel = $record['pesel_patient'];
            $this->appointmentForm->date = $record['date'];
            $this->appointmentForm->time = $record['time'];
            $this->appointmentForm->purpose = $record['purpose'];
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd aplikacji.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        return !App::getMessages()->isError();
    }

    private function generateAppointmentEditForm()
    {
        App::getSmarty()->assign('form', $this->appointmentForm); // dane formularza dla widoku
        App::getSmarty()->display('admin/edit/editAppointmentForm.tpl');
    }

    public function action_saveAppointment()
    {
        if ($this->validateAppointmentSave()) {
            try {
                App::getDB()->update(
                    "appointment",
                    [
                        "pesel_employee" => $this->appointmentForm->employeePesel,
                        "pesel_patient" => $this->appointmentForm->patientPesel,
                        "date" => $this->appointmentForm->date,
                        "time" => $this->appointmentForm->time,
                        "purpose" => $this->appointmentForm->purpose,
                    ],
                    [
                        "id" => $this->appointmentForm->id
                    ]
                );
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            Utils::addInfoMessage('Zapisano zmiany pacjenta.');
            App::getRouter()->redirectTo('displayAllAppointments');
        } else {
            $this->generateAppointmentEditForm();
        }
    }

    public function validateAppointmentSave()
    {
        $this->appointmentForm->employeePesel = ParamUtils::getFromRequest(
            'pesel_employee',
            true,
            'Błędny pesel pracownika'
        );
        $this->appointmentForm->patientPesel = ParamUtils::getFromRequest(
            'pesel_patient',
            true,
            'Błędny pesel pacjenta'
        );
        $this->appointmentForm->date = ParamUtils::getFromRequest('date', true, 'Błędna data');
        $this->appointmentForm->time = ParamUtils::getFromRequest('time', false, 'Błędny czas');
        $this->appointmentForm->purpose = ParamUtils::getFromRequest('purpose', true, 'Błędny cel wizyty');

        if (App::getMessages()->isError()) {
            return false;
        }

        $v = new Validator();

        $this->appointmentForm->employeePesel = $v->validate(
            $this->appointmentForm->employeePesel,
            [
                'trim' => true,
                'required' => true,
                'length' => 11,
                'validator_message' => 'Pesel musi mieć 11 znaków.',
            ]
        );

        $this->appointmentForm->patientPesel = $v->validate(
            $this->appointmentForm->patientPesel,
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
                'max_length' => 80,
                'validator_message' => 'Cel wizyty może mieć maksymalnie 80 znaków.',
            ]
        );


        if (App::getMessages()->isError()) {
            return false;
        }

        return !App::getMessages()->isError();
    }

    public function action_deleteAppointment()
    {
        if ($this->validateAppointmentDelete()) {
            try {
                App::getDB()->delete(
                    "appointment",
                    [
                        "id" => $this->appointmentForm->id
                    ]
                );
                Utils::addInfoMessage('Usunięto wizytę.');
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas kasowania rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            App::getRouter()->redirectTo('displayAllAppointments');
        } else {
            App::getRouter()->redirectTo('displayAllAppointments');
        }
    }

    public function validateAppointmentDelete()
    {
        $this->appointmentForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try {
            $record = App::getDB()->get(
                "appointment",
                "*",
                [
                    "id" => $this->appointmentForm->id
                ]
            );
            if (!$record) {
                Utils::addErrorMessage('Wizyta nie istnieje.');
                return false;
            }
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił nieoczekiwany błąd przy próbie usunięcia rekordu.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }

        return !App::getMessages()->isError();
    }

    public function action_displayAllAppointments()
    {
        $this->displayAllAppointments();
    }

    private function displayAllAppointments()
    {
        try {
            $this->appointments = App::getDB()->select('appointment', '*');
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        App::getSmarty()->assign("pages_count", $this->getEntriesCount());
        App::getSmarty()->assign("page", 1);
        App::getSmarty()->assign("size", 10);
        App::getSmarty()->assign("appointments", $this->getEntries());
        App::getSmarty()->display("common_elements/tables/appointmentTable.tpl");
    }

    private function getEntriesCount($size = 10, $page = 1)
    {
        $limitDown = $size * ($page - 1);
        $limitUp = $size * $page;
        $entries = App::getDB()->count(
            "appointment",
            "*",
            [
                "LIMIT" => [$limitDown, $limitUp]
            ]
        );
        $pages = ceil($entries / $size);
        return $pages;
    }

    public function getEntries($size = 10, $page = 1)
    {
        $limitDown = $size * ($page - 1);
        $limitUp = $size * $page;
        return App::getDB()->select(
            "appointment",
            "*",
            [
                "LIMIT" => [$limitDown, $limitUp]
            ]
        );
    }

    public function action_getEntriesAjaxPage()
    {
        $size = ParamUtils::getFromGet("size");
        $page = ParamUtils::getFromGet("page");

        $this->renderAjaxEntriesPage($size, $page);
    }

    public function renderAjaxEntriesPage($size, $page)
    {
        App::getSmarty()->assign("appointments", $this->getFilteredEntries($size, $page));
        App::getSmarty()->display("common_elements/tables/appointmentTable.tpl");
    }

    public function getFilteredEntries($size = 10, $page = 1)
    {
        $where = [
            "id" => $this->appointmentForm->id
        ];
        $sizeFrom = 0;
        $sizeTo = $size;
        if ($page > 1) {
            $sizeFrom = ($page - 1) * $size;
            $sizeTo = $page * $size;
        }

        $count = App::getDB()->count("appointment", "*", $where);
        $where["LIMIT"] = [$sizeFrom, $sizeTo];
        $pages = ceil($count / $size);

        App::getSmarty()->assign("page", $page);
        App::getSmarty()->assign("pages", $pages);
        return App::getDB()->select("appointment", "*", $where);
    }
}