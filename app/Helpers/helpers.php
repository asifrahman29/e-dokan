<?php
if (!function_exists('dp')) {
    function dp($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
        die();
    }
}

if (!function_exists('dpr')) {
    function dpr($var)
    {
        var_dump('<pre>'.$var.'</pre>');
        die();
    }
}
