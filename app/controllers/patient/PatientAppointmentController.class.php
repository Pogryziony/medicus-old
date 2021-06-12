<?php

namespace app\controllers\patient;

use app\forms\appointment\AppointmentForm;
use app\forms\employee\EmployeeForm;
use app\forms\patient\PatientRegisterForm;
use core\App;
use core\ParamUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;
use PDOException;

class PatientAppointmentController
{
    protected $appointmentForm;
    protected $employeeForm;
    protected $patientRegisterForm;

    public function __construct()
    {
        $this->appointmentForm = new AppointmentForm();
        $this->employeeForm = new EmployeeForm();
        $this->patientRegisterForm = new PatientRegisterForm();
    }


    public function action_displayPatientAppointments()
    {
        $this->displayPatientAppointments();
    }

    private function displayPatientAppointments()
    {
        $patientAppointments = array();
        $patientData = SessionUtils::loadObject('patientData', true);
        $this->patientRegisterForm->pesel = $patientData->pesel;
        try {
            $patientAppointments = App::getDB()->select(
                "appointment",
                "*",
                [
                    "pesel_patient" => $this->patientRegisterForm->pesel
                ]
            );
        } catch (PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug) {
                Utils::addErrorMessage($e->getMessage());
            }
        }
        App::getSmarty()->assign('patientAppointments', $patientAppointments);
        App::getSmarty()->display("common_elements/tables/patientAppointmentTable.tpl");
    }


}