<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Income;
use App\Models\Khat;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\In;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $data['incomes'] = Income::all();
        $data['users'] = User::where('role_id', 3)->get();
        $data['khats'] = Khat::where('type', 1)->get();
        return view('admin.income.income', $data);
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
            'user_id' => 'required',
            'khat_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'voucher' => 'required',
        ],[
            'title.required' => 'Income Title required',
            'user_id.required' => 'User Name required',
            'khat_id.required' => 'Khat Name required',
            'amount.required' => 'Amount required',
            'date.required' => 'Date required',
            'voucher.required' => 'Voucher required',
        ]);
        $voucher = null;
        if($request->has('voucher')){
            $request->validate([
                'voucher' => 'image|max:2000'
            ]);
            $voucher = $request->file('voucher')->store('income_voucher');

        }

        Income::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'khat_id' => $request->khat_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'voucher' => $voucher,
            'comment' => $request->comment,
        ]);
        Toastr::success('Income Added Successfully', 'Success');
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
            'user_id' => 'required',
            'khat_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
        ],[
            'title.required' => 'Income Title required',
            'user_id.required' => 'User Name required',
            'khat_id.required' => 'Khat Name required',
            'amount.required' => 'Amount required',
            'date.required' => 'Date required',
        ]);
        $income = Income::findOrFail($id);
        $voucher = $income->voucher;
        if($request->has('voucher')){
            $request->validate([
                'voucher' => 'image|max:2000'
            ]);
            Storage::delete($income->voucher);
            $voucher = $request->file('voucher')->store('income_voucher');

        }

        $income->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'khat_id' => $request->khat_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'voucher' => $voucher,
            'comment' => $request->comment,
        ]);
        Toastr::success('Income Updated Successfully', 'Success');
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
        $income = Income::findOrfail($id);
        Storage::delete($income->voucher);
        $income->delete();
        Toastr::success("Income Deleted Successfully", "Success");
        return back();
    }
}
