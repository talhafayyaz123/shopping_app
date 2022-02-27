<?php

    function areActiveRoutes(Array $routes, $output = "menu-item-active")
    {
        foreach ($routes as $route)
        {
            if (\Illuminate\Support\Facades\Route::currentRouteName() == $route) return $output;
        }

    }
