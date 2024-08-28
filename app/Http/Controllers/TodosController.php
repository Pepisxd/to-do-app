<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Todo;
use App\Models\Category;

class TodosController extends Controller
{
    /**
     * index para mostrar todos los Todoes
     * store para guardar un todo
     * update para actualizar un todo
     * destroy para eliminar un todo
     * edit para mostrar un formulario de edición
     */

     public function store(Request $request){
        $request->validate([
           'title' => 'required|min:3'
        ]);

        $todo = new Todo;
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return redirect()->route('todos')->with('success', 'Tarea creada correctamente');
    }

    public function index(){
        $todos = Todo::all();
        $categories = Category::all();
        return view('todoes.index',[ 'todos' => $todos, 'categories' => $categories ]);
    }

    public function show($id){
        $todo = Todo::find($id);
        return view('todoes.show',[ 'todo' => $todo ]);
    }

    public function update(Request $request, $id){
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->save();

        //return view('todoes.index',[ 'todos' => $todos ]);
        return redirect()->route('todos')->with('success', 'Tarea actualizada correctamente');
    }



    public function destroy($id){
        $todos = Todo::find($id);
        $todos->delete();
        return redirect()->route('todos')->with('success', 'Tarea eliminada');

    }
}
