<?php

namespace LogoStore\Http\Controllers\Admin;

use Illuminate\Support\Facades\Session;

trait RedirectWithSessionMessage
{
    public function redirectWithFlashMessage($message, $ajax, $route)
    {
        if($ajax) {
            return response()->json([
                'message' => $message
            ]);
        }
        Session::flash('message', $message);
        return $route;
    }
}