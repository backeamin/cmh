<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class HostelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::where('role_id', 2)->get();
        $data['roles'] = Role::where('id', '!=', 1)->get();
        return view('admin.hostel.hostel', $data);
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $profile_pic = null;
        if($request->has('profile_pic')){
            $request->validate([
                'profile_pic' => 'image|max:2000'
            ]);
            $profile_pic = $request->file('profile_pic')->store('user_profile_pic');

        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'profile_pic' => $profile_pic,
            'role_id' => $request->role_id,
            'password' => Hash::make($request->password),
        ]);
        $user->unique_id = 'cmh' . $user->id;
        $user->save();
        Toastr::success('Hostel Added Successfully', 'Success');
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
            'name' => ['required', 'string', 'max:255'],
        ]);
        $user = User::findOrFail($id);
        $profile_pic = $user->profile_pic;
        if($request->has('profile_pic')){
            $request->validate([
                'profile_pic' => 'image|max:2000'
            ]);
            Storage::delete($user->profile_pic);
            $profile_pic = $request->file('profile_pic')->store('user_profile_pic');

        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'profile_pic' => $profile_pic,
            'role_id' => $request->role_id,
        ]);
        Toastr::success('Hostel Updated Successfully', 'Success');
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
        $user = User::findOrfail($id);
        Storage::delete($user->profile_pic);
        $user->delete();
        Toastr::success("Hostel Deleted Successfully", "Success");
        return back();
    }
}
