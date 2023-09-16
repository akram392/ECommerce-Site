<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $divisions = Division::orderBy('priority_num', 'asc')->where('status', 1)->get();
        return view('backend.pages.division.manage', compact('divisions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.division.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $division = new Division;

        $division->name           = $request->name;
        $division->slug           = Str::slug($request->name);
        $division->priority_num   = $request->priority_num;
        $division->status         = $request->status;

        $division->save();
        $notification = array (
            'message' => 'Division Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('division.manage')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $division = Division::find($id);
        if( !is_null( $division ) ) {
            return view('backend.pages.division.edit', compact('division'));
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $division = Division::find($id);
        if( !is_null( $division ) ) {
            $division->name           = $request->name;
            $division->slug           = Str::slug($request->name);
            $division->priority_num   = $request->priority_num;
            $division->status         = $request->status;

            $division->save();
            $notification = array (
                'message' => 'Division information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('division.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Display a listing of the resource.
     */
    public function trash()
    {
        $divisions = Division::orderBy('priority_num', 'asc')->where('status', 0)->get();
        return view('backend.pages.division.trash', compact('divisions'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $division = Division::find($id);
        if( !is_null( $division ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $division->status = 0;
            $division->save();
            $notification = array (
                'message' => 'Division Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('division.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
