<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('dashboard'); #defaults action
App::getRouter()->setLoginRoute('patientLogin'); #action to forward if no permissions

Utils::addRoute('dashboard', 'defaults\HomepageController');

Utils::addRoute('patientLogin', 'login\PatientLoginController');
Utils::addRoute('patientLogout', 'login\PatientLoginController');

Utils::addRoute('patientDashboard', 'patient\PatientHomepageController');

Utils::addRoute('patientAppointments', 'patient\PatientAppointmentController');
Utils::addRoute('generatePatientSelfRegistrationView', 'patient\PatientRegistrationController');

Utils::addRoute('generateEmployeeRegisterForm', 'admin\AdminEmployeeController',['admin']);
Utils::addRoute('registerEmployee', 'admin\AdminEmployeeController',['admin']);
Utils::addRoute('editEmployee', 'admin\AdminEmployeeController',['admin']);
Utils::addRoute('saveEmployee', 'admin\AdminEmployeeController',['admin']);
Utils::addRoute('deleteEmployee', 'admin\AdminEmployeeController',['admin']);

Utils::addRoute('generateAdminPatientRegistrationView', 'admin\AdminPatientController',['admin','user']);
Utils::addRoute('registerPatient', 'admin\AdminPatientController',['admin','user']);
Utils::addRoute('editPatient', 'admin\AdminPatientController',['admin','user']);
Utils::addRoute('savePatient', 'admin\AdminPatientController',['admin','user']);
Utils::addRoute('deletePatient', 'admin\AdminPatientController',['admin','user']);

Utils::addRoute('editAppointment', 'admin\AdminAppointmentController',['admin','user']);
Utils::addRoute('deleteAppointment', 'admin\AdminAppointmentController',['admin','user']);

// AJAX endpoints
Utils::addRoute('getEntriesAjax', 'employee\EmployeeAppointmentController');
Utils::addRoute('getEntriesAjaxPage', 'employee\EmployeeAppointmentController');


Utils::addRoute('generateEmployeeLoginForm', 'login\EmployeeLoginController');
Utils::addRoute('employeeLogin', 'login\EmployeeLoginController');
Utils::addRoute('employeeLogout', 'login\EmployeeLoginController');
Utils::addRoute('employeeDashboard', 'employee\EmployeeHomepageController');
Utils::addRoute('displayEmployeeTable', 'admin\AdminEmployeeController');
Utils::addRoute('displayPatientsTable', 'admin\AdminPatientController');

Utils::addRoute('showPatientLoginForm', 'patient\PatientLoginController');
Utils::addRoute('patientDashboard', 'patient\PatientHomepageController');

Utils::addRoute('displayAllAppointments', 'admin\AdminAppointmentController');
Utils::addRoute('displayEmployeeAppointments', 'employee\EmployeeAppointmentController');
Utils::addRoute('displayPatientAppointments', 'patient\PatientAppointmentController');
Utils::addRoute('showAppointments', 'employee\EmployeeAppointmentController');
Utils::addRoute('generateAddAppointmentForm', 'employee\EmployeeAppointmentController',['admin','user']);
Utils::addRoute('registerAppointment', 'employee\EmployeeAppointmentController',['admin','user']);



