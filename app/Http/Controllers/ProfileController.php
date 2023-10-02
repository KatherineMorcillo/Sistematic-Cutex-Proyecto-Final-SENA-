<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;


class ProfileController extends Controller
{
    public function index()
    {

        $user = auth()->user();
        return view('profileuser.index', compact('user'));
    }

    //Actualizar
    public function update(Request $request, $id)
    {
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Usuario actualizado correctamente');

        $user = User::find($id)->update($request->all());
        return redirect()->route('perfil')->with('message', session('success'));;
    }
}
