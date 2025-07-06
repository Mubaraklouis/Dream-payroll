<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Request as ModelsRequest;

class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("request.create", [
            "employee" => auth()->user()->employee,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "object" => ["string", "required"],
            "content" => ["string", "required"],
            "attachment" => ["file", "mimes:pdf", "max:2048", "nullable"],
        ]);

        $request_model = new ModelsRequest();
        $request_model->object = $request->object;
        $request_model->content = $request->content;
        $request_model->employee()->associate(auth()->user()->employee);

        $file = $request->attachment ?? null;
        if ($file !== null && !$file->getError()){
            $path = $file->store("attachments", "public");
            $request_model->attachment = $path;
        }

        $request_model->save();

        return back()->with("success", "Your request have been sent. Thank you !");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        $req = ModelsRequest::find($id);

        $req->update($request->all());
        return back()->with("success", "Request marked as read");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
