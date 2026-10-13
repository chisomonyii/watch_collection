<?php

namespace App\Helpers;

require_once(dirname(dirname(__DIR__)) . "/Core/config.php");

abstract class Helper
{
    protected string $root_dir = ROOT_DIR;
}
