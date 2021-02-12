<?php

namespace app\controllers;

use app\forms\PatientLoginForm;
use app\forms\RegisterForm;
use core\App;
use core\Message;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class PatientRegistrationController {
    private $form;

    public function __construct() {
        $this->form = new RegisterForm();
    }

    public function validateRegistration()
    {
        $this->form->pesel = ParamUtils::getFromRequest('pesel', true, 'Błędne wywołanie aplikacji');
        $this->form->name = ParamUtils::getFromRequest('name', true, 'Błędne wywołanie aplikacji');
        $this->form->second_name = ParamUtils::getFromRequest('second_name', false, 'Błędne wywołanie aplikacji');
        $this->form->surname = ParamUtils::getFromRequest('surname', true, 'Błędne wywołanie aplikacji');
        $this->form->voivodeship = ParamUtils::getFromRequest('voivodeship', true, 'Błędne wywołanie aplikacji');
        $this->form->city = ParamUtils::getFromRequest('city', true, 'Błędne wywołanie aplikacji');
        $this->form->street = ParamUtils::getFromRequest('street', true, 'Błędne wywołanie aplikacji');
        $this->form->house_number = ParamUtils::getFromRequest('house_number', true, 'Błędne wywołanie aplikacji');
        $this->form->flat_number = ParamUtils::getFromRequest('flat_number', true, 'Błędne wywołanie aplikacji');
        $this->form->phone = ParamUtils::getFromRequest('phone', true, 'Błędne wywołanie aplikacji');
        $this->form->email = ParamUtils::getFromRequest('email', true, 'Błędne wywołanie aplikacji');
        $this->form->password = ParamUtils::getFromRequest('password', true, 'Błędne wywołanie aplikacji');


        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->form->pesel = $v->validate($this->form->pesel, [
            'trim' => true,
            'required' => true,
            'length' => 11,
            'validator_message' => 'Pesel musi mieć 11 znaków.',
        ]);

        $this->form->name = $v->validate($this->form->name, [
            'trim' => true,
            'required' => true,
            'min_length' => 2,
            'max_length' => 30,
            'validator_message' => 'Imie powinno mieścić się pomiędzy 2 a 30 znakami.',
        ]);

        $this->form->second_name = $v->validate($this->form->second_name, [
            'trim' => true,
            'required' => false,
            'validator_message' => 'Drugie imię powinno mieścić się pomiędzy 2 a 30 znakami.',
        ]);

        $this->form->surname = $v->validate($this->form->surname, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Nazwisko powinno mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->form->voivodeship = $v->validate($this->form->voivodeship, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Województwo powinno mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->form->city = $v->validate($this->form->city, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Miasto powinno mieścić się pomiędzy 3 a 30 znakami.',
        ]);

        $this->form->street = $v->validate($this->form->street, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Ulica powinno mieścić się pomiędzy 5 a 40 znakami.',
        ]);

        $this->form->house_number = $v->validate($this->form->house_number, [
            'trim' => true,
            'required' => true,
            'max_length' => 5,
            'validator_message' => 'Numer domu lub bloku powinien mieścić się w zakresie 5 znaków.',
        ]);

        $this->form->flat_number = $v->validate($this->form->flat_number, [
            'trim' => true,
            'required' => true,
            'max_length' => 5,
            'validator_message' => 'Numer mieszkania powinien mieścić się w zakresie 5 znaków.',
        ]);

        $this->form->phone = $v->validate($this->form->phone, [
            'trim' => true,
            'required' => true,
            'regexp' => "/^[0-9]{9}$/",
            'validator_message' => 'Podaj prawidłowy numer telefonu - 9 cyfr.',
        ]);

        $this->form->email = $v->validate($this->form->email, [
            'trim' => true,
            'required' => true,
            'min_length' => 5,
            'max_length' => 30,
            'validator_message' => 'Email powinien mieścić się pomiędzy 5 a 30 znakami.',
        ]);

        $this->form->password = $v->validate($this->form->password, [
            'trim' => true,
            'required' => true,
            'validator_message' => 'Podano nieprawidłowe hasło',
        ]);

        if (App::getMessages()->isError())
            return false;

        return !App::getMessages()->isError();
    }

    public function action_registerPatient()
    {
        if ($this->validateRegistration()) {
            try {
                $patientExists = App::getDB()->get("patient", '*', [
                    "pesel" => $this->form->pesel
                ]);
                $emailExists = App::getDB()->get("patient", '*', [
                    "email" => $this->form->email
                ]);
                if (!$patientExists || !$emailExists) {
                    App::getDB()->insert("patient", [
                        "pesel" => $this->form->pesel,
                        "name" => $this->form->name,
                        "second_name" => $this->form->second_name,
                        "surname" => $this->form->surname,
                        "voivodeship" => $this->form->voivodeship,
                        "city" => $this->form->city,
                        "street" => $this->form->street,
                        "house_number" => $this->form->house_number,
                        "flat_number" => $this->form->flat_number,
                        "phone" => $this->form->phone,
                        "email" => $this->form->email,
                        "password" => $this->form->password
                    ]);
                    $patientRow = App::getDB()->get("patient", [
                        "pesel" => $this->form->pesel
                    ]);
                    $this->form->id = $patientRow['id'];
                    App::getDB()->insert("patient", [
                        "id" => $this->form->id
                    ]);
                } else {
                    Utils::addErrorMessage('Email lub nazwa użytkownika już istnieje..');
                    $this->generateView();
                }
            } catch (\PDOException $e) {
                Utils::addErrorMessage('Wystąpił nieoczekiwany błąd podczas zapisu rekordu');
                if (App::getConf()->debug)
                    Utils::addErrorMessage($e->getMessage());
            }
            Utils::addInfoMessage('Rejestracja zakończona pomyślnie');
            App::getSmarty()->display('login/patientRegistration.tpl');
        } else {
            $this->generateView();
        }
    }


    public function action_registerShowForm() {
        $this->generateView();
    }
    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // dane formularza do widoku
        App::getSmarty()->display('login/patientRegistrationForm.tpl');
    }
}
