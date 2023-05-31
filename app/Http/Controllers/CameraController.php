<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\Token;
use App\Models\Camera;

class CameraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('theme.cameras');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'location' => 'required|string',
            'ip' => 'required|string|ipv4',
            'port' => 'required|integer',
        ]);

        $data=Camera::create([
            'location' => $request->location,
            'ip' => $request->ip,
            'port' => $request->port,
        ]);

        return response()->json([
            'status' => true,
            'personal_access_token' => Token::getUserToken($request),
            'message' => 'Camera added successfully',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        $data=Camera::orderBy('location','asc')->get();

        return response()->json([
            'status' => true,
            'personal_access_token' => Token::getUserToken($request),
            'message' => 'Camera list',
            'data' => $data,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
