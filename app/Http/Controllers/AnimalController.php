<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especie;
use App\Models\Animal;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AnimalController extends Controller
{

    public function index()
    {
        $animal = new Animal();		
		
		$animais = DB::table("animal AS a")
						->join("especie AS e", "a.especie", "=", "e.id")
						->select("a.id", "a.nome", "a.idade", "e.descricao AS especie")
						->get();
		
		$especies = Especie::All();
		
		return view("animal.index", [
			"animal" => $animal,
			"animais" => $animais,
			"especies" => $especies
		]);
    }


    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$animal = Animal::find($request->get("id"));
		} else {
			$animal = new Animal();
		}
		
		$animal->nome = $request->get("nome");
		$animal->dono = $request->get("dono");
		$animal->raca = $request->get("raca");
		$animal->nascimento = $request->get("nascimento");
		$animal->especie = $request->get("especie");
		
		$animal->idade = Carbon::parse($animal->nascimento)->age;
		
		$animal->save();
		
		$request->session()->flash("salvar", "Salvo com sucesso!");
		
		return redirect("/animal");
    }

    public function edit($id)
    {
        $animal = Animal::find($id);
		
		$animais = DB::table("animal AS a")
						->join("especie AS e", "a.especie", "=", "e.id")
						->select("a.id", "a.nome", "a.idade", "e.descricao AS especie")
						->get();
						
		$especies = Especie::All();
		
		return view("animal.index", [
			"animal" => $animal,
			"animais" => $animais,
			"especies" => $especies
		]);
    }
	
    public function destroy(Request $request, $id)
    {
        Animal::destroy($id);
		
		$request->session()->flash("excluir", "Excluído com sucesso!");
		
		return redirect("/animal");
    }
}
