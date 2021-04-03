<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Monolog\Handler\IFTTTHandler;

class ProfileController extends Controller
{
    public function index()
    {
        return view('backend.profile.index');
    }
    public function update(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,' . Auth::id(),
            'avatar' => 'nullable|image',
        ]);
        // get loguin user
        $user = Auth::user();
        // update userinfo 
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);
        // Upload Image

        if ($request->hasFile('avatar')) {
            $user->addMedia($request->avatar)->toMediaCollection('avatar');
        }
        notify()->success('profile updated', 'success');
        return back();
    }

    public function changePassword()
    {
        return view('backend.profile.password');
    }
    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'current_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        $user = Auth::user();
        $hashPassword = $user->password;

        if (Hash::check($request->current_password, $hashPassword)) {
            if (!Hash::check($request->password, $hashPassword)) {
                $user->update([
                    'password' => Hash::make($request->password),
                ]);
                Auth::logout();
                notify()->success('Password Changed', 'success');
                return redirect()->route('login');
            } else {
                notify()->warning('New password can not be same', 'warning');
            }
        } else {
            notify()->error('Currunt passwor not match', 'error');
        }
        return back();
    }
}
