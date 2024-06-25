<?php

namespace App\Http\Controllers;

use App\Http\Requests\Sala\StoreSalaRequest;
use App\Http\Requests\Sala\UpdateSalaRequest;
use App\Models\Patrimonio;
use App\Models\Predio;
use App\Models\Sala;
use App\Models\UnidadeAdministrativa;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    public function index($predio_id)
    {
        $predio = Predio::find($predio_id);
        $salas = $predio->salas()->orderBy('id')->paginate(10);

        return view('sala.index', compact('salas', 'predio'));
    }

    public function create($predio_id)
    {
        $predio = Predio::find($predio_id);
        return view('sala.create', compact('predio'));
    }

    public function store(StoreSalaRequest $request)
    {
        Sala::create($request->all());

        return redirect()->route('sala.index', ['predio_id' => $request->predio_id])->with('success', 'Sala Cadastrada com Sucesso!');
    }

    public function edit($sala_id)
    {
        $sala = Sala::find($sala_id);
        $predio = $sala->predio;
        return view('sala.edit', compact('sala', 'predio'));
    }

    public function update(UpdateSalaRequest $request, $id)
    {
        Sala::find($id)->update($request->all());

        return redirect()->route('sala.index', ['predio_id' => $request->predio_id])->with('success', 'Sala Editada com Sucesso!');
    }

    public function delete($sala_id)
    {
        $sala = Sala::find($sala_id);
        if (!$sala->patrimonios()->exists() &&
            !$sala->users()->exists() &&
            !UnidadeAdministrativa::whereHas('salas', function ($query) use ($sala_id){
                $query->where('sala_id', $sala_id);
            })->exists())
        {
            $sala->delete();

            return redirect(route('sala.index', ['predio_id' => $sala->predio_id]))->with('success', 'Sala Removida com Sucesso!');
        } else {
            return redirect(route('sala.index', ['predio_id' => $sala->predio_id]))->with('fail', 'Não é possível remover a sala, há dependências relacionadas.');
        }
    }

    public function search(Request $request)
    {
        $salas = Sala::where('nome', 'ilike', "%$request->busca%")->paginate(10);

        return view('sala.index', compact('salas'));
    }
}
