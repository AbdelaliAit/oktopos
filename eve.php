<?php
session_start();

/*define('SERVER','localhost');

define('DATABASE','vysxjegt_belivehotels');

define('USER','vysxjegt_belivehotels_user');

define('PASSWORD','~p#vWQN%IWM-');*/


define('SERVER','localhost');
define('DATABASE','oktopos');
define('USER','root');
define('PASSWORD','');
define('BASE_URL','http://localhost/oktopos/');



spl_autoload_register(function($class_name) {

    include 'model/' . $class_name . '.php';

});
 





?>