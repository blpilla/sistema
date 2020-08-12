<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Condominium;
use Illuminate\Http\Request;

class CondominiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $condominium = Condominium::where('tower', 'LIKE', "%$keyword%")
                ->orWhere('ap', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $condominium = Condominium::latest()->paginate($perPage);
        }

        return view('condominium.index', compact('condominium'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $towers = [1 => 1, 2 => 2];
        return view('condominium.create', compact('towers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'tower' => 'required',
            'ap' => 'required'
        ], [
            'tower.required' => 'O campo Torre é requerido.',
            'ap.required' => 'O campo Apartamento é requerido.'
        ]);
        $requestData = $request->all();

        Condominium::create($requestData);

        return redirect('condominium')->with('flash_message', 'Condominium added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $condominium = Condominium::findOrFail($id);

        return view('condominium.show', compact('condominium'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $condominium = Condominium::findOrFail($id);

        return view('condominium.edit', compact('condominium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tower' => 'required',
            'ap' => 'required'
        ], [
            'tower.required' => 'O campo Torre é requerido.',
            'ap.required' => 'O campo Apartamento é requerido.'
        ]);
        $requestData = $request->all();

        $condominium = Condominium::findOrFail($id);
        $condominium->update($requestData);

        return redirect('condominium')->with('flash_message', 'Apartamento atualizado');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $relation = \DB::table('element_condominia')->where('condominium_id', $id)->first();

        if($relation):
            \Session::flash('info', "Este apartamento não pode ser deletado por estar registrado para a pessoa {$relation->element_id}.");
        else:
            Condominium::destroy($id);
        endif;

        return redirect('condominium');
    }
}
