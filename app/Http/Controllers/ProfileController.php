<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $view = auth()->user()->role == "admin" ? "profile.edit" : "profile.emp_edit";

        return view($view, [
            'auth' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $file = $request->image ?? null;
        if ($file !== null && !$file->getError()){
            $path = $file->store("images/profiles", "public");
            $user->image = $path;
        }

        $validated = $request->validated();
        $user->name = $validated["name"];
        $user->email = $validated["email"];
        $user->company = $validated["company"];
        $user->job = $validated["job"];
        $user->country = $validated["country"];
        $user->city = $validated["city"];
        $user->phone_number = $validated["phone_number"];

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        $user->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
