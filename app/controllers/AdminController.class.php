<?php

namespace app\controllers;

use app\forms\employee\EmployeeRegisterForm;
use app\forms\patient\PatientRegisterForm;
use core\App;
use core\ParamUtils;
use core\RoleUtils;
use core\Utils;
use core\Validator;


class AdminController
{
    private $patientRegisterForm;

    private $employeeRegisterForm;

    public function __construct()
    {
        $this->employeeRegisterForm = new EmployeeRegisterForm();
        $this->patientRegisterForm = new PatientRegisterForm();

    }

    public function action_registerEmployee()
    {
        $this->registerEmployee();
    }

    private function registerEmployee()
    {
        if ($this->validateEmployeeRegistration()) {
            try {
                $emailExists = App::getDB()->get("employee", '*', [
                    "email" => $this->employeeRegisterForm->email
                ]);
                if (!$emailExists) {
                    App::getDB()->insert("employee", [
                        "pesel" => $this->employeeRegisterForm->pesel,
                        "name" => $this->employeeRegisterForm->name,
                        "second_name" => $this->employeeRegisterForm->secondName,
                        "surname" => $this->employeeRegisterForm->surname,
                        "profession" => $this->employeeRegisterForm->profession,
                        "phone" => $this->employeeRegisterForm->phone,
                        "email" => $this->employeeRegisterForm->email,
                        "password" => $this->employeeRegisterForm->password,
                        "role" => $this->employeeRegisterForm->role,
                        "active" => $this->employeeRegisterForm->isActive,
                    ]);
                    $employeeRow = App::getDB()->get("employee", [
                        "pesel" => $this->employeeRegisterForm->pesel
                    ]);
                    $this->employeeRegisterForm->id = $employeeRow['id'];
                    App::getDB()->insert("employee", [
                        "id" => $this->employeeRegisterForm->id
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
        $this->employeeRegisterForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacji');
        $this->employeeRegisterForm->name = ParamUtils::getFromRequest('name', true, 'Błędne wywołanie aplikacji');
        $this->employeeRegisterForm->secondName = ParamUtils::getFromRequest('second_name',  false, 'Błędne wywołanie aplikacji');
        $this->employeeRegisterForm->surname = ParamUtils::getFromRequest('surname', true, 'Błędne wywołanie aplikacji');
        $this->employeeRegisterForm->profession = ParamUtils::getFromRequest('profession', true, 'Błędne wywołanie aplikacji');
        $this->employeeRegisterForm->phone = ParamUtils::getFromRequest('phone', true, 'Błędne wywołanie aplikacji');
        $this->employeeRegisterForm->email = ParamUtils::getFromRequest('email', true, 'Błędne wywołanie aplikacji');
        $this->employeeRegisterForm->password = ParamUtils::getFromRequest('password', true, 'Błędne wywołanie aplikacji');
        $this->employeeRegisterForm->role = (ParamUtils::getFromPost("role") === "admin") ? "admin" : "user";
        $this->employeeRegisterForm->isActive = ParamUtils::getFromRequest('active', true, 'Błędne wywołanie aplikacji') == "true";

        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->employeeRegisterForm->pesel = $v->validate($this->employeeRegisterForm->pesel, [
            'trim' => true,
            'required' => true,
            'length' => 11,
            'validator_message' => 'Pesel musi mieć 11 znaków.',
        ]);

        $this->employeeRegisterForm->name = $v->validate($this->employeeRegisterForm->name, [
            'trim' => true,
            'required' => true,
            'min_length' => 2,
            'max_length' => 30,
            'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
        ]);

        $this->employeeRegisterForm->surname = $v->validate($this->employeeRegisterForm->surname, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->employeeRegisterForm->phone = $v->validate($this->employeeRegisterForm->phone, [
            'trim' => true,
            'required' => true,
            'regexp' => "/^[0-9]{9}$/",
            'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
        ]);

        $this->employeeRegisterForm->email = $v->validate($this->employeeRegisterForm->email, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->employeeRegisterForm->password = $v->validate($this->employeeRegisterForm->password, [
            'trim' => true,
            'required' => true,
            'validator_message' => 'Podano nieprawidłowe hasło',
        ]);

        if (App::getMessages()->isError())
            return false;

        return !App::getMessages()->isError();
    }

    #########################################################################################

    public function action_editEmployee()
    {
        $this->editEmployee();
    }

    private function editEmployee()
    {
        if ($this->validateEdit()) {
            try {
                $record = App::getDB()->get("employee", "*", [
                    "id" => $this->employeeRegisterForm->id
                ]);
                $this->employeeRegisterForm->pesel = $record['pesel'];
                $this->employeeRegisterForm->name = $record['name'];
                $this->employeeRegisterForm->secondName = $record['second_name'];
                $this->employeeRegisterForm->surname = $record['surname'];
                $this->employeeRegisterForm->profession = $record['profession'];
                $this->employeeRegisterForm->phone = $record['phone'];
                $this->employeeRegisterForm->email = $record['email'];
                $this->employeeRegisterForm->password = $record['password'];
                $this->employeeRegisterForm->role = $record['role'];
                $this->employeeRegisterForm->isActive = $record['active'];

            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }
        $this->generateEmployeeEditForm();
    }

    public function validateEdit() {
        $this->employeeRegisterForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try {
            $employeeData = App::getDB()->get("employee", "*", [
                "id" => $this->employeeRegisterForm->id
            ]);
            if(!isset($employeeData)){
                Utils::addErrorMessage('Błąd, użytkownik nie istnieje!');
                return false;
            }
        } catch (\PDOException $e) {
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        return !App::getMessages()->isError();
    }

    public function action_employeeSave() {
        if($this->validateEmployeeRegistration()) {
            try {
                   App::getDB()->update("employee", [
                        "pesel" => $this->employeeRegisterForm->pesel,
                        "name" => $this->employeeRegisterForm->name,
                        "second_name" => $this->employeeRegisterForm->secondName,
                        "surname" => $this->employeeRegisterForm->surname,
                        "profession" => $this->employeeRegisterForm->profession,
                        "phone" => $this->employeeRegisterForm->phone,
                        "email" => $this->employeeRegisterForm->email,
                        "password" => $this->employeeRegisterForm->password,
                        "role" => $this->employeeRegisterForm->role,
                        "active" => $this->employeeRegisterForm->isActive,
                    ], [
                        "id" => $this->employeeRegisterForm->id
                    ]);

            } catch(\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Zapisano zmiany pracownika o peselu'.$this->employeeRegisterForm->pesel);
            App::getRouter()->forwardTo('displayEmployeeTable');
        }else {
            $this->generateEmployeeEditForm();
        }
    }

    public function action_employeeDelete()
    {
        $this->employeeDelete();
    }

    private function validateDelete() {
        if(RoleUtils::inRole('admin')) {
            $this->employeeRegisterForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
            try{
                $employee= App::getDB()->get("employee", "*", [
                    "id" => $this->employeeRegisterForm->id
                ]);
                if(!$employee){
                    Utils::addErrorMessage('Pracownik nie istnieje.');
                    return false;
                }
            }catch(\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd przy próbie usunięcia rekordu.');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
        }else{
            Utils::addErrorMessage('Nie masz uprawnień');
            App::getRouter()->forwardTo('displayEmployeeTable');
        }

        return !App::getMessages()->isError();
    }

    private function employeeDelete()
    {
        if($this->validateDelete()){
            try{
                App::getDB()->delete("employee", [
                    "id" => $this->employeeRegisterForm->id
                ]);
                Utils::addInfoMessage('Usunięto użytkownika.');
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

    #########
    #PATIENT#
    #########

    public function action_registerPatient()
    {
        $this->registerNewPatient();
    }

    private function registerNewPatient()
    {
        if ($this->validatePatientRegistration()) {
            try {
                $patientExists = App::getDB()->get("patient", '*', [
                    "pesel" => $this->patientRegisterForm->pesel
                ]);
                $emailExists = App::getDB()->get("patient", '*', [
                    "email" => $this->patientRegisterForm->email
                ]);
                if (!$patientExists || !$emailExists) {
                    App::getDB()->insert("patient", [
                        "pesel" => $this->patientRegisterForm->pesel,
                        "name" => $this->patientRegisterForm->name,
                        "second_name" => $this->patientRegisterForm->second_name,
                        "surname" => $this->patientRegisterForm->surname,
                        "voivodeship" => $this->patientRegisterForm->voivodeship,
                        "city" => $this->patientRegisterForm->city,
                        "street" => $this->patientRegisterForm->street,
                        "house_number" => $this->patientRegisterForm->house_number,
                        "flat_number" => $this->patientRegisterForm->flat_number,
                        "phone" => $this->patientRegisterForm->phone,
                        "email" => $this->patientRegisterForm->email,
                        "password" => $this->patientRegisterForm->password
                    ]);
                    $patientRow = App::getDB()->get("patient", [
                        "pesel" => $this->patientRegisterForm->pesel
                    ]);
                    $this->patientRegisterForm->id = $patientRow['id'];
                    App::getDB()->insert("patient", [
                        "id" => $this->patientRegisterForm->id
                    ]);
                } else {
                    Utils::addErrorMessage('Email lub nazwa użytkownika już istnieje..');
                    $this->generatePatientSelfRegistrationView();
                }
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Rejestracja zakończona pomyślnie');
            App::getRouter()->forwardTo('displayEmployeeTable');
        } else {
            $this->generatePatientSelfRegistrationView();
        }
    }

    private function validatePatientRegistration()
    {
        $this->patientRegisterForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->name = ParamUtils::getFromRequest('name', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->second_name = ParamUtils::getFromRequest('second_name',  false, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->surname = ParamUtils::getFromRequest('surname', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->voivodeship = ParamUtils::getFromRequest('voivodeship', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->city = ParamUtils::getFromRequest('city', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->street = ParamUtils::getFromRequest('street', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->house_number = ParamUtils::getFromRequest('house_number', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->flat_number = ParamUtils::getFromRequest('flat_number', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->phone = ParamUtils::getFromRequest('phone', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->email = ParamUtils::getFromRequest('email', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->password = ParamUtils::getFromRequest('password', true, 'Błędne wywołanie aplikacji');


        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->patientRegisterForm->pesel = $v->validate($this->patientRegisterForm->pesel, [
            'trim' => true,
            'required' => true,
            'length' => 11,
            'validator_message' => 'Pesel musi mieć 11 znaków.',
        ]);

        $this->patientRegisterForm->name = $v->validate($this->patientRegisterForm->name, [
            'trim' => true,
            'required' => true,
            'min_length' => 2,
            'max_length' => 30,
            'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
        ]);

        $this->patientRegisterForm->surname = $v->validate($this->patientRegisterForm->surname, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->patientRegisterForm->voivodeship = $v->validate($this->patientRegisterForm->voivodeship, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Województwo powinno mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->patientRegisterForm->city = $v->validate($this->patientRegisterForm->city, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Miasto powinno mieścić się pomiędzy 3 a 30 znakami.',
        ]);

        $this->patientRegisterForm->street = $v->validate($this->patientRegisterForm->street, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Ulica powinno mieścić się pomiędzy 5 a 40 znakami.',
        ]);

        $this->patientRegisterForm->house_number = $v->validate($this->patientRegisterForm->house_number, [
            'trim' => true,
            'required' => true,
            'max_length' => 5,
            'validator_message' => 'Numer domu lub bloku powinien mieścić się w zakresie 5 znaków.',
        ]);

        $this->patientRegisterForm->flat_number = $v->validate($this->patientRegisterForm->flat_number, [
            'trim' => true,
            'required' => true,
            'max_length' => 5,
            'validator_message' => 'Numer mieszkania powinien mieścić się w zakresie 5 znaków.',
        ]);

        $this->patientRegisterForm->phone = $v->validate($this->patientRegisterForm->phone, [
            'trim' => true,
            'required' => true,
            'regexp' => "/^[0-9]{9}$/",
            'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
        ]);

        $this->patientRegisterForm->email = $v->validate($this->patientRegisterForm->email, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->patientRegisterForm->password = $v->validate($this->patientRegisterForm->password, [
            'trim' => true,
            'required' => true,
            'validator_message' => 'Podano nieprawidłowe hasło',
        ]);

        if (App::getMessages()->isError())
            return false;

        return !App::getMessages()->isError();
    }

    #######
    #VIEWS#
    #######

    public function action_generatePatientSelfRegistrationView() {
        $this->generatePatientSelfRegistrationView();
    }

    private function generatePatientSelfRegistrationView() {
        App::getSmarty()->assign('form', $this->patientRegisterForm); // dane formularza do widoku
        App::getSmarty()->display('admin/registration/patientSelfRegistrationForm.tpl');
    }

    public function action_generateAdminPatientRegistrationView() {
        $this->generateAdminPatientRegistrationView();
    }

    private function generateAdminPatientRegistrationView() {
        App::getSmarty()->assign('form', $this->patientRegisterForm); // dane formularza do widoku
        App::getSmarty()->display('admin/registration/patientAdminRegistrationForm.tpl');
    }

    public function action_generateEmployeeRegisterForm() {
        $this->generateEmployeeRegistrationView();
    }

    public function generateEmployeeRegistrationView() {
        App::getSmarty()->assign('form', $this->employeeRegisterForm); // dane formularza do widoku
        App::getSmarty()->display('admin/registration/employeeRegistrationForm.tpl');
    }

    private function generateEmployeeEditForm() {
        App::getSmarty()->assign('form', $this->employeeRegisterForm); // dane formularza dla widoku
        App::getSmarty()->display('admin/edit/editEmployeeForm.tpl');
    }

}