<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\WalletRequest;
use App\Models\Wallet;

class WalletController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $wallets = new Wallet();
        if ($keyword) {
            $wallets = $wallets->where('name', 'like', "%$keyword%");
        }

        $wallets = $wallets->orderBy('id', 'desc')->paginate(10);
        $viewData = [
            'keyword' => $keyword,
            'wallets' => $wallets
        ];
        return view('pages.wallets.index')->with($viewData);
    }

    public function create()
    {
        return view('pages.wallets.create');
    }

    public function store(WalletRequest $request)
    {
        $name = $request->name;

        $newWallet = Wallet::create([
            'name' => $name
        ]);

        return redirect()
            ->route('wallets')
            ->with('success', 'Created Successfully');
    }

    public function edit($id)
    {
        $wallet = Wallet::find($id);
        if (!$wallet) {
            return redirect()
                ->route('wallets')
                ->with('error', 'Wallet Not Found');
        }

        $viewData = [
            'id' => $id,
            'name' => $wallet->name,
        ];

        return view('pages.wallets.edit')->with($viewData);
    }

    public function update($id, WalletRequest $request)
    {
        $name = $request->name;

        $updateWallet = Wallet::where('id', $id)->update([
            'name' => $name
        ]);

        return redirect()
            ->route('wallets.edit', ['id' => $id])
            ->with('success', 'Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!$id) {
            return redirect()
                ->route('wallets')
                ->with('error', 'Wallet Not Found');
        }

        $deleteWallet = Wallet::where('id', $id)->delete();

        return redirect()
            ->route('wallets')
            ->with('success', 'Deleted Successfully');
    }
}
