<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Element_condominium;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Element_condominiumController extends Controller
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
        $element_id = request()->segment(count(request()->segments()));
        $perPage = 25;

        if (!empty($element_id)) {
            $element_condominium = Element_condominium::where('element_id', 'LIKE', "%$element_id%")
                ->latest()->paginate($perPage);
        } else {
            $element_condominium = Element_condominium::latest()->paginate($perPage);
        }

        return view('element_condominium.index', compact('element_condominium', 'element_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $element_id = request()->segment(count(request()->segments()));

        $condominium_list = \App\Condominium::select('id', \DB::raw("CONCAT('Torre ', tower, ' - Ap ', ap) as unity"))->pluck('unity', 'id')->all();

        return view('element_condominium.create', compact('element_id', 'condominium_list'));
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
        $validator = Validator::make($request->all(), [
            'element_id' => [
                'required',
                Rule::unique('element_condominia')->where(function ($query) use ($request) {
                    $query->where('condominium_id', $request->condominium_id);})
            ],
            'condominium_id' => [
                'required',
            ]
        ]);

        if(!$validator->fails())
            Element_condominium::create($request->all());

        return redirect('element/'.$request->element_id);
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
        $element_condominium = Element_condominium::findOrFail($id);

        return view('element_condominium.show', compact('element_condominium'));
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
        $element_condominium = Element_condominium::findOrFail($id);

        return view('element_condominium.edit', compact('element_condominium'));
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

        $requestData = $request->all();

        $element_condominium = Element_condominium::findOrFail($id);
        $element_condominium->update($requestData);

        return redirect('element_condominium')->with('flash_message', 'Element_condominium updated!');
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
        Element_condominium::destroy($id);

        return redirect('element');
    }
}
