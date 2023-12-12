<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PackageRequest;

class PackageController extends Controller
{
    public function index()
    {
        return view('pages.packages.index');
    }

    public function create()
    {
        return view('pages.packages.create');
    }

    public function store(PackageRequest $request)
    {
        return redirect()
            ->route('packages')
            ->with('status', 'Created Successfully');
    }

    public function edit($id)
    {
        $viewData = [
            'id' => $id,
            'name' => 'Test name',
        ];

        return view('pages.packages.edit')->with($viewData);
    }

    public function update($id, PackageRequest $request)
    {
        return redirect()
            ->route('packages.edit', ['id' => $id])
            ->with('status', 'Updated Successfully');
    }
}
