<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;

class EmployeeDashboardController extends Controller
{
    public function index(){
        $employee = auth()->user()->employee;
        return view("user.index", [
            "employee" => $employee,
        ]);
    }


    public function faq()
    {
        return view("user.faq");
    }


    public function payment_history(){
        return view("user.payments");
    }

    public function data(){
        return view("user.data");
    }

    public function salary(Payment $payment)
    {
        return view("user.payment_details", [
            "payment" => $payment,
            "employee" => auth()->user()->employee,
        ]);
    }

    
}
