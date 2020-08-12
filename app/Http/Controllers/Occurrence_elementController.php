<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Occurrence_element;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;

class Occurrence_elementController extends Controller
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
        $occurrence_id = request()->segment(count(request()->segments()));
        $perPage = 25;

        if (!empty($occurrence_id)) {
            $occurrence_element = Occurrence_element::where('occurrence_id', 'LIKE', "%$occurrence_id%")
                ->latest()->paginate($perPage);
        } else {
            $occurrence_element = Occurrence_element::latest()->paginate($perPage);
        }

        return view('occurrence_element.index', compact('occurrence_element', 'occurrence_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($occurrence_id = null)
    {
        $elements = \App\Element::pluck('name', 'id');
        return view('occurrence_element.create', compact('occurrence_id', 'elements'));
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
                Rule::unique('occurrence_elements')->where(function ($query) use ($request) {
                    $query->where('occurrence_id', $request->occurrence_id);})
            ],
            'occurrence_id' => [
                'required',
            ]
        ]);

        if(!$validator->fails())
            Occurrence_element::create($request->all());

        return redirect('occurrence/'.$request->occurrence_id);
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
        $occurrence_element = Occurrence_element::findOrFail($id);

        return view('occurrence_element.show', compact('occurrence_element'));
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
        $occurrence_element = Occurrence_element::findOrFail($id);

        return view('occurrence_element.edit', compact('occurrence_element'));
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

        $occurrence_element = Occurrence_element::findOrFail($id);
        $occurrence_element->update($requestData);

        return redirect('occurrence_element')->with('flash_message', 'Occurrence_element updated!');
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
        Occurrence_element::destroy($id);

        return redirect('occurrence/');
    }
}
