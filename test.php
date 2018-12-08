<?php
/**
 * Created by PhpStorm.
 * User: yajima
 * Date: 2017-10月-21
 * Time: 23:06
 */

session_start();
echo '<pre>';
print_r($_SERVER);
print_r($_SESSION);
print_r($_COOKIE);
echo '</pre>';

phpinfo();