<?php

namespace App\Controller;

// getting the core file
require_once(dirname(dirname(__DIR__)) . "/Core/config.php");


abstract class Controller
{

    protected $root_dir = \ROOT_DIR;
}
