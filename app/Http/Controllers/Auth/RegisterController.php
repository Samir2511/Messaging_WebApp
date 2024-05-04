<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\auth\RegisterStoreRequest;
use App\Utils\ImageUpload;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function create()
    {
        return view("auth.register");
    }
    public function store(RegisterStoreRequest $request) {
        $credentials = $request->validated();

        if ($request->hasFile('image')) {
            // Validate and upload the image
            $imageLocation = ImageUpload::uploadImage($request);

            if (!$imageLocation) {
                return back()->withInput()->withErrors("Image upload failed");
            }


            $user = User::create([
                'name' => $credentials['name'],
                'email' => $credentials['email'],
                'password' => Hash::make($credentials['password']),
                'image' => $imageLocation,
                'status' => "online"
            ]);

            Auth::login($user);
            auth()->user()->update(['status' => 'online']);

            return redirect()->route("user.showUserHeader");
        }

        return back()->withInput()->withErrors("Registration error");
    }
}
