<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use App\Mail\EmployeeCreated;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function showRegistrationForm(){
        return view("user.validate");
    }

    public function register(Request $request){

        $request->validate([
            'code' => ["required", "string", "max:6", "exists:employees,otp"],
            'email' => ["required", "string", "unique:users"],
        ]);

        // Find employee with the unique code
        $employee = Employee::where("email", $request->email)->where('otp', $request->code)->first();

        if ($employee) {
            return redirect()->route("register", ["employee" => $employee, "code" => $request->code]);
        }
        return back()->withErrors(['code' => 'Invalid code or email']);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $pending_employees = Employee::pending()->get();
        return view('employee.create', [
            "pending_employees" => $pending_employees,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => ["required", "string"],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique(Employee::class)],
        ]);

        $otp = Employee::generateOTP();

        $employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'otp' => $otp,
        ]);

        
        // Envoi de l'email
        Mail::to($employee->email)->send(new EmployeeCreated($employee));

        return redirect()->route('employee.create')->with('success', 'Employee created successfully');
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
    public function edit(Employee $employee)
    {
        return view("employee.edit", [
            "employee" => $employee,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->validated());

        return redirect()->route("employee.edit", ["employee" => $employee])->with("success", "Employee data have been updated successfully !");
    }

    public function updateSalary(Request $request, Employee $employee)
    {
        $data = [];
        foreach($request->salaries as $id => $amount){
            $data[$id] = ["amount" => $amount];
        }

        $employee->salaries()->sync($data);

        return redirect()->route("employee.edit", $employee)->with("success_salaries", "You successfully updated employee salaries");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route("admin.dashboard")->with("success", "Employee deleted successfully !");
    }


    public function show_payment_sheet(Employee $employee){
        $view = auth()->user()->hasRole("admin") ? "employee.payment_sheet2" : "employee.payment_sheet";

        return view($view, [
            "employee" => $employee,
        ]);
    }


    public function show_all_payment_sheet(){
        return view("employee.all_payment_sheets", [
            "validated_employees" => Employee::validated()->get(),
        ]);
    }
}
