<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PackageRequest;
use App\Models\Package;

class PackageController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->keyword;

        $packages = new Package();
        if ($keyword) {
            $packages = $packages->where('name', 'like', "%$keyword%");
        }

        $packages = $packages->orderBy('id', 'desc')->paginate(10);
        $viewData = [
            'keyword' => $keyword,
            'packages' => $packages
        ];
        return view('pages.packages.index')->with($viewData);
    }

    public function create()
    {
        return view('pages.packages.create');
    }

    public function store(PackageRequest $request)
    {
        $name = $request->name;
        $type = $request->type;

        $newPackage = Package::create([
            'name' => $name,
            'type' => $type
        ]);

        return redirect()
            ->route('packages')
            ->with('success', 'Created Successfully');
    }

    public function edit($id)
    {
        $package = Package::find($id);
        if (!$package) {
            return redirect()
                ->route('packages')
                ->with('error', 'Package Not Found');
        }

        $viewData = [
            'id' => $id,
            'name' => $package->name,
            'type' => $package->type,
        ];

        return view('pages.packages.edit')->with($viewData);
    }

    public function update($id, PackageRequest $request)
    {
        $name = $request->name;
        $type = $request->type;

        $updatePackage = Package::where('id', $id)->update([
            'name' => $name,
            'type' => $type
        ]);

        return redirect()
            ->route('packages.edit', ['id' => $id])
            ->with('status', 'Updated Successfully');
    }

    public function destroy(Request $request)
    {
        $id = $request->id;

        if (!$id) {
            return redirect()
                ->route('packages')
                ->with('error', 'Package Not Found');
        }

        $deletePackage = Package::where('id', $id)->delete();

        return redirect()
            ->route('packages')
            ->with('success', 'Deleted Successfully');
    }
}