<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeRegistrationRequest;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(Employee $employee, string $code): View
    {
        if ($employee->otp != $code){
            abort(404);
        }

        return view('auth.register', [
            "employee" => $employee,
        ]);
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(EmployeeRegistrationRequest $request, Employee $employee, string $code): RedirectResponse
    {
        $validated = $request->validated();

        $user = new User();
        $user->name = $validated["name"];
        $user->email = $validated["email"];
        $user->password =  Hash::make($validated["password"]);
        $user->email_verified_at = now();
        $user->job = $validated["job_title"];
       
        $file = $validated["image"] ?? null;
        if ($file !== null && !$file->getError()){
            $path = $file->store("images/profiles", "public");
            $user->image = $path;
        }
        
        $user->save();

        $employee->user()->associate($user);
        $employee->update($request->except(['image', 'password', "password_confirmation", "_token"]));

        // event(new Registered($user));

        // Auth::login($user);

        return redirect(route("login"));
    }
}
