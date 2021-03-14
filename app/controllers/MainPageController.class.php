<?php

namespace app\controllers;

use core\App;

class MainPageController
{

    public function action_dashboard()
    {
        App::getSmarty()->display("mainPage.tpl");
    }
}