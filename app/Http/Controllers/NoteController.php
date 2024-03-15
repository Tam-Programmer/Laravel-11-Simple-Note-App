<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //  $notes = Note::query()->latest()->paginate(10);
        $notes = Note::query()
        //filter notes based on currently authenticated user
        ->where('user_id', request()->user()->id)
        ->orderBy('created_at','desc')->paginate(12);
        // dd($notes);
        // return view("note.index",compact('notes'));
        return view("note.index",['notes'=>$notes]);// associative array
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    //
       return view('note.create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'note' => ['required', 'string']
        ]);
        //authenticate user
        $data['user_id'] = $request->user()->id;
        $note = Note::create($data);

        return to_route('note.show', $note)->with('message', 'Note created');

    }

    /**
     * Display the specified resource.
     */
    public function show(Note $note)
    {
        //authenticate  user  and check if it is owner of note
        //only authenticated users can see their own notes
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        return view('note.show',['note'=>$note]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }
        return view('note.edit',['note'=>$note]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }

        $data = $request->validate([
            'note' => ['required', 'string']
        ]);

        $note->update($data);

        return redirect()->route('note.show', $note)->with('message', 'Note updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Note $note)
    {
        if ($note->user_id !== request()->user()->id) {
            abort(403);
        }

        $note->delete();
        // return redirect()->back()->with('message','note deleted successfully');
        return redirect()->route('note.index')->with('message', 'Note deleted');
    }
}
