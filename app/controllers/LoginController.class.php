<?php

namespace app\controllers;

use app\forms\LoginForm;
use core\App;
use core\Message;
use core\RoleUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class LoginController {
    private $form;

    public function __construct() {
        $this->form = new LoginForm();
    }

    public function validate() {
        $this->form->login = ParamUtils::getFromRequest('login');
        $this->form->pass = ParamUtils::getFromRequest('pass');

        if (!isset($this->form->login))
            return false;
        if (empty($this->form->login)){
            Utils::addErrorMessage('Nie podano loginu.');
        }
        if (empty($this->form->pass)) {
            Utils::addErrorMessage('Nie podano hasła.');
        }

        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->form->login = $v->validate($this->form->login, [
            'trim' => true,
            'required' => true
        ]);

        try{
            $userRow = App::getDB()->get("user", [
                "password",
                "role",
                "active"
            ], [
                "login" => $this->form->login
            ]);

            if(!isset($userRow)){
                Utils::addErrorMessage('Nieprawidłowy login lub hasło.');
                return false;
            }else {
                if ($this->form->pass != $userRow["password"]) {
                    Utils::addErrorMessage('Nieprawidłowy login lub hasło.');
                    return false;
                }

                if (1 != intval($userRow["active"])) {
                    Utils::addErrorMessage('Konto użytkownika nie jest aktywne.');
                    return false;
                }
            }
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas logowania.');
            if (App::getConf()->debug)
                App::getMessages()->addMessage($e->getMessage());
        }

        return !App::getMessages()->isError();
    }
    public function action_login() {

        App::getSmarty()->display("loginForm.tpl");
    }

    public function action_logout() {
        session_destroy();
        Utils::addInfoMessage('Zostałeś wylogowany.');
        App::getRouter()->forwardTo("showLogin");
    }

    private function loginUser($email) {
        $data = array();
        try {
            $data = App::getDB()->select("patient", [
                "id",
                "name",
                "second_name",
                "surname",
                "pesel"
            ],[
                "email"=>$email
            ]);
            $data = $data[0];
        } catch (\PDOException $e) {
            // TODO write to logs
            // echo $e
            App::getMessages()->addMessage("Wystąpił błąd podczas logowania użytkownika. Spróbuj ponownie, lub skontaktuj się z administratorem systemu");
        }
        RoleUtils::addRole($data["role"]);
        SessionUtils::store("userUuid", $data["uuid"]);
        // create userData object to store data of user in there
        $userData = new \stdClass();
        $userData->firstName = $data["first_name"];
        $userData->lastName = $data["last_name"];
        SessionUtils::store("userData", $userData);
        App::getRouter()->redirectTo("dashboard");
    }

    public function generateView() {
        App::getSmarty()->assign('form', $this->form); // dane formularza do widoku
        App::getSmarty()->display('login.tpl');
    }
}
