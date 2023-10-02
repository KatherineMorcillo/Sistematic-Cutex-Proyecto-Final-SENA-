<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Document;
use App\Models\Role;
use App\Models\Company;

class UsersController extends Controller
{
    ///listar Usuario
    public function index()
    {
        //ORM Eloquent
        $users = User::all();
        $documents = Document::all();
        $roles = Role::all();
        $companies = Company::all();
        //select * from providers
        //me retorna la información en formato json
        return view('users.index', compact('users', 'documents', 'roles', 'companies'));
    }
    //crear
    // public function create()
    // {
    //     return view('providers.create');
    // }
    //(guardar datos y retornar usuarios)
    public function store(Request $request)
    {
        $email = $request['email'];

        $existUser = User::query()
            ->where('email', '=', $email)
            ->get();

        if (count($existUser) > 0) {
            session()->flash('error', 'Email ya registrado');
            return redirect()->route('usuarios')->with('message', session('error'));
        }
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Usuario creado correctamente');

        User::create($request->all());
        return redirect()->route('usuarios')->with('message', session('success'));
    }
    //Eliminar--> retorno vista proveedores
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect()->route('usuarios');
    }
    //mostrar detalles
    public function show($id)
    {
        $roles = Role::all();
        $user = User::find($id);
        $documents = Document::all();
        $companies = Company::all();
        return view('users.show', compact('user', 'documents', 'roles', 'companies'));
    }
    //editar
    public function edit($id)
    {
        $companies = Company::all();
        $roles = Role::all();
        $user = User::find($id);
        $documents = Document::all();

        return view('users.edit', compact('user', 'documents', 'roles', 'companies'));
    }
    //editar status
    public function editStatus($id)
    {
        $user = User::find($id);

        if ($user->status === 'active') {
            User::find($id)->update(["status" => "inactive"]);
        } else {
            User::find($id)->update(["status" => "active"]);
        }

        return redirect()->route('usuarios');
    }
    //actualizar
    public function update(Request $request, $id)
    {
        // Guarda un mensaje de éxito en la sesión
        session()->flash('success', 'Usuario actualizado correctamente');

        $user = User::find($id)->update($request->all());
        return redirect()->route('usuarios')->with('message', session('success'));;
    }
}
