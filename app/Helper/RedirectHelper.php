<?php
namespace App\Helper;
use Brian2694\Toastr\Facades\Toastr;

class RedirectHelper{
    public static function redirectRouteStatus(string $route, string $element, string $message){
        return redirect()->route($route)->with(Toastr::$element($message, ucfirst($element)));

    }

    public static function redirectBackStatus(string $element, string $message){
        return redirect()->back()->with(Toastr::$element($message, ucfirst($element)));
    }
}

