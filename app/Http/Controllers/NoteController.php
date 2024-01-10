<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Note;

class NoteController extends Controller
{
    //
    public function create(Request $request) {
        $note = new Note();
        $note->content = $request->contenuDeLaNote;
        $note->save();
        
        return response()->json($note, 201);
    }

    public function update(Request $request, $id) {
        $note = Note::find($id);
        if (is_null($note)) {
            return response()->json(['error' => 'not found'], 404);
        }

        $note->content = $request->content;
        $note->save();

        return response()->json($note, 200);
    }

    public function list() {
        $notes = Note::get();
        return response()->json([
            "result" => $notes,
            "total" => $notes->count()
        ]);
    }

    public function get($id) {
        $note = Note::find($id);
        if (is_null($note)) {
            return response()->json(['error' => 'not found'], 404);
        }
        return response()->json($note, 200);
    }
}
