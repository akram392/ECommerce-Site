<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use File;
use Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('name', 'asc')->where('status', 1)->where('is_parent', 0)->get();
        return view('backend.pages.category.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parentCategories = Category::orderBy('name', 'asc')->where('is_parent', 0)->get();
        return view('backend.pages.category.create', compact('parentCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $category = new Category;

        $category->name          = $request->name;
        $category->slug          = Str::slug($request->name);
        $category->description   = $request->description;
        $category->is_parent     = $request->is_parent;
        $category->status        = $request->status;

        if ($request->image) {                                                   // find img
            # code...
            $image = $request->file('image');                                    // received img
            $img = time() . '-br.' . $image->getClientOriginalExtension();       // make img name
            $location = public_path('images/category/' . $img);                  // find img location
            Image::make($image)->save($location);                                // save img location
            $category->image = $img;                                             // save img
        }

        // dd($brand);
        // exit();
        $category->save();
        $notification = array (
            'message' => 'Category Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('category.manage')->with($notification);
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
        $category = Category::find($id);
        if( !is_null( $category ) ) {
            $parentCategories = Category::orderBy('name', 'asc')->where('is_parent', 0)->get();
            return view('backend.pages.category.edit', compact('parentCategories', 'category'));
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
        $categories = Category::orderBy('name', 'asc')->where('status', 0)->get();
        return view('backend.pages.category.trash', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
        if( !is_null( $category ) ) {
            $category->name          = $request->name;
            $category->slug          = Str::slug($request->name);
            $category->description   = $request->description;
            $category->is_parent     = $request->is_parent;
            $category->status        = $request->status;

            if ($request->image) {                                                // find img
                # code...
                // Delete Old Image
                if (File::exists('images/category/' . $category->image)) {
                    # code...
                    File::delete('images/category/' . $category->image);
                }

                $image = $request->file('image');                                 // received img
                $img = time() . '-br-' . $image->getClientOriginalExtension();    // make img name
                $location = public_path('images/category/' . $img);                  // find img location
                Image::make($image)->save($location);                             // save img location
                $category->image = $img;                                             // save img
            }

            // dd($brand);
            // exit();
            $category->save();
            $notification = array (
                'message' => 'Category Information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('category.manage')->with($notification);
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
        $category = Category::find($id);
        if( !is_null( $category ) ) {
            // Image Deleted

            // Content Deleted
            // $brand->delete();

            // Soft Deleted
            $category->status = 0;
            $category->save();
            $notification = array (
                'message' => 'Category Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('category.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }
}
