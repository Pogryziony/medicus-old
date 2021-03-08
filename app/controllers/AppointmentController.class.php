<?php

namespace app\controllers;

use app\forms\appointment\AppointmentForm;
use core\App;
use core\ParamUtils;
use core\SessionUtils;
use core\Utils;
use core\Validator;


class AppointmentController {
    private $form;
    private $currentYear;
    private $currentMonth;
    private $months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
    private $monthsPl = ["Styczeń", "Luty", "Marzec", "Kwiecień", "Maj", "Czerwiec", "Lipiec", "Sierpień", "Wrzesień",
        "Październik", "Listopad", "Grudzień"];

    public function __construct() {
        $this->form = new AppointmentForm();
        $this->currentYear = date("Y");
        $this->currentMonth = date("M");
    }

    private function getMonthAppointments($year=null, $id=null) {

        $appointments = array();
        // if year and month parameters are provided get entries from exact month and year
        // else get entries from current month and year
        if(isset($year) && is_numeric($year) && isset($id) && in_array($id, $this->id)) {
            $appointments = App::getDB()->select("appointment", "*", [
                "id"=>$id,
                "year"=>$year,
                "user_uuid"=>SessionUtils::load("userUuid", true),
                "ORDER"=>"from_date"
            ]);
        } else {
            $appointments = App::getDB()->select("work_hour_entry", "*", [
                "user_uuid"=>SessionUtils::load("userUuid", true)
            ]);
        }
        return $appointments;
    }

    public function action_showAppointments() {
        try {
            $this->appointments = App::getDB()->select('appointment', '*');
        } catch (\PDOException $e) {
            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
            if (App::getConf()->debug)
                Utils::addErrorMessage($e->getMessage());
        }
        App::getSmarty()->assign('appointments', $this->appointments);
        App::getSmarty()->display("common_elements/tables/appointmentTable.tpl");
    }

//    public function action_displayEmployeeAppointments() {
//        try {
//            $this->appointments = App::getDB()->select('appointment',[], '*',[]);
//        } catch (\PDOException $e) {
//            Utils::addErrorMessage('Wystąpił błąd podczas odczytu rekordu');
//            if (App::getConf()->debug)
//                Utils::addErrorMessage($e->getMessage());
//        }
//        App::getSmarty()->assign('appointments', $this->appointments);
//        App::getSmarty()->display("appointment/appointmentTable.tpl");
//    }

    public function action_showEntriesForMonth() {
        $dateFrom = ParamUtils::getFromGet("date_from");
        if (isset($dateFrom) && $dateFrom != "") {
            $v = new Validator();
            $dateFrom = $v->validate($dateFrom, [
                "required"=>"true",
                "required_message"=>'Data jest wymagana przy wyborze miesiąca',
                "date_format"=>"Y-m",
                "validator_message"=>'Niepoprawny format daty (wymagany: YYYY-mm)'
            ]);
            if ($v->isLastOK()) {
                $inputDate = $this->getYearAndMonth($dateFrom);
                $year = $inputDate[0];
                $month = $inputDate[1];
                $this->renderMonthEntriesTable($year, $month);
                exit();
            }
        }
        $this->renderChooseEntryMonth();
    }

    private function renderChooseEntryMonth() {
        App::getSmarty()->assign("description", "Wybierz miesiąc");
        App::getSmarty()->display("common_elements/chooseDate.tpl");
    }

    public function action_showAddAppointmentForm() {
        App::getSmarty()->assign("description", "Dodaj wizytę");
        App::getSmarty()->display("admin/registration/addAppointmentForm.tpl");
    }

    private function showEditAppointmentForm($entryUuid) {
        App::getSmarty()->assign("description", "Edytuj wizytę");
        App::getSmarty()->assign("appointment", $this->getAppointments($id));
        App::getSmarty()->display("editEntryForm.tpl");
    }


}

