<?php

use core\App;
use core\Utils;

App::getRouter()->setDefaultRoute('dashboard'); #default action
App::getRouter()->setLoginRoute('login'); #action to forward if no permissions

Utils::addRoute('dashboard', 'MainPageController');

//Utils::addRoute('action_name', 'controller_class_name');
Utils::addRoute('login', 'LoginController');
Utils::addRoute('logout', 'LoginController');