<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Department; // Import the Department model
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
    public function create(): View
    {
        $departments = Department::all(); // Fetch all departments
        return view('auth.register', compact('departments')); // Pass to the view
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Update the validation rules to include new fields
        $request->validate([
            'employee_id' => ['required', 'string', 'max:255', 'unique:users'], // Assuming employee_id should be unique
            'name' => ['required', 'string', 'max:255'],
            'nic' => 'required|string|unique:users,nic|max:20', // Add validation for NIC
            'department_name' => ['required', 'string', 'max:255'],
            'join_or_transfer' => ['required', 'in:join,transfer'], // Ensure it's either 'join' or 'transfer'
            'date' => ['required', 'date'], // Validate as a date
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        // Create the user with new fields
        $user = User::create([
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'nic' => $request->nic,  // Include NIC field
            'department_name' => $request->department_name,
            'join_or_transfer' => $request->join_or_transfer,
            'date' => $request->date,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(route('dashboard', absolute: false));
    }
}
