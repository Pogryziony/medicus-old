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
                    "pesel" => $this->employeeForm->pesel
                ]);
                if (!$patientExists || !$employeeExists) {
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
                    "pesel" => $this->employeeForm->pesel
                ]);
                    App::getDB()->update("appointment", [
                        "pesel_patient" => $this->patientRegisterForm->pesel,
                        "pesel_employee" => $this->employeeForm->pesel,
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
        $this->employeeForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacjipesel2');
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
################################################################
    public function action_registerEmployee()
    {
        $this->registerEmployee();
    }

    private function registerEmployee()
    {
        if ($this->validateEmployeeRegistration()) {
            try {
                $emailExists = App::getDB()->get("employee", '*', [
                    "email" => $this->employeeForm->email
                ]);
                if (!$emailExists) {
                    App::getDB()->insert("employee", [
                        "pesel" => $this->employeeForm->pesel,
                        "name" => $this->employeeForm->name,
                        "second_name" => $this->employeeForm->secondName,
                        "surname" => $this->employeeForm->surname,
                        "profession" => $this->employeeForm->profession,
                        "phone" => $this->employeeForm->phone,
                        "email" => $this->employeeForm->email,
                        "password" => $this->employeeForm->password,
                        "role" => $this->employeeForm->role,
                        "active" => $this->employeeForm->isActive,
                    ]);
                    $employeeRow = App::getDB()->get("employee", [
                        "pesel" => $this->employeeForm->pesel
                    ]);
                    $this->employeeForm->id = $employeeRow['id'];
                    App::getDB()->insert("employee", [
                        "id" => $this->employeeForm->id
                    ]);
                } else {
                    Utils::addErrorMessage('Email lub nazwa użytkownika już istnieje..');
                    $this->generateEmployeeRegistrationView();
                }
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Rejestracja zakończona pomyślnie');
            App::getRouter()->forwardTo('displayEmployeeTable');
        } else {
            $this->generateEmployeeRegistrationView();
        }
    }

    private function validateEmployeeRegistration()
    {
        $this->employeeForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->name = ParamUtils::getFromRequest('name', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->secondName = ParamUtils::getFromRequest('second_name',  false, 'Błędne wywołanie aplikacji');
        $this->employeeForm->surname = ParamUtils::getFromRequest('surname', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->profession = ParamUtils::getFromRequest('profession', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->phone = ParamUtils::getFromRequest('phone', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->email = ParamUtils::getFromRequest('email', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->password = ParamUtils::getFromRequest('password', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->role = (ParamUtils::getFromPost("role") === "admin") ? "admin" : "user";
        $this->employeeForm->isActive = ParamUtils::getFromRequest('active', true, 'Błędne wywołanie aplikacji') == "true";

        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->employeeForm->pesel = $v->validate($this->employeeForm->pesel, [
            'trim' => true,
            'required' => true,
            'length' => 11,
            'validator_message' => 'Pesel musi mieć 11 znaków.',
        ]);

        $this->employeeForm->name = $v->validate($this->employeeForm->name, [
            'trim' => true,
            'required' => true,
            'min_length' => 2,
            'max_length' => 30,
            'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
        ]);

        $this->employeeForm->surname = $v->validate($this->employeeForm->surname, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->employeeForm->phone = $v->validate($this->employeeForm->phone, [
            'trim' => true,
            'required' => true,
            'regexp' => "/^[0-9]{9}$/",
            'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
        ]);

        $this->employeeForm->email = $v->validate($this->employeeForm->email, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->employeeForm->password = $v->validate($this->employeeForm->password, [
            'trim' => true,
            'required' => true,
            'validator_message' => 'Podano nieprawidłowe hasło',
        ]);

        if (App::getMessages()->isError())
            return false;

        return !App::getMessages()->isError();
    }

    public function action_editEmployee()
    {
        if ($this->validateEmployeeEdit()) {
            $this->generateEmployeeEditForm();
        } else {
            App::getRouter()->forwardTo('displayEmployeeTable');
        }
    }

    private function editEmployee()
    {
        if ($this->validateEmployeeEdit()) {
            try {
                $emailExists = App::getDB()->get("employee", '*', [
                    "email" => $this->employeeForm->email
                ]);
                if (!$emailExists) {
                    App::getDB()->insert("employee", [
                        "pesel" => $this->employeeForm->pesel,
                        "name" => $this->employeeForm->name,
                        "second_name" => $this->employeeForm->secondName,
                        "surname" => $this->employeeForm->surname,
                        "profession" => $this->employeeForm->profession,
                        "phone" => $this->employeeForm->phone,
                        "email" => $this->employeeForm->email,
                        "password" => $this->employeeForm->password,
                        "role" => $this->employeeForm->role,
                        "active" => $this->employeeForm->isActive,
                    ]);
                    $employeeRow = App::getDB()->get("employee", [
                        "pesel" => $this->employeeForm->pesel
                    ]);
                    $this->employeeForm->id = $employeeRow['id'];
                    App::getDB()->insert("employee", [
                        "id" => $this->employeeForm->id
                    ]);
                } else {
                    Utils::addErrorMessage('Email lub nazwa użytkownika już istnieje..');
                    $this->generateEmployeeRegistrationView();
                }
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Rejestracja zakończona pomyślnie');
            App::getRouter()->forwardTo('displayEmployeeTable');
        } else {
            $this->generateEmployeeRegistrationView();
        }
    }

    public function validateEmployeeEdit() {
        $this->employeeForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try {
            $record = App::getDB()->get("employee", "*", [
                "id" => $this->employeeForm->id
            ]);
            $this->employeeForm->pesel = $record['pesel'];
            $this->employeeForm->name = $record['name'];
            $this->employeeForm->secondName = $record['second_name'];
            $this->employeeForm->surname = $record['surname'];
            $this->employeeForm->profession = $record['profession'];
            $this->employeeForm->phone = $record['phone'];
            $this->employeeForm->email = $record['email'];
            $this->employeeForm->password = $record['password'];
            $this->employeeForm->role = $record['role'];
            $this->employeeForm->isActive = $record['active'];
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd aplikacji.');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        return !App::getMessages()->isError();
    }

    public function validateEmployeeSave() {
        $this->employeeForm->id = ParamUtils::getFromRequest('id', true, 'Błędne ID');
        $this->employeeForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędny pesel');
        $this->employeeForm->name = ParamUtils::getFromRequest('name', true, 'Błędne imie');
        $this->employeeForm->secondName = ParamUtils::getFromRequest('second_name', false, 'Błędne drugie imie');
        $this->employeeForm->surname = ParamUtils::getFromRequest('surname', true, 'Błędne nazwisko');
        $this->employeeForm->profession = ParamUtils::getFromRequest('profession', false, 'Błędny zawód');
        $this->employeeForm->phone = ParamUtils::getFromRequest('phone', true, 'Błędny nr telefonu');
        $this->employeeForm->email = ParamUtils::getFromRequest('email', true, 'Błędny email');
        $this->employeeForm->password = ParamUtils::getFromRequest('password', true, 'Błędne hasło');
        $this->employeeForm->role = ParamUtils::getFromRequest('role', true, 'Błędna rola');
        $this->employeeForm->isActive = ParamUtils::getFromRequest('active', true, 'Błędna aktywność') == "true";

        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->employeeForm->id = $v->validate($this->employeeForm->id, [
            'trim' => true,
            'required' => true,
            'int' => true,
            'required_message' => 'Wystąpił błąd aplikacji',
            'validator_message' => 'Wystąpił błąd aplikacji.',
        ]);

        $this->employeeForm->name = $v->validate($this->employeeForm->name, [
            'trim' => true,
            'required' => true,
            'min_length' => 2,
            'max_length' => 30,
            'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
        ]);

        $this->employeeForm->surname = $v->validate($this->employeeForm->surname, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->employeeForm->phone = $v->validate($this->employeeForm->phone, [
            'trim' => true,
            'required' => true,
            'regexp' => "/^[0-9]{9}$/",
            'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
        ]);

        $this->employeeForm->email = $v->validate($this->employeeForm->email, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->employeeForm->password = $v->validate($this->employeeForm->password, [
            'trim' => true,
            'required' => true,
            'validator_message' => 'Podano nieprawidłowe hasło',
        ]);

        if (App::getMessages()->isError())
            return false;

        return !App::getMessages()->isError();
    }

    public function action_saveEmployee() {
        if($this->validateEmployeeSave()) {
            try{
                App::getDB()->update("employee", [
                    "pesel" => $this->employeeForm->pesel,
                    "name" => $this->employeeForm->name,
                    "second_name" => $this->employeeForm->secondName,
                    "surname" => $this->employeeForm->surname,
                    "profession" => $this->employeeForm->profession,
                    "phone" => $this->employeeForm->phone,
                    "email" => $this->employeeForm->email,
                    "password" => $this->employeeForm->password,
                    "role" => $this->employeeForm->role,
                    "active" => $this->employeeForm->isActive,
                ], [
                    "id" => $this->employeeForm->id
                ]);
            } catch(\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Zapisano zmiany w rachunku.');
            App::getRouter()->forwardTo('displayEmployeeTable');
        }else {
            $this->generateEmployeeEditForm();
        }
    }

    public function validateEmployeeDelete() {
        $this->employeeForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try{
            $record = App::getDB()->get("employee", "*", [
                "id" => $this->employeeForm->id
            ]);
            if(!$record){
                Utils::addErrorMessage('Pracownik nie istnieje.');
                return false;
            }
        }catch(\PDOException $e) {
            Utils::addErrorMessage('Wystąpił nieoczekiwany błąd przy próbie usunięcia rekordu.');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }

        return !App::getMessages()->isError();
    }

    public function action_deleteEmployee() {
        if($this->validateEmployeeDelete()){
            try{
                App::getDB()->delete("employee", [
                    "id" => $this->employeeForm->id
                ]);
                Utils::addInfoMessage('Usunięto pracownika.');
            }catch(\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas kasowania rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            App::getRouter()->forwardTo('displayEmployeeTable');
        }else{
            App::getRouter()->forwardTo('displayEmployeeTable');
        }
    }













###############################################################
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

