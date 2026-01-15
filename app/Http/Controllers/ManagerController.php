<?php

namespace App\Http\Controllers;

use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $managers = Manager::orderBy('status', 'desc')->get();

        return (view('backend.people.manager', compact('managers')));
    }

    /**
     * Show the form for creating a new resource.
    
     * Remove the specified resource from storage.
     */
    public function statusUpdate(Request $request)
    {
        $manager = Manager::findOrFail($request->id);
        $manager->status = $request->status;
        $manager->save();

        return response()->json([
            'success' => true,
            'message' => 'Status updated'
        ]);
    }
}
