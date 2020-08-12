<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Occurrence;
use Illuminate\Http\Request;

class OccurrenceController extends Controller
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
            $occurrence = Occurrence::where('date', 'LIKE', "%$keyword%")
                ->orWhere('occurred', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $occurrence = Occurrence::latest()->paginate($perPage);
        }

        return view('occurrence.index', compact('occurrence'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('occurrence.create');
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
            'occurred' => 'required'
        ], [
            'occurred.required' => 'É necesário informar o ocorrido.'
        ]);
        $requestData = $request->all();

        Occurrence::create($requestData);

        return redirect('occurrence')->with('flash_message', 'Occurrence added!');
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
        $occurrence = Occurrence::findOrFail($id);

        return view('occurrence.show', compact('occurrence'));
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
        $occurrence = Occurrence::findOrFail($id);

        return view('occurrence.edit', compact('occurrence'));
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
            'date' => 'required',
            'occurred' => 'required'
        ], [
            'date.required' => 'É necessário informar a data da ocorrência.',
            'occurred.required' => 'O campo ocorrido é requerido.'
        ]);
        $requestData = $request->all();

        $occurrence = Occurrence::findOrFail($id);
        $occurrence->update($requestData);

        return redirect('occurrence')->with('flash_message', 'Occurrence updated!');
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
        Occurrence::destroy($id);

        return redirect('occurrence')->with('flash_message', 'Occurrence deleted!');
    }
}
