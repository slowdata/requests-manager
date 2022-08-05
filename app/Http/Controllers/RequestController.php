<?php

namespace App\Http\Controllers;

use App\Models\Request as ModelsRequest;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    //
    public function index()
    {
        return ModelsRequest::all();
    }


    public function store(Request $request)
    {
        ModelsRequest::create($request->validate([
            'title' => 'required',
            'app' => 'required|apps',
            'description' => 'required',
            'requested_by' => 'required|max:20'
        ]));
    }
}
