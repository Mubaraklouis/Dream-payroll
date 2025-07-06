<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Salary;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gross_salaries = Salary::where("category", "gross")->get();
        $deduction_salaries = Salary::where("category", "deduction")->get();

        $validated_employees = Employee::validated()->get();

        return view('admin.salary.index', [
            "gross_salaries" => $gross_salaries,
            "deduction_salaries" => $deduction_salaries,
            "validated_employees" => $validated_employees,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string"],
            "price" => ["required"],
            "category" => ["required", "string"],
        ]);

        Salary::create($validated);

        if ($request->category == "gross"){
            return redirect()->route("salary.index")->with("gross-success", "Gross input salary have been created successfully !");
        }
        return redirect()->route("salary.index")->with("deduction-success", "Deduction input salary have been created successfully !");

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            "name" => ["string", "required"],
            "price" => ["numeric", "required"],
        ]);

        $salary = Salary::find($id);
        $salary->update($validated);

        if ($salary->category == "gross"){
            return redirect()->route("salary.index")->with("gross-success", "Gross input salary updated !");
        }
        return redirect()->route("salary.index")->with("deduction-success", "Deduction input salary updated !");

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $salary = Salary::find($id);
        if ($salary->id == 1 or $salary->id == 4){
            return back()->with("error", "This salary input can't be deleted");
        }

        $salary->delete();
        if ($salary->category == "gross"){
            return redirect()->route("salary.index")->with("gross-success", "Gross input salary deleted !");
        }
        
        return redirect()->route("salary.index")->with("deduction-success", "Deduction input salary deleted !");
    }
}
