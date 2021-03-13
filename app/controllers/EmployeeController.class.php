<?php

namespace app\controllers;

use app\forms\employee\EmployeeForm;
use core\App;
use core\Message;
use core\RoleUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use core\ParamUtils;

class EmployeeController {
    private $employeeForm;

    public function __construct()
    {
        $this->employeeForm = new EmployeeForm();
    }

    public function validateEmployeeLogin(): bool
    {
        $this->employeeForm->email = ParamUtils::getFromRequest('email');
        $this->employeeForm->password = ParamUtils::getFromRequest('password');
        $this->employeeForm->role = ParamUtils::getFromRequest('role');
        $this->employeeForm->pesel = ParamUtils::getFromRequest('pesel');

        if (!isset($this->employeeForm->email))
            return false;
        if (empty($this->employeeForm->email)){
            Utils::addErrorMessage('Nie podano adresu email.');
        }
        if (empty($this->employeeForm->password)) {
            Utils::addErrorMessage('Nie podano hasła.');
        }

        if (App::getMessages()->isError())
            return false;

        $v = new Validator();

        $this->employeeForm->email = $v->validate($this->employeeForm->email, [
            'trim' => true,
            'required' => true
        ]);

        try{
            $employeeRow = App::getDB()->get('employee', [
                'password',
                'role',
                'active'
            ], [
                'email' => $this->employeeForm->email
            ]);

            if(!isset($employeeRow)){
                Utils::addErrorMessage('Nieprawidłowy pesel lub hasło.');
                return false;
            }else {
                if ($this->employeeForm->password != $employeeRow['password']) {
                    Utils::addErrorMessage('Nieprawidłowy pesel lub hasło.');
                    return false;
                }

                if (1 != intval($employeeRow['active'])) {
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

    public function action_employeeLogin() {
        if (SessionUtils::loadObject("employeeData", true) != null) {
            App::getRouter()->redirectTo("employeeDashboard");
        }
        if ($_SERVER["REQUEST_METHOD"] === "POST" && $this->validateEmployeeLogin()) {
            //zalogowany => przekieruj na główną akcję (z przekazaniem messages przez sesję)
            App::getMessages()->addMessage(new Message('Poprawnie zalogowano do systemu', Message::INFO));
            $employeeRow = App::getDB()->get('employee', ['id','pesel','role'],[
                "pesel" => $this->employeeForm->pesel,
            ]);
            // create employeeData object to store data of employee in there
            $employeeData = new \stdClass();
            $employeeData->id = $employeeRow["id"];
            $employeeData->pesel = $employeeRow["pesel"];
            $employeeData->role = $employeeRow["role"];
            RoleUtils::addRole($employeeData->role);
            SessionUtils::storeObject("employeeData", $employeeData);
            // if request method is post and validation is okay, login user
            App::getRouter()->redirectTo('employeeDashboard');
        } else {
            //niezalogowany => pozostań na stronie logowania
            $this->generateEmployeeLoginForm();
        }
    }

    public function action_employeeLogout()
    {
        session_destroy();
        Utils::addInfoMessage('Zostałeś wylogowany.');
        App::getRouter()->redirectTo('generateEmployeeLoginForm');
    }

    public function action_generateEmployeeLoginForm()
    {
        $this->generateEmployeeLoginForm();
    }

    public function generateEmployeeLoginForm()
    {
        App::getSmarty()->assign('loginForm', $this->employeeForm); // dane formularza do widoku
        App::getSmarty()->display('login/employeeLoginForm.tpl');
    }

    public function action_employeeDashboard()
    {
        App::getSmarty()->display('mainEmployeePage.tpl');
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
        App::getSmarty()->display('common_elements/tables/patientTable.tpl');
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
        App::getSmarty()->display('common_elements/tables/employeesTable.tpl');
    }
}
