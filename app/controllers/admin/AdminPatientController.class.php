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

class AdminPatientController
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

    public function action_registerPatient()
    {
        $this->registerNewPatient();
    }

    private function registerNewPatient()
    {
        if ($this->validatePatientRegistration()) {
            try {
                $patientExists = App::getDB()->get(
                    "patient",
                    '*',
                    [
                        "pesel" => $this->patientRegisterForm->pesel
                    ]
                );
                $emailExists = App::getDB()->get(
                    "patient",
                    '*',
                    [
                        "email" => $this->patientRegisterForm->email
                    ]
                );
                if (!$patientExists || !$emailExists) {
                    App::getDB()->insert(
                        "patient",
                        [
                            "pesel" => $this->patientRegisterForm->pesel,
                            "name" => $this->patientRegisterForm->name,
                            "second_name" => $this->patientRegisterForm->secondName,
                            "surname" => $this->patientRegisterForm->surname,
                            "voivodeship" => $this->patientRegisterForm->voivodeship,
                            "city" => $this->patientRegisterForm->city,
                            "street" => $this->patientRegisterForm->street,
                            "house_number" => $this->patientRegisterForm->houseNumber,
                            "flat_number" => $this->patientRegisterForm->flatNumber,
                            "phone" => $this->patientRegisterForm->phone,
                            "email" => $this->patientRegisterForm->email,
                            "password" => $this->patientRegisterForm->password
                        ]
                    );
                    $patientRow = App::getDB()->get(
                        "patient",
                        [
                            "pesel" => $this->patientRegisterForm->pesel
                        ]
                    );
                    $this->patientRegisterForm->id = $patientRow['id'];
                    App::getDB()->insert(
                        "patient",
                        [
                            "id" => $this->patientRegisterForm->id
                        ]
                    );
                } else {
                    Utils::addErrorMessage('Email lub nazwa użytkownika już istnieje..');
                    $this->generateAdminPatientRegistrationView();
                }
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            Utils::addInfoMessage('Rejestracja zakończona pomyślnie');
            App::getRouter()->redirectTo('displayPatientsTable');
        } else {
            $this->generateAdminPatientRegistrationView();
        }
    }

    private function validatePatientRegistration()
    {
        $this->patientRegisterForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->name = ParamUtils::getFromRequest('name', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->secondName = ParamUtils::getFromRequest(
            'second_name',
            false,
            'Błędne wywołanie aplikacji'
        );
        $this->patientRegisterForm->surname = ParamUtils::getFromRequest('surname', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->voivodeship = ParamUtils::getFromRequest(
            'voivodeship',
            true,
            'Błędne wywołanie aplikacji'
        );
        $this->patientRegisterForm->city = ParamUtils::getFromRequest('city', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->street = ParamUtils::getFromRequest('street', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->houseNumber = ParamUtils::getFromRequest(
            'house_number',
            true,
            'Błędne wywołanie aplikacji'
        );
        $this->patientRegisterForm->flatNumber = ParamUtils::getFromRequest(
            'flat_number',
            false,
            'Błędne wywołanie aplikacji'
        );
        $this->patientRegisterForm->phone = ParamUtils::getFromRequest('phone', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->email = ParamUtils::getFromRequest('email', true, 'Błędne wywołanie aplikacji');
        $this->patientRegisterForm->password = ParamUtils::getFromRequest(
            'password',
            true,
            'Błędne wywołanie aplikacji'
        );


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

        $this->patientRegisterForm->name = $v->validate(
            $this->patientRegisterForm->name,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 2,
                'max_length' => 30,
                'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->secondName = $v->validate(
            $this->patientRegisterForm->secondName,
            [
                'trim' => true,
                'required' => false,
                'min_length' => 2,
                'max_length' => 30,
                'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->surname = $v->validate(
            $this->patientRegisterForm->surname,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->voivodeship = $v->validate(
            $this->patientRegisterForm->voivodeship,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Województwo powinno mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->city = $v->validate(
            $this->patientRegisterForm->city,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Miasto powinno mieścić się pomiędzy 3 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->street = $v->validate(
            $this->patientRegisterForm->street,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Ulica powinno mieścić się pomiędzy 5 a 40 znakami.',
            ]
        );

        $this->patientRegisterForm->houseNumber = $v->validate(
            $this->patientRegisterForm->houseNumber,
            [
                'trim' => true,
                'required' => true,
                'max_length' => 5,
                'validator_message' => 'Numer domu lub bloku powinien mieścić się w zakresie 5 znaków.',
            ]
        );

        $this->patientRegisterForm->flatNumber = $v->validate(
            $this->patientRegisterForm->flatNumber,
            [
                'trim' => true,
                'required' => false,
                'max_length' => 5,
                'validator_message' => 'Numer mieszkania powinien mieścić się w zakresie 5 znaków.',
            ]
        );

        $this->patientRegisterForm->phone = $v->validate(
            $this->patientRegisterForm->phone,
            [
                'trim' => true,
                'required' => true,
                'regexp' => "/^[0-9]{9}$/",
                'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
            ]
        );

        $this->patientRegisterForm->email = $v->validate(
            $this->patientRegisterForm->email,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->password = $v->validate(
            $this->patientRegisterForm->password,
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

    private function generateAdminPatientRegistrationView()
    {
        App::getSmarty()->assign('form', $this->patientRegisterForm); // dane formularza do widoku
        App::getSmarty()->display('admin/registration/patientAdminRegistrationForm.tpl');
    }

    public function action_editPatient()
    {
        if ($this->validatePatientEdit()) {
            $this->generatePatientEditForm();
        } else {
            App::getRouter()->forwardTo('displayPatientTable');
        }
    }

    public function validatePatientEdit()
    {
        $this->patientRegisterForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try {
            $record = App::getDB()->get(
                "patient",
                "*",
                [
                    "id" => $this->patientRegisterForm->id
                ]
            );
            $this->patientRegisterForm->pesel = $record['pesel'];
            $this->patientRegisterForm->name = $record['name'];
            $this->patientRegisterForm->secondName = $record['second_name'];
            $this->patientRegisterForm->surname = $record['surname'];
            $this->patientRegisterForm->voivodeship = $record['voivodeship'];
            $this->patientRegisterForm->city = $record['city'];
            $this->patientRegisterForm->street = $record['street'];
            $this->patientRegisterForm->houseNumber = $record['house_number'];
            $this->patientRegisterForm->flatNumber = $record['flat_number'];
            $this->patientRegisterForm->phone = $record['phone'];
            $this->patientRegisterForm->email = $record['email'];
            $this->patientRegisterForm->password = $record['password'];
            $this->patientRegisterForm->isActive = $record['active'];
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd aplikacji.');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        return !App::getMessages()->isError();
    }

    private function generatePatientEditForm()
    {
        App::getSmarty()->assign('form', $this->patientRegisterForm); // dane formularza dla widoku
        App::getSmarty()->display('admin/edit/editPatientForm.tpl');
    }

    public function action_savePatient()
    {
        if ($this->validatePatientSave()) {
            try {
                App::getDB()->update(
                    "patient",
                    [
                        "pesel" => $this->patientRegisterForm->pesel,
                        "name" => $this->patientRegisterForm->name,
                        "second_name" => $this->patientRegisterForm->secondName,
                        "surname" => $this->patientRegisterForm->surname,
                        "voivodeship" => $this->patientRegisterForm->voivodeship,
                        "city" => $this->patientRegisterForm->city,
                        "street" => $this->patientRegisterForm->street,
                        "house_number" => $this->patientRegisterForm->houseNumber,
                        "flat_number" => $this->patientRegisterForm->flatNumber,
                        "phone" => $this->patientRegisterForm->phone,
                        "email" => $this->patientRegisterForm->email,
                        "password" => $this->patientRegisterForm->password,
                        "active" => $this->patientRegisterForm->isActive,
                    ],
                    [
                        "id" => $this->patientRegisterForm->id
                    ]
                );
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            Utils::addInfoMessage('Zapisano zmiany pacjenta.');
            App::getRouter()->redirectTo('displayPatientTable');
        } else {
            $this->generatePatientEditForm();
        }
    }

    public function validatePatientSave()
    {
        $this->patientRegisterForm->id = ParamUtils::getFromRequest('id', true, 'Błędne ID');
        $this->patientRegisterForm->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędny pesel');
        $this->patientRegisterForm->name = ParamUtils::getFromRequest('name', true, 'Błędne imie');
        $this->patientRegisterForm->secondName = ParamUtils::getFromRequest('second_name', false, 'Błędne drugie imie');
        $this->patientRegisterForm->surname = ParamUtils::getFromRequest('surname', true, 'Błędne nazwisko');
        $this->patientRegisterForm->voivodeship = ParamUtils::getFromRequest('voivodeship', true, 'Błędne województwo');
        $this->patientRegisterForm->city = ParamUtils::getFromRequest('city', true, 'Błędne miasto');
        $this->patientRegisterForm->street = ParamUtils::getFromRequest('street', true, 'Błędna ulica');
        $this->patientRegisterForm->houseNumber = ParamUtils::getFromRequest('house_number', true, 'Błędny numer domu');
        $this->patientRegisterForm->flatNumber = ParamUtils::getFromRequest(
            'flat_number',
            false,
            'Błędny numer mieszkania'
        );
        $this->patientRegisterForm->phone = ParamUtils::getFromRequest('phone', true, 'Błędny numerr telefonu');
        $this->patientRegisterForm->email = ParamUtils::getFromRequest('email', true, 'Błędny email');
        $this->patientRegisterForm->password = ParamUtils::getFromRequest('password', true, 'Błędne hasło');
        $this->patientRegisterForm->isActive = ParamUtils::getFromRequest('active', true, 'Błędna aktywność') == "true";

        if (App::getMessages()->isError()) {
            return false;
        }

        $v = new Validator();

        $this->patientRegisterForm->id = $v->validate(
            $this->patientRegisterForm->id,
            [
                'trim' => true,
                'required' => true,
                'int' => true,
                'required_message' => 'Wystąpił błąd aplikacji',
                'validator_message' => 'Wystąpił błąd aplikacji.',
            ]
        );

        $this->patientRegisterForm->name = $v->validate(
            $this->patientRegisterForm->name,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 2,
                'max_length' => 30,
                'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->surname = $v->validate(
            $this->patientRegisterForm->surname,
            [
                'trim' => true,
                'required' => false,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->phone = $v->validate(
            $this->patientRegisterForm->phone,
            [
                'trim' => true,
                'required' => true,
                'regexp' => "/^[0-9]{9}$/",
                'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
            ]
        );

        $this->patientRegisterForm->email = $v->validate(
            $this->patientRegisterForm->email,
            [
                'trim' => true,
                'required' => true,
                'min_length' => 5,
                'max_length' => 30,
                'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
            ]
        );

        $this->patientRegisterForm->password = $v->validate(
            $this->patientRegisterForm->password,
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

    public function action_deletePatient()
    {
        if ($this->validatePatientDelete()) {
            try {
                App::getDB()->delete(
                    "patient",
                    [
                        "id" => $this->patientRegisterForm->id
                    ]
                );
                Utils::addInfoMessage('Usunięto pacjenta.');
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas kasowania rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            App::getRouter()->redirectTo('displayPatientTable');
        } else {
            App::getRouter()->redirectTo('displayPatientTable');
        }
    }

    public function validatePatientDelete()
    {
        $this->patientRegisterForm->id = ParamUtils::getFromCleanURL(1, true, 'Błędne wywołanie aplikacji');
        try {
            $record = App::getDB()->get(
                "patient",
                "*",
                [
                    "id" => $this->patientRegisterForm->id
                ]
            );
            if (!$record) {
                Utils::addErrorMessage('Pacjent nie istnieje.');
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

    public function action_displayPatientsTable()
    {
        try {
            $this->patients = App::getDB()->select('patient', '*');
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        App::getSmarty()->assign('patient', $this->patients);
        App::getSmarty()->display('common_elements/tables/patientTable.tpl');
    }

    public function action_generateAdminPatientRegistrationView()
    {
        $this->generateAdminPatientRegistrationView();
    }

}