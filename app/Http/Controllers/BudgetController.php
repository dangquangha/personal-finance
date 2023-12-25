<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Budget;

class BudgetController extends Controller
{
    public function index()
    {
        return view('pages.budgets.index');
    }

    public function create()
    {
        return view('pages.budgets.create');
    }

    public function store(Request $request)
    {
        return redirect()
            ->route('budgets')
            ->with('success', 'Created Successfully');
    }

    public function edit($id)
    {
        $viewData = [
            'id' => $id,
            'name' => 'test'
        ];

        return view('pages.budgets.edit')->with($viewData);
    }

    public function update($id, Request $request)
    {
        return redirect()
            ->route('budgets.edit', ['id' => $id])
            ->with('success', 'Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!$id) {
            return redirect()
                ->route('budgets')
                ->with('error', 'Budgets Not Found');
        }

        $deleteWallet = Budget::where('id', $id)->delete();

        return redirect()
            ->route('budgets')
            ->with('success', 'Deleted Successfully');
    }
}
