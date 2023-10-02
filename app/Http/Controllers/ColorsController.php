<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorsController extends Controller
{
    //Listar Color
    public function index()
    {
        //ORM Eloquent
        $colors = Color::all();
        //select * from providers
        //me retorna la información en formato json
        return view('colors.index', compact('colors'));
    }

    //guardar datos y retornar colores
    public function store(Request $request)
    {


        Color::create($request->all());
        return redirect()->route('colores')->with('message', 'success', 'Color creado correctamente');
    }
    //Eliminar--> retorno vista colores
    public function destroy($id)
    {
        Color::find($id)->delete();
        return redirect()->route('colores');
    }
    //mostrar detalles
    public function show($id)
    {
        $color = Color::find($id);
        return view('colors.show', compact('color'));
    }
    //editar
    public function edit($id)
    {
        $color = Color::find($id);

        return view('colors.edit', compact('color'));
    }
    //editar status
    public function editStatus($id)
    {
        $color = Color::find($id);

        if ($color->status === 'active') {

            Color::find($id)->update(["status" => "inactive"]);
        } else {
            Color::find($id)->update(["status" => "active"]);
        }

        return redirect()->route('colores');
    }
    //actualizar
    public function update(Request $request, $id)
    {

        $color = Color::find($id)->update($request->all());
        return redirect()->route('colores')->with('message', 'Color actualizado correctamente');;
    }
}
