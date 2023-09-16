<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Division;
use App\Models\District;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use File;
use Image;
use Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if ( Auth::check() ) {
            # code...
            $divisions = Division::orderBy('priority_num', 'asc')->where('status', 1)->get();
            $districts = District::orderBy('name', 'asc')->where('status', 1)->get();
            return view('frontend.pages.customer-dashboard.myaccount', compact('divisions', 'districts'));
        }
        else {
            # code...
            return redirect()->route('userLogin');
        }
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

            if ( !is_null( $request->oldPassword )) {
                # code...
                if ( Hash::check($request->oldPassword, Auth::user()->password ) ) {
                    # code...
                    if ( $request->password == $request->password_confirmation ) {
                        # code...
                        $user->password = Hash::make($request->password);
                    }
                    else {
                        # code...
                        $notification = array (
                            'message' => 'New & Current Password Not Matched!',
                            'alert-type' => 'error',
                        );
                        return redirect()->back()->with($notification);
                    }
                }
                else {
                    # code...
                    $notification = array (
                        'message' => 'Old Password Are not Matched!',
                        'alert-type' => 'error',
                    );
                    return redirect()->back()->with($notification);
                }
            }

            $user->save();
            $notification = array (
                'message' => 'User Information Updated!',
                'alert-type' => 'info',
            );
            return redirect()->back()->with($notification);
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

    }

}
