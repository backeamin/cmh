<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Khat;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['expenses'] = Expense::all();
        $data['users'] = User::where('role_id', 3)->get();
        $data['khats'] = Khat::where('type', 2)->get();
        return view('admin.expense.expense', $data);
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
            'title.required' => 'expense Title required',
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
            $voucher = $request->file('voucher')->store('expense_voucher');

        }

        Expense::create([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'khat_id' => $request->khat_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'voucher' => $voucher,
            'comment' => $request->comment,
        ]);
        Toastr::success('Expense Added Successfully', 'Success');
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
            'title.required' => 'expense Title required',
            'user_id.required' => 'User Name required',
            'khat_id.required' => 'Khat Name required',
            'amount.required' => 'Amount required',
            'date.required' => 'Date required',
        ]);
        $expense = Expense::findOrFail($id);
        $voucher = $expense->voucher;
        if($request->has('voucher')){
            $request->validate([
                'voucher' => 'image|max:2000'
            ]);
            Storage::delete($expense->voucher);
            $voucher = $request->file('voucher')->store('expense_voucher');

        }

        $expense->update([
            'user_id' => $request->user_id,
            'title' => $request->title,
            'khat_id' => $request->khat_id,
            'amount' => $request->amount,
            'date' => $request->date,
            'voucher' => $voucher,
            'comment' => $request->comment,
        ]);
        Toastr::success('Expense Updated Successfully', 'Success');
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
        $expense = Expense::findOrfail($id);
        Storage::delete($expense->voucher);
        $expense->delete();
        Toastr::success("Expense Deleted Successfully", "Success");
        return back();
    }
}
