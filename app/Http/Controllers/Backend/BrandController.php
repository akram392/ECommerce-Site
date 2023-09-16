<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::orderBy('name', 'asc')->where('status', 1)->get();
        return view('backend.pages.brand.manage', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brand = new Brand;

        $brand->name          = $request->name;
        $brand->slug          = Str::slug($request->name);
        $brand->description   = $request->description;
        $brand->status        = $request->status;

        if ($request->image) {                                                // find img
            # code...
            $image = $request->file('image');                                 // received img
            $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
            $location = public_path('images/brand/' . $img);                  // find img location
            Image::make($image)->save($location);                             // save img location
            $brand->image = $img;                                             // save img
        }

        // dd($brand);
        // exit();
        $brand->save();
        $notification = array (
            'message' => 'Brand Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('brand.manage')->with($notification);
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
        $brand = Brand::find($id);
        if( !is_null( $brand ) ) {
            return view('backend.pages.brand.edit', compact('brand'));
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
        $brands = Brand::orderBy('name', 'asc')->where('status', 0)->get();
        return view('backend.pages.brand.trash', compact('brands'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);
        if( !is_null( $brand ) ) {
            $brand->name          = $request->name;
            $brand->slug          = Str::slug($request->name);
            $brand->description   = $request->description;
            $brand->status        = $request->status;

            if ($request->image) {                                                // find img
                # code...
                // Delete Old Image
                if (File::exists('images/brand/' . $brand->image)) {
                    # code...
                    File::delete('images/brand/' . $brand->image);
                }

                $image = $request->file('image');                                 // received img
                $img = time() . '-br-' . $image->getClientOriginalExtension();    // make img name
                $location = public_path('images/brand/' . $img);                  // find img location
                Image::make($image)->save($location);                             // save img location
                $brand->image = $img;                                             // save img
            }

            // dd($brand);
            // exit();
            $brand->save();
            $notification = array (
                'message' => 'Brand Information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('brand.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);
        if( !is_null( $brand ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $brand->status = 0;
            $brand->save();
            $notification = array (
                'message' => 'Brand Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('brand.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
