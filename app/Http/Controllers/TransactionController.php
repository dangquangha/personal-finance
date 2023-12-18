<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TransactionRequest;
use App\Models\Wallet;
use App\Models\Package;
use App\Models\Transaction;

class TransactionController extends Controller
{
    public function index(Request $request)
    {
        $wallets = Wallet::all();
        $packages = Package::all();

        $transactions = new Transaction();
        $transactions = $transactions->with(['wallet', 'package']);
        if ($request->wallet) {
            $transactions = $transactions->where('wallet_id', $request->wallet);
        }
        if ($request->package) {
            $transactions = $transactions->where('package_id', $request->package);
        }

        $transactions = $transactions->orderBy('date', 'desc')->orderBy('id', 'desc')->paginate(10);
        $viewData = [
            'wallet_id' => $request->wallet,
            'package_id' => $request->package,
            'transactions' => $transactions,
            'wallets' => $wallets,
            'packages' => $packages
        ];

        return view('pages.transactions.index')->with($viewData);
    }

    public function create()
    {
        $wallets = Wallet::all();
        $packages = Package::all();

        $viewData = [
            'wallets' => $wallets,
            'packages' => $packages
        ];

        return view('pages.transactions.create')->with($viewData);
    }

    public function store(TransactionRequest $request)
    {
        $dataCreate = [
            'wallet_id' => $request->wallet,
            'package_id' => $request->package,
            'amount' => $request->amount,
            'date' => $request->date,
            'note' => $request->note
        ];

        $newTransaction = Transaction::create($dataCreate);

        return redirect()
            ->route('transactions')
            ->with('status', 'Created Successfully');
    }

    public function edit($id)
    {
        $transaction = Transaction::find($id);
        if (!$transaction) {
            return redirect()
                ->route('transactions')
                ->with('error', 'Transaction Not Found');
        }

        $wallets = Wallet::all();
        $packages = Package::all();

        $viewData = [
            'id' => $id,
            'transaction' => $transaction,
            'wallets' => $wallets,
            'packages' => $packages
        ];
        
        return view('pages.transactions.edit')->with($viewData);
    }

    public function update($id, TransactionRequest $request)
    {
        $updateWallet = Transaction::where('id', $id)->update([
            'wallet_id' => $request->wallet,
            'package_id' => $request->package,
            'amount' => (int) str_replace('.', '', $request->amount),
            'date' => $request->date,
            'note' => $request->note
        ]);

        return redirect()
            ->route('transactions.edit', ['id' => $id])
            ->with('status', 'Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!$id) {
            return redirect()
                ->route('transactions')
                ->with('error', 'Transaction Not Found');
        }

        $deleteTransaction = Transaction::where('id', $id)->delete();

        return redirect()
            ->route('transactions')
            ->with('success', 'Deleted Successfully');
    }
}