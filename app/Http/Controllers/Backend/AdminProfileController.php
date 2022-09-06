<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class AdminProfileController extends Controller
{
    public function AdminProfile()
    {
        $userId = Auth::user()->id;
        $userInfos = User::find($userId);

        return view('admin.profile', compact('userInfos'));
    }

    public function EditProfilePage()
    {
        $userId = Auth::user()->id;
        $userInfos = User::find($userId);

        return view('admin.edit_profile', compact('userInfos'));
    }

    public function UpdateProfile(Request $request)
    {
        $userId = Auth::user()->id;
        $userInfos = User::find($userId);

        if ($request->hasFile('profile_image')) {
            if ($request->file('profile_image')->isValid()) {
                $file = $request->file('profile_image');
                $filename = 'profile-photos/'.hexdec(uniqid()).'.'.$file->getClientOriginalExtension();

                Image::make($file)->save(public_path('storage/').$filename);

                $userInfos->profile_photo_path = $filename;
                $userInfos->save();
            }
        }

        $userInfos->update([
            'name' => $request->name,
            'email' => $request->email,
            'username' => $request->username,
        ]);

        return view('admin.profile', compact('userInfos'));
    }

    public function EditPasswordPage()
    {
        return view('admin.edit_password');
    }

    public function UpdatePassword(Request $request)
    {
        $userId = Auth::user()->id;
        $userInfos = User::find($userId);

        if (Hash::check($request->current_password, $userInfos->password) ) {
            if ($request->new_password == $request->confirm_password) {
                $userInfos->password = Hash::make($request->new_password);
                $userInfos->save(); 
                return view('admin.index');
            } else {
                return view('admin.edit_password');
            }
        } else {
            return view('admin.edit_password');
        }
    }
}