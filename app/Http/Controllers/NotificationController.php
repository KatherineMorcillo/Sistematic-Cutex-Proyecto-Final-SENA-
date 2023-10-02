<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class NotificationController extends Controller
{

    ///listar notificaciones
    public function index()
    {

        //ORM Eloquent

        // actualizar a leidas las notificaciones

        Notification::where('user_id', Auth::user()->id)->update(['status' => 'read']);

        $notifications = Notification::where('user_id', Auth::user()->id)->get();

        return view('notifications.index', compact('notifications'));
    }

    // contar notificaciones
    public function count()
    {
        $countNotifications = Notification::where('user_id', Auth::user()->id)
            ->where('status', '=', 'send')
            ->count();

        return response()->json(['countNotifications' => $countNotifications]);
    }
}
