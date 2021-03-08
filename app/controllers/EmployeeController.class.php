<?php

namespace app\controllers;

use app\forms\employee\EmployeeLoginForm;
use core\App;
use core\RoleUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class EmployeeController {
    private $employeeLoginForm;

    public function __construct()
    {
        $this->employeeLoginForm = new EmployeeLoginForm();
    }

    public function action_employeeLogin()
    {
        $this->employeeLogin();
    }

    private function employeeLogin()
    {
        if (SessionUtils::load("employeeSessionData", true) != null) {
            App::getRouter()->redirectTo("employeeDashboard");
        }
        $this->employeeLoginForm->email = ParamUtils::getFromRequest('email');
        $this->employeeLoginForm->password = ParamUtils::getFromRequest('password');

        // if request method is post and validation is okay, login user
        if (($_SERVER["REQUEST_METHOD"] === "POST") && ($this->validateEmployeeLogin($this->employeeLoginForm->email, $this->employeeLoginForm->password))) {
            $this->loginEmployee($this->employeeLoginForm->email);
        }
        $this->generateLoginForm();
    }

    private function validateEmployeeLogin($email, $password)
    {
        $this->employeeLoginForm->email = ParamUtils::getFromRequest('email');
        $this->employeeLoginForm->password = ParamUtils::getFromRequest('password');

        if (!isset($this->employeeLoginForm->email))
            return false;
        if (empty($this->employeeLoginForm->email)) {
            Utils::addErrorMessage('Nie podano emaila.');
        }
        if (empty($this->employeeLoginForm->password)) {
            Utils::addErrorMessage('Nie podano hasła.');
        }
        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->employeeLoginForm->email = $v->validate($this->employeeLoginForm->email, [
            'trim' => true,
            'required' => true
        ]);

        try {
            $employeeRow = App::getDB()->get("employee", [
                "password",
                "active"
            ], [
                "email" => $this->employeeLoginForm->email
            ]);
            if (!isset($employeeRow)) {
                Utils::addErrorMessage('Nieprawidłowy login lub hasło.');
                return false;
            } else {
                if ($this->employeeLoginForm->password != $employeeRow["password"]) {
                    Utils::addErrorMessage('Nieprawidłowy login lub hasło.');
                    return false;
                }

                if (1 != intval($employeeRow["active"])) {
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

    private function loginEmployee($email)
    {
        $employeeData = array();
        try {
            $employeeData = App::getDB()->get("employee", [
                "password",
                "active",
                "role",
            ], [
                "email" => $email
            ]);
            $employeeData = $employeeData[0];
        } catch (\PDOException $e) {
            App::getMessages()->addMessage("Wystąpił błąd podczas logowania użytkownika. Spróbuj ponownie, lub skontaktuj się z administratorem systemu");
        }
        RoleUtils::addRole($employeeData["role"]);
        SessionUtils::store("employeeId", $employeeData["id"]);
        $employeeSessionData = new \stdClass();
        $employeeSessionData->name = $employeeData["name"];
        $employeeSessionData->secondName = $employeeData["second_name"];
        $employeeSessionData->role = $employeeData["role"];
        SessionUtils::store("employeeSessionData", $employeeSessionData);
        App::getRouter()->redirectTo("employeeDashboard");
    }

    public function action_employeeLogout()
    {
        session_destroy();
        Utils::addInfoMessage('Zostałeś wylogowany.');
        App::getRouter()->forwardTo("showEmployeeLoginForm");
    }

    public function action_showEmployeeLoginForm()
    {
        $this->generateLoginForm();
    }

    public function generateLoginForm()
    {
        App::getSmarty()->assign('loginForm', $this->employeeLoginForm); // dane formularza do widoku
        App::getSmarty()->display('login/employeeLoginForm.tpl');
    }

    public function action_employeeDashboard()
    {
        App::getSmarty()->display("mainEmployeePage.tpl");
    }

    public function action_displayPatientsTable()
    {
        try {
            $this->patients = App::getDB()->select('patient', '*');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        App::getSmarty()->assign('patient', $this->patients);
        App::getSmarty()->display("common_elements/tables/patientTable.tpl");
    }

    public function action_displayEmployeeTable()
    {
        try {
            $this->employees = App::getDB()->select('employee', '*');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        App::getSmarty()->assign('employee', $this->employees);
        App::getSmarty()->display("common_elements/tables/employeesTable.tpl");
    }
}
