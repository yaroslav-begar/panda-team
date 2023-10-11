<?php

use Controller\A;
use Model\B;
use Model\Database\C;

require_once __DIR__ . '/../autoload.php';
require_once __DIR__ . '/../config/config.php';

$a = new A();
$a->a();

$a = new B();
$a->b();

$c = new C();
$c->c();
