<?php

namespace app\controllers\patient;

use app\forms\patient\PatientRegisterForm;
use core\App;
use core\ParamUtils;
use core\Utils;
use core\Validator;
use PDOException;

class PatientRegistrationController
{
    /**
     * @var PatientRegisterForm
     */
    private $patientRegisterForm;

    public function __construct()
    {
        $this->patientRegisterForm = new PatientRegisterForm();
    }

    public function action_generatePatientSelfRegistrationView()
    {
        App::getSmarty()->assign('form', $this->patientRegisterForm); // dane formularza do widoku
        App::getSmarty()->display('admin/registration/patientSelfRegistrationForm.tpl');
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
                    App::getRouter()->forwardTo('generatePatientSelfRegistrationView');
                }
            } catch (PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug) {
                    Utils::addErrorMessage($e->getMessage());
                }
            }
            Utils::addInfoMessage('Rejestracja zakończona pomyślnie');
            App::getRouter()->redirectTo('patientLogin');
        } else {
            App::getRouter()->forwardTo('generatePatientSelfRegistrationView');
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
}