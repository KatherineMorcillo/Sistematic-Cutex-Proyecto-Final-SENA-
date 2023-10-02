<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Lab404\Impersonate\Services\ImpersonateManager;
use Illuminate\Support\Facades\Auth;


class ImpersonationController extends Controller
{
    public function start(User $user)
    {

        //dd($user);

        // Guarda la ID del usuario actual antes de impersonar
        session(['admin_user_id' => Auth::id()]);

        // Autentica como el usuario seleccionado
        Auth::guard('web')->login($user);

        return redirect()->route('usuarios');
    }
    public function stop()
    {
    }
}
