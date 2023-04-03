<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Khat;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;

class KhatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $khats = Khat::all();
        return view('admin.khat.khat', compact('khats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
           'title' => 'required',
           'type' => 'required'
        ],[
            'title.required' => 'Title required',
            'type.required' => 'Type required',
        ]);

        Khat::create([
            'title' => $request->title,
            'type' => $request->type,
            ]);
        Toastr::success('Khat Added Successfully', 'Success');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'type' => 'required'
        ],[
            'title.required' => 'Title required',
            'type.required' => 'Type required',
        ]);
        $khat = Khat::findOrFail($id);
        $khat->update([
            'title' => $request->title,
            'type' => $request->type,
        ]);
        Toastr::success('Khat Updated Successfully', 'Success');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $khat = Khat::findOrFail($id);
        $khat->delete();
        Toastr::success('Khat Deleted Successfully', 'Success');
        return back();
    }
}
