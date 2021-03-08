<?php

use core\App;
use core\SessionUtils;

require_once 'init.php';

require_once 'routing.php';

SessionUtils::loadMessages();

App::getRouter()->go();