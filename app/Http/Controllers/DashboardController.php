<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Package;

class DashboardController extends Controller
{
    public function index ()
    {
        $viewData = [
            'overview' => $this->getDataOverView()
        ];

        return view('pages.dashboard.index')->with($viewData);
    }

    public function getDataOverView()
    {
        $total = 0;
        $dataWallets = [];

        $wallets = Wallet::with(['transactions', 'transactions.package'])->get();
        foreach ($wallets as $w) {
            $wallet = [
                'id' => $w->id,
                'name' => $w->name,
                'amount' => 0
            ];
            foreach ($w->transactions as $t) {
                $package = $t->package;
                if ($package && $package->type == Package::TYPE_OUT) {
                    $wallet['amount'] -= $t->amount;
                    $total -= $t->amount;
                } else {
                    $wallet['amount'] += $t->amount;
                    $total += $t->amount;

                }
            }
            $dataWallets[] = $wallet;
        }

        return [
            'total' => $total,
            'wallets' => $dataWallets,
        ];
    }
}
