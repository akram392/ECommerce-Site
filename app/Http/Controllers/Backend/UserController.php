<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Division;
use App\Models\District;
use App\Models\User;
use Illuminate\Http\Request;
use File;
use Image;
use Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Auth::user()::orderBy('name', 'asc')->get();
        return view('backend.pages.user.manage', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $divisions = Division::orderBy('priority_num', 'asc')->where('status', 1)->get();
        $districts = District::orderBy('name', 'asc')->where('status', 1)->get();
        return view('backend.pages.user.create', compact('divisions', 'districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new Auth;

        $user->name                   = $request->name;
        $user->phone                  = $request->phone;
        $user->phone                  = $request->phone;
        $user->address_line1          = $request->address_line1;
        $user->address_line2          = $request->address_line2;
        $user->country_name           = $request->country_name;
        $user->division_id            = $request->division_id;
        $user->district_id            = $request->district_id;
        $user->zipCode                = $request->zipCode;
        $user->is_admin               = $request->is_admin;

        if ($request->image) {                                                      // find img
            # code...
            // Delete Old Image
            if (File::exists('images/user/' . $user->image)) {
                # code...
                File::delete('images/user/' . $user->image);
            }

            $image = $request->file('image');                                      // received img
            $img = time() . '-br.' . $image->getClientOriginalExtension();        // make img name
            $location = public_path('images/user/' . $img);                  // find img location
            Image::make($image)->save($location);                               // save img location
            $user->image = $img;                                               // save img
        }

        // dd($brand);
        // exit();
        $user->save();
        $notification = array (
            'message' => 'User Added Successfully!',
            'alert-type' => 'success',
        );
        return redirect()->route('user.manage')->with($notification);
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
        $user = Auth::user()::find($id);
        $divisions = Division::orderBy('priority_num', 'asc')->where('status', 1)->get();
        $districts = District::orderBy('name', 'asc')->where('status', 1)->get();
        if( !is_null( $user ) ) {
            // $parentUsers = Auth::user()::orderBy('name', 'asc')->get();
            return view('backend.pages.user.edit', compact('user', 'divisions', 'districts'));
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
        $user = Auth::user()::find($id);
        if( !is_null( $user ) ) {
            $user->name                   = $request->name;
            $user->phone                  = $request->phone;
            $user->address_line1          = $request->address_line1;
            $user->address_line2          = $request->address_line2;
            $user->country_name           = $request->country_name;
            $user->division_id            = $request->division_id;
            $user->district_id            = $request->district_id;
            $user->zipCode                = $request->zipCode;
            $user->is_admin               = $request->is_admin;

            if ($request->image) {                                                // find img
                # code...
                // Delete Old Image
                if (File::exists('images/user/' . $user->image)) {
                    # code...
                    File::delete('images/user/' . $user->image);
                }

                $image = $request->file('image');                                 // received img
                $img = time() . '-br.' . $image->getClientOriginalExtension();    // make img name
                $location = public_path('images/user/' . $img);                  // find img location
                Image::make($image)->save($location);                             // save img location
                $user->image = $img;                                             // save img
            }

            $user->save();
            $notification = array (
                'message' => 'User Information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->route('user.manage')->with($notification);
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
        $user = Auth::user()::find($id);
        if( !is_null( $user ) ) {
            // Image Deleted

            // Content Deleted
            // $user->delete();

            // Soft Deleted
            $user->status = 0;
            $user->save();
            $notification = array (
                'message' => 'User Removed!',
                'alert-type' => 'error',
            );
            return redirect()->route('user.manage')->with($notification);
        }
        else {
            // 404 Page not Found
        }
    }

}
