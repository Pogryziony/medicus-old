<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('dashboard'); #default action
App::getRouter()->setLoginRoute('showPatientLoginForm'); #action to forward if no permissions

Utils::addRoute('dashboard', 'MainPageController');

Utils::addRoute('generateEmployeeRegisterForm', 'AdminController',['admin']);
Utils::addRoute('registerEmployee', 'AdminController',['admin']);
Utils::addRoute('editEmployee', 'AdminController',['admin']);
Utils::addRoute('saveEmployee', 'AdminController',['admin']);
Utils::addRoute('deleteEmployee', 'AdminController',['admin']);

Utils::addRoute('generatePatientSelfRegistrationView', 'AdminController');
Utils::addRoute('generateAdminPatientRegistrationView', 'AdminController',['admin','user']);
Utils::addRoute('registerPatient', 'AdminController',['admin','user']);
Utils::addRoute('editPatient', 'AdminController',['admin','user']);
Utils::addRoute('savePatient', 'AdminController',['admin','user']);
Utils::addRoute('deletePatient', 'AdminController',['admin','user']);

Utils::addRoute('generateEmployeeLoginForm', 'EmployeeController');
Utils::addRoute('employeeLogin', 'EmployeeController');
Utils::addRoute('employeeLogout', 'EmployeeController');
Utils::addRoute('employeeDashboard', 'EmployeeController');
Utils::addRoute('displayEmployeeTable', 'EmployeeController');
Utils::addRoute('displayPatientsTable', 'EmployeeController');

Utils::addRoute('showPatientLoginForm', 'PatientController');
Utils::addRoute('patientLogin', 'PatientController');
Utils::addRoute('patientLogout', 'PatientController');
Utils::addRoute('patientDashboard', 'PatientController');
Utils::addRoute('patientDashboard', 'PatientController');

Utils::addRoute('displayAllAppointments', 'AppointmentController');
Utils::addRoute('displayEmployeeAppointments', 'AppointmentController');
Utils::addRoute('displayPatientAppointments', 'AppointmentController');
Utils::addRoute('showAppointments', 'AppointmentController');
Utils::addRoute('generateAddAppointmentForm', 'AppointmentController',['admin','user']);
Utils::addRoute('registerAppointment', 'AppointmentController',['admin','user']);
Utils::addRoute('editAppointment', 'AppointmentController',['admin','user']);



