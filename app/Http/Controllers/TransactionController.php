<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;

class TransactionController extends Controller
{
    public function index()
    {
        return view('pages.transactions.index');
    }

    public function create()
    {
        return view('pages.transactions.create');
    }

    public function store(WalletRequest $request)
    {
        return redirect()
            ->route('transactions')
            ->with('status', 'Created Successfully');
    }

    public function edit($id)
    {
        $viewData = [
            'id' => $id,
            'name' => 'Test name',
        ];

        return view('pages.transactions.edit')->with($viewData);
    }

    public function update($id, WalletRequest $request)
    {
        return redirect()
            ->route('transactions.edit', ['id' => $id])
            ->with('status', 'Updated Successfully');
    }
}
