<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wallet;
use App\Models\Package;
use App\Models\Transaction;

class DashboardController extends Controller
{
    public function index ()
    {
        $viewData = [
            'overview' => $this->getDataOverView(),
            'monthsInYear' => $this->getDataByMonthsInYear()
        ];

        return view('pages.dashboard.index')->with($viewData);
    }

    public function getDataOverView()
    {
        $total = 0;
        $dataWallets = [
            [
                'name' => 'Tiền mặt',
                'amount' => 0
            ],
            [
                'name' => 'Đầu tư',
                'amount' => 0
            ],
            [
                'name' => 'Cho vay',
                'amount' => 0
            ]
        ];

        $transactions = Transaction::all();
            
        foreach ($transactions as $t) {
            $package = $t->package;
            if ($package) {
                switch ($package->type) {
                    case Package::TYPE_IN:
                        $dataWallets[0]['amount'] += $t->amount;
                        $total += $t->amount;
                        break;
                    case Package::TYPE_LEND:
                        $dataWallets[0]['amount'] -= $t->amount;
                        $dataWallets[2]['amount'] += $t->amount;
                        $total += 0;
                        break;
                    case Package::TYPE_INVEST:
                        $dataWallets[0]['amount'] -= $t->amount;
                        $dataWallets[1]['amount'] += $t->amount;
                        $total += 0;
                        break;
                    case Package::TYPE_OUT:
                        $dataWallets[0]['amount'] -= $t->amount;
                        $total -= $t->amount;
                        break;
                }
            }
        }

        return [
            'total' => $total,
            'wallets' => $dataWallets,
        ];
    }

    public function getDataByMonthsInYear()
    {
        $year = date('Y');

        $months = ['01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12'];
        $data = [
            'labels' => $months,
            'in' => [],
            'out' => []
        ];

        foreach ($months as $key => $month) { 
            $from = "$year-$month-01";

            if ($month == '12') {
                $to = ($year + 1) . '-' . '01-01';
            } else {
                $to = $year . '-' . ($months[$key+1]) . '-01';
            }

            $moneyInInMonth = Transaction::with('package')
                ->where('date', '>=', $from)
                ->where('date', '<', $to)
                ->whereHas('package', function ($query) {
                    $query->where('type', Package::TYPE_IN);
                })
                ->sum('amount');
            $data['in'][] = $moneyInInMonth;

            $moneyOutInMonth = Transaction::with('package')
                ->where('date', '>=', $from)
                ->where('date', '<', $to)
                ->whereHas('package', function ($query) {
                    $query->where('type', Package::TYPE_OUT);
                })
                ->sum('amount');
            $data['out'][] = $moneyOutInMonth * -1;
        }

        return json_encode($data);
    }
}
