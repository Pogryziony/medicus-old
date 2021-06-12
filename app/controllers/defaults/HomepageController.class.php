<?php

namespace app\controllers\defaults;

use core\App;

class HomepageController
{
    public function action_dashboard()
    {
        App::getSmarty()->display("homepage.tpl");
    }
}