<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Employee;
use App\Notifications\NewPayment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function store_many()
    {   
        $employees = Employee::validated()->get();
        foreach ($employees as $employee){
            $payment = null;            
            foreach ($employee->payments as $paysheet){
                if ($paysheet->created_at->format("mY") == today()->format("mY")){
                    $payment = $paysheet;
                }
            }

            $data = [
                "gross_salaries" => $employee->getGrossSalaries(),
                "deductions" => $employee->getDeductionSalaries(),
            ];


            $values = [
                "employee_id" => $employee->id,
                "gross_salary" => $employee->gross_salary,
                "deductions" => $employee->deduction_salary,
                "net_salary" => $employee->net_salary,
                "data" => json_encode($data),
                // "comment" => "Some comment"
            ];

            if ($payment){
                $payment->update($values);
            }
            else{
                $payment = Payment::create($values);
            }

            $employee->notify(new NewPayment($payment));
        }
        
        return back()->with("success_payment_sheet", "You successfully sent pay sheets to all employees.");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Employee $employee)
    {
        $payment = null;
        foreach ($employee->payments as $paysheet){
            if ($paysheet->created_at->format("mY") == today()->format("mY")){
                // return back()->with("error", "Cannot assign a payment twice a month to an employee.");
                $payment = $paysheet;
            }
        }

        $data = [
            "gross_salaries" => $employee->getGrossSalaries(),
            "deductions" => $employee->getDeductionSalaries(),
        ];

        $values = [
            "employee_id" => $employee->id,
            "gross_salary" => $employee->gross_salary,
            "deductions" => $employee->deduction_salary,
            "net_salary" => $employee->net_salary,
            "data" => json_encode($data),
            // "comment" => "Some comment"
        ];

        if ($payment){
            $payment->update($values);
        }
        else{
            // Create
            $payment = Payment::create($values);

        }

        $employee->notify(new NewPayment($payment));

        return back()->with("success_payment_sheet", "You successfully sent the pay sheet to the employee.");
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
