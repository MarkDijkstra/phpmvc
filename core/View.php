<?php

namespace Core;

class View 
{
    /**
     * The render method.
     *
     * @param string $view A string representation of page template.
     * @param array $params A array of the controller variables.
     * @return void
     */
    static function render(string $view, array $params = []) : void 
    {
        extract($params, EXTR_SKIP);
        $content = APPLICATION_PATH . "/app/Views/$view.php";

        if (is_readable($content)) {
            require_once APPLICATION_PATH . "/app/Views/layout/base.php";            
        } else {            
            throw new \Exception("View $view not found");
        }
    }

    /**
     * The error render method.
     * 
     * @param array $params A array of the controller variables.
     * @return array  The route details.
     */
    static function renderError(array $params) : void 
    {
        extract($params, EXTR_SKIP);
        $content = APPLICATION_PATH . "/App/Views/layout/error.php"; 

        if (is_readable($content)) {            
            require_once $content;            
        } else {            
            throw new \Exception("View ERROR not found");
        }
    }
}