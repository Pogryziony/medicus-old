<?php

namespace app\controllers;

use app\forms\employee\EmployeeForm;
use app\forms\patient\PatientRegisterForm;
use core\App;
use core\ParamUtils;
use core\RoleUtils;
use core\Utils;
use core\Validator;


class AdminController
{
    private $patientRegisterForm;

    private $employeeForm;

    public function __construct()
    {
        $this->patientRegisterForm = new PatientRegisterForm();
        $this->employeeForm = new EmployeeForm();
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
        App::getSmarty()->assign('form', $this->employeeForm); // dane formularza do widoku
        App::getSmarty()->display('admin/registration/employeeRegistrationForm.tpl');
    }

    private function generateEmployeeEditForm() {
        App::getSmarty()->assign('form', $this->employeeForm); // dane formularza dla widoku
        App::getSmarty()->display('admin/edit/editEmployeeForm.tpl');
    }

}