<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Transaction\TransactionStoreRequest;

class TransactionController extends Controller
{
    protected $model;

    public function __construct(Transaction $transaction)
    {
        $this->model = $transaction;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transaction.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TransactionStoreRequest $request)
    {


        DB::beginTransaction();
        try {
            $target = new $this->model;
            $target->transaction_id     = Str::uuid()->toString();
            $target->user_id            = $request->user_id;
            $target->order_amount       = $request->order_amount;
            $target->status             = 'success';
            $target->payment_method     = $request->payment_method ?? '';
            $target->save();

            DB::commit();
            return redirect()->back()->with('success', ___('alert.transaction_created_successfully!!'));
        } catch (\Throwable $th) {
            dd($th);
            DB::rollBack();
            return redirect()->back()->with('danger', ___('alert.something_went_wrong_please_try_again'));
        }
    }

}
