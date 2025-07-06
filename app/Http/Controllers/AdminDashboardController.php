<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notifications\BroadcastMessage;
use App\Models\Request as ModelsRequest;
use Illuminate\Support\Facades\Notification;

class AdminDashboardController extends Controller
{
    public function index() : View
    {
        $auth = Auth::user();
        $requests = ModelsRequest::limit(15)->orderBy("created_at", "desc")->get();
        $employees = Employee::all();
        $validated_employees = Employee::validated()->get();
        $pending_employees = Employee::pending()->get();
        $rejected_employees = Employee::rejected()->get();
        
        return view('admin.index', [
            "auth" => $auth,
            "employees" => $employees,
            "requests" => $requests,
            "validated_employees" => $validated_employees,
            "rejected_employees" => $rejected_employees,
            "pending_employees" => $pending_employees,
        ]);
    }

    public function alert() : View
    {
        return view('admin.component_alert');
    }
    public function accordion() : View
    {
        $requests = ModelsRequest::whereNot("status", "seen")->limit(15)->orderBy("created_at", "desc")->get();
        $pending_employees = Employee::pending()->get();
        return view('admin.components-request',[
            "pending_employees" => $pending_employees,
            "requests" => $requests,
        ]);
    }

    public function validateAccount(Employee $employee){
        $employee->status = "validated";
        $employee->save();
        return redirect()->route("request.index");
    }

    public function rejectAccount(Employee $employee){
        $employee->status = "rejected";
        $employee->save();
        return redirect()->route("request.index");
    }

    public function formElement() : View
    {
        return view('admin.forms-employee');
    }

    public function contact() : View
    {
        return view('admin.contact');
    }
    
    public function sendBroadcastMessage(Request $request){
        $message = $request->validate([
            "title" => ["string", "required"],
            "content" => ["string", "required"],
            "attachment" => ["file", "mimes:pdf", "max:2048", "nullable"],
        ]);

        $file = $request->attachment ?? null;
        if ($file !== null && !$file->getError()){
            $path = $file->store("attachments", "public");
            $message["attachment"] = $path;
        }
        else{
            $message["attachment"] = null;
        }


        $employees = Employee::validated()->get();
        Notification::send($employees, new BroadcastMessage($message));

        return back()->with("success", "Message sent successfully to all employees.");
    }

    public function faq() : View
    {
        return view('admin.faq');
    }


    
}