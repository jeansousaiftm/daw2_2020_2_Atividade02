<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Especie;

class EspecieController extends Controller
{

    public function index()
    {
        $especie = new Especie();
		$especies = Especie::All();
		return view("especie.index", [
			"especie" => $especie,
			"especies" => $especies
		]);
    }


    public function store(Request $request)
    {
        if ($request->get("id") != "") {
			$especie = Especie::find($request->get("id"));
		} else {
			$especie = new Especie();
		}
		
		$especie->descricao = $request->get("descricao");
		$especie->save();
		
		$request->session()->flash("salvar", "Salvo com sucesso!");
		
		return redirect("/especie");
    }

    public function edit($id)
    {
        $especie = Especie::find($id);
		$especies = Especie::All();
		return view("especie.index", [
			"especie" => $especie,
			"especies" => $especies
		]);
    }
	
    public function destroy(Request $request, $id)
    {
        Especie::destroy($id);
		
		$request->session()->flash("excluir", "Excluído com sucesso!");
		
		return redirect("/especie");
    }
}
