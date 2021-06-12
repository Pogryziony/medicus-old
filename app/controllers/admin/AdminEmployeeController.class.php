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

class AdminEmployeeController
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


    public function action_registerEmployee()
    {
        $this->registerEmployee();
    }

    private function registerEmployee()
    {
        if ($this->validateEmployeeRegistration()) {
            try {
                $emailExists = App::getDB()->get(
                    "employee",
                    '*',
                    [
                        "email" => $this->employeeForm->email
                    ]
                );
                if (!$emailExists) {
                    App::getDB()->insert(
                        "employee",
                        [
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
                        ]
                    );
                    $employeeRow = App::getDB()->get(
                        "employee",
                        [
                            "pesel" => $this->employeeForm->pesel
                        ]
                    );
                    $this->employeeForm->id = $employeeRow['id'];
                    App::getDB()->insert(
                        "employee",
                        [
                            "id" => $this->employeeForm->id
                        ]
                    );
                } else {
                    Utils::addErrorMessage('Email lub nazwa użytkownika już istnieje..');
                    $this->generateEmployeeRegistrationView();
                }
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
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
        $this->employeeForm->secondName = ParamUtils::getFromRequest(
            'second_name',
            false,
            'Błędne wywołanie aplikacji'
        );
        $this->employeeForm->surname = ParamUtils::getFromRequest('surname', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->profession = ParamUtils::getFromRequest('profession', false, 'Błędne wywołanie aplikacji');
        $this->employeeForm->phone = ParamUtils::getFromRequest('phone', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->email = ParamUtils::getFromRequest('email', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->password = ParamUtils::getFromRequest('password', true, 'Błędne wywołanie aplikacji');
        $this->employeeForm->role = (ParamUtils::getFromPost("role") === "admin") ? "admin" : "user";
        $this->employeeForm->isActive = ParamUtils::getFromRequest(
                'active',
                true,
                'Błędne wywołanie aplikacji'
            ) == "true";

        if (App::getMessages()->isError()) {
            return false;
        }

        $v = new Validator();

        $this->employeeForm->pesel = $v->validate(
            $this->employeeForm->pesel,
            [
                'trim' => true,
                'required' => true,
                'length' => 11,
                'validator_message' => 'Pesel musi mieć 11 znaków.',
            ]
        );

        $this->employeeForm->name = $v->validate(
            $this->employeeForm->name,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 2,
                'max_length' => 30,
                'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
            ]
        );

        $this->employeeForm->surname = $v->validate(
            $this->employeeForm->surname,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->employeeForm->phone = $v->validate(
            $this->employeeForm->phone,
            [
                'trim' => true,
                'required' => true,
                'regexp' => "/^[0-9]{9}$/",
                'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
            ]
        );

        $this->employeeForm->email = $v->validate(
            $this->employeeForm->email,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->employeeForm->password = $v->validate(
            $this->employeeForm->password,
            [
                'trim' => true,
                'required' => true,
                'validator_message' => 'Podano nieprawidłowe hasło',
            ]
        );

        if (App::getMessages()->isError()) {
            return false;
        }

        return !App::getMessages()->isError();
    }

    public function generateEmployeeRegistrationView()
    {
        App::getSmarty()->assign('form', $this->employeeForm); // dane formularza do widoku
        App::getSmarty()->display('admin/registration/employeeRegistrationForm.tpl');
    }

    public function action_editEmployee()
    {
        if ($this->validateEmployeeEdit()) {
            $this->generateEmployeeEditForm();
        } else {
            App::getRouter()->forwardTo('displayEmployeeTable');
        }
    }

    public function validateEmployeeEdit()
    {
        $this->employeeForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try {
            $record = App::getDB()->get(
                "employee",
                "*",
                [
                    "id" => $this->employeeForm->id
                ]
            );
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
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd aplikacji.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        return !App::getMessages()->isError();
    }

    private function generateEmployeeEditForm()
    {
        App::getSmarty()->assign('form', $this->employeeForm); // dane formularza dla widoku
        App::getSmarty()->display('admin/edit/editEmployeeForm.tpl');
    }

    public function action_saveEmployee()
    {
        if ($this->validateEmployeeSave()) {
            try {
                App::getDB()->update(
                    "employee",
                    [
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
                    ],
                    [
                        "id" => $this->employeeForm->id
                    ]
                );
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            Utils::addInfoMessage('Zapisano zmiany w rachunku.');
            App::getRouter()->forwardTo('displayEmployeeTable');
        } else {
            $this->generateEmployeeEditForm();
        }
    }

    public function validateEmployeeSave()
    {
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

        if (App::getMessages()->isError()) {
            return false;
        }

        $v = new Validator();

        $this->employeeForm->id = $v->validate(
            $this->employeeForm->id,
            [
                'trim' => true,
                'required' => true,
                'int' => true,
                'required_message' => 'Wystąpił błąd aplikacji',
                'validator_message' => 'Wystąpił błąd aplikacji.',
            ]
        );

        $this->employeeForm->name = $v->validate(
            $this->employeeForm->name,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 2,
                'max_length' => 30,
                'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
            ]
        );

        $this->employeeForm->surname = $v->validate(
            $this->employeeForm->surname,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->employeeForm->phone = $v->validate(
            $this->employeeForm->phone,
            [
                'trim' => true,
                'required' => true,
                'regexp' => "/^[0-9]{9}$/",
                'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
            ]
        );

        $this->employeeForm->email = $v->validate(
            $this->employeeForm->email,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->employeeForm->password = $v->validate(
            $this->employeeForm->password,
            [
                'trim' => true,
                'required' => true,
                'validator_message' => 'Podano nieprawidłowe hasło',
            ]
        );

        if (App::getMessages()->isError()) {
            return false;
        }

        return !App::getMessages()->isError();
    }

    public function action_deleteEmployee()
    {
        if ($this->validateEmployeeDelete()) {
            try {
                App::getDB()->delete(
                    "employee",
                    [
                        "id" => $this->employeeForm->id
                    ]
                );
                Utils::addInfoMessage('Usunięto pracownika.');
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas kasowania rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            App::getRouter()->forwardTo('displayEmployeeTable');
        } else {
            App::getRouter()->forwardTo('displayEmployeeTable');
        }
    }

    public function validateEmployeeDelete()
    {
        $this->employeeForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try {
            $record = App::getDB()->get(
                "employee",
                "*",
                [
                    "id" => $this->employeeForm->id
                ]
            );
            if (!$record) {
                Utils::addErrorMessage('Pracownik nie istnieje.');
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

    private function getEntriesCount($size=10, $page=1) {
        $limitDown = $size * ($page - 1);
        $limitUp = $size * $page;
        $entries = App::getDB()->count("employee", "*", [
            "LIMIT"=>[$limitDown, $limitUp]
        ]);
        $pages = ceil($entries / $size);
        return $pages;
    }

    public function action_displayEmployeeTable()
    {
        try {
            $this->employees = App::getDB()->select('employee', '*');
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        App::getSmarty()->assign('employee', $this->employees);
        App::getSmarty()->assign("pages_count", $this->getEntriesCount());
        App::getSmarty()->assign("page", 1);
        App::getSmarty()->assign("size", 10);
        App::getSmarty()->display('common_elements/tables/employeesTable.tpl');
    }

    public function action_generateEmployeeRegisterForm() {
        $this->generateEmployeeRegistrationView();
    }

}