<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('dashboard'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('dashboard', 'MainPageController');

//Utils::addRoute('action_name', 'controller_class_name');
Utils::addRoute('employeeLogin', 'EmployeeController');
Utils::addRoute('employeeLogout', 'EmployeeController');
Utils::addRoute('showEmployeeLoginForm', 'EmployeeController');

Utils::addRoute('showPatientLoginForm', 'PatientController');
Utils::addRoute('patientLogin', 'PatientController');
Utils::addRoute('patientLogout', 'PatientController');


Utils::addRoute('registerPatient', 'PatientRegistrationController');
Utils::addRoute('registerShowForm', 'PatientRegistrationController');

Utils::addRoute('patientDashboard', 'PatientController');
Utils::addRoute('employeeDashboard', 'EmployeeController');
Utils::addRoute('displayEmployeeTable', 'EmployeeController');
Utils::addRoute('displayPatientsTable', 'EmployeeController');

Utils::addRoute('showAppointments', 'AppointmentController');
Utils::addRoute('showAddAppointmentForm', 'AppointmentController');

Utils::addRoute('generateEmployeeRegisterForm', 'AdminController');
Utils::addRoute('registerEmployee', 'AdminController');
Utils::addRoute('editEmployee', 'AdminController');
Utils::addRoute('employeeSave', 'AdminController');
Utils::addRoute('employeeDelete', 'AdminController',['admin']);


