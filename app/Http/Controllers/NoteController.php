<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
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
            $note = Note::where('occurrence_id', 'LIKE', "%$occurrence_id%")
                ->latest()->paginate($perPage);
        } else {
            $note = Note::latest()->paginate($perPage);
        }

        return view('note.index', compact('note', 'occurrence_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create($occurrence_id = null)
    {
        return view('note.create', compact('occurrence_id'));
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
            'note' => 'required'
        ], [
            'note.required' => 'É necesário preencher a descrição.'
        ]);
        $requestData = $request->all();

        Note::create($requestData);

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
        $note = Note::findOrFail($id);

        return view('note.show', compact('note'));
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
        $note = Note::findOrFail($id);

        return view('note.edit', compact('note'));
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

        $note = Note::findOrFail($id);
        $note->update($requestData);

        return redirect('note')->with('flash_message', 'Note updated!');
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
        Note::destroy($id);

        return redirect('occurrence/');
    }
}
