<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Element;
use Illuminate\Http\Request;

class ElementController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

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
            $element = Element::where('name', 'LIKE', "%$keyword%")
                ->orWhere('type_id', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $element = Element::latest()->paginate($perPage);
        }

        return view('element.index', compact('element'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $types = \App\Type::pluck('profile', 'id');
        return view('element.create', compact('types'));
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
            'name' => 'required',
            'type_id' => 'required'
        ], [
            'name.required' => 'O nome é requerido.',
            'type_id.required' => 'O campo tipo é requerido.'
        ]);
        $requestData = $request->all();

        Element::create($requestData);

        return redirect('element')->with('flash_message', 'Element added!');
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
        $element = Element::findOrFail($id);

        return view('element.show', compact('element'));
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
        $element = Element::findOrFail($id);

        return view('element.edit', compact('element'));
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
            'name' => 'required',
            'type_id' => 'required'
        ], [
            'name.required' => 'O nome é requerido.',
            'type_id.required' => 'O campo tipo é requerido.'
        ]);
        $requestData = $request->all();

        $element = Element::findOrFail($id);
        $element->update($requestData);

        return redirect('element')->with('flash_message', 'Pessoa atualizada!');
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
        $relation_occurrency = \DB::table('occurrence_elements')->where('element_id', $id)->first();

        $relation_condominiun = \DB::table('element_condominia')->where('element_id', $id)->first();

        if($relation_occurrency):
            \Session::flash('info', "Esta pessoa não pode ser deletada por estar relacionada à ocorrência {$relation_occurrency->occurrence_id}.");
        elseif($relation_condominiun):
            \Session::flash('info', "Esta pessoa não pode ser deletada por estar vinculada ao apartamento {$relation_condominiun->condominium_id}.");
        else:
            Element::destroy($id);
        endif;

        return redirect('element');
    }
}
