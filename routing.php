<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('dashboard'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('dashboard', 'MainPageController');

//Utils::addRoute('action_name', 'controller_class_name');
Utils::addRoute('doctorLogin', 'DoctorLoginController');
Utils::addRoute('doctorLogout', 'DoctorLoginController');
Utils::addRoute('showDoctorLoginForm', 'DoctorLoginController');

Utils::addRoute('showPatientLoginForm', 'PatientLoginController');
Utils::addRoute('patientLogin', 'PatientLoginController');

Utils::addRoute('registerPatient', 'PatientRegistrationController');
Utils::addRoute('registerShowForm', 'PatientRegistrationController');

Utils::addRoute('patientDashboard', 'PatientModuleController');
Utils::addRoute('doctorDashboard', 'DoctorModuleController');
