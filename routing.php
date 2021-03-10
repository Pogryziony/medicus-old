<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('dashboard'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('dashboard', 'MainPageController');

Utils::addRoute('registerPatient', 'AdminController');
Utils::addRoute('generatePatientSelfRegistrationView', 'AdminController');
Utils::addRoute('generateAdminPatientRegistrationView', 'AdminController');
Utils::addRoute('generateEmployeeRegisterForm', 'AdminController');
Utils::addRoute('registerEmployee', 'AdminController');
Utils::addRoute('editEmployee', 'AdminController');
Utils::addRoute('saveEmployee', 'AdminController');
Utils::addRoute('deleteEmployee', 'AdminController');

Utils::addRoute('showEmployeeLoginForm', 'EmployeeController');
Utils::addRoute('employeeLogin', 'EmployeeController');
Utils::addRoute('employeeLogout', 'EmployeeController');
Utils::addRoute('employeeDashboard', 'EmployeeController');
Utils::addRoute('displayEmployeeTable', 'EmployeeController');
Utils::addRoute('displayPatientsTable', 'EmployeeController');

Utils::addRoute('showPatientLoginForm', 'PatientController');
Utils::addRoute('patientLogin', 'PatientController');
Utils::addRoute('patientLogout', 'PatientController');
Utils::addRoute('patientDashboard', 'PatientController');




Utils::addRoute('displayAllAppointments', 'AppointmentController');
Utils::addRoute('displaySelfEmployeeAppointments', 'AppointmentController');
Utils::addRoute('displaySelfPatientAppointments', 'AppointmentController');
Utils::addRoute('showAppointments', 'AppointmentController');
Utils::addRoute('generateAddAppointmentForm', 'AppointmentController');
Utils::addRoute('registerNewAppointment', 'AppointmentController');
Utils::addRoute('editAppointment', 'AppointmentController');



