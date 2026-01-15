<?php

namespace App\Http\Controllers;

use App\Models\Executive;
use Illuminate\Http\Request;

class ExecutiveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $executives = Executive::orderBy('status', 'desc')->get();

        return (view('backend.people.executive', compact('executives')));
    }

    /**
     * Show the form for creating a new resource.
    
     * Remove the specified resource from storage.
     */
    public function statusUpdate(Request $request)
    {
        $executive = executive::findOrFail($request->id);
        $executive->status = $request->status;
        $executive->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated'
        ]);
    }
}
