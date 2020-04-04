<?php

namespace Core;

use Exception;

// assists in template creation
abstract class View
{
    // purpose of this function is to not cause errors if variable was not provided
    public static function output(&$variable) {
        return isset($variable) ? $variable : false;
    }

    // renders view
    public static function render($viewName, $variables) {
        $view = dirname(__DIR__) . "/Application/View/" . $viewName . ".php";

        if (!is_readable($view)) {
            throw new Exception("View: " . $viewName . ", does not exist!");
        }

        extract($variables);
        require $view;
    }

    // captures view into variable
    public static function capture($viewName, $variables) {
        ob_start();
        View::render($viewName, $variables);
        return ob_get_clean();
    }
}
