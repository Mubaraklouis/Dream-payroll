<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeDashboardController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\SalaryController;


Route::get('/', function () {
    return view('welcome');
})->name("home");


// We don't need the user to be logged in to register
Route::get('/create-account', [EmployeeController::class, "showRegistrationForm"])->name('employee.register');
Route::post('/create-account', [EmployeeController::class, "register"]);

Route::middleware('auth')->group(function () {
    Route::get('/adm-dashboard', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

    # Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    # Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    # Request model routes
    Route::get("/send-request", [RequestController::class, "create"])->name("request.create");
    Route::post("/send-request", [RequestController::class, "store"])->name("request.store");
    Route::patch("/request/edit/{id}", [RequestController::class, "update"])->name("request.update");

    # Employee model routes
    Route::get('/eployees/edit/{employee}', [EmployeeController::class, "edit"])->name('employee.edit');
    Route::patch('/eployees/edit/{employee}', [EmployeeController::class, "update"])->name('employee.update');
    Route::post('/eployees/edit/{employee}', [EmployeeController::class, "updateSalary"])->name('employee.update.salary');
    Route::get('/employee/{employee}/generate-payment-sheet', [EmployeeController::class, "show_payment_sheet"])->name('payment_sheet');
});


Route::controller(AdminDashboardController::class)
    ->middleware(["auth", "role:admin"])
    ->prefix("adm-dashboard")
    ->group(function() {
        
        # Random routes -- must be reformated
        Route::get('/alerts', 'alert')->name('alert.index');
        Route::get('/employee-requests', 'accordion')->name('request.index');
        Route::patch("/employees-requests/validate-account/{employee}", "validateAccount")->name("validate.account");
        Route::patch("/employees-requests/reject-account/{employee}", "rejectAccount")->name("reject.account");
        Route::get('/send-message-to-employees', 'contact')->name('contact');
        Route::post("/send-message-to-employees", "sendBroadcastMessage")->name("broadcast_message.send");
        Route::get("/faq", "faq")->name('faq');
        
        # Employee routes
        Route::get('/employee/generate-all-payment-sheets', [EmployeeController::class, "show_all_payment_sheet"])->name('payment_sheet.all');
        Route::get('/add-new-employee', [EmployeeController::class, "create"])->name('employee.create');
        Route::post('/add-new-employee', [EmployeeController::class, "store"])->name('employee.store');
        Route::delete('/eployees/delete/{employee}', [EmployeeController::class, "destroy"])->name('employee.delete');

        # Salary inputs routes
        Route::get('salary-inputs', [SalaryController::class, "index"])->name('salary.index');
        Route::post('/salary-inputs', [SalaryController::class, "store"])->name("salary.store");
        Route::patch('/salary-inputs/{id}/edit', [SalaryController::class, "update"])->name("salary.update");
        Route::delete('/salary-inputs/{id}/delete', [SalaryController::class, "destroy"])->name("salary.delete");

        # Request reply routes
        Route::post("/reply/{id}", [ReplyController::class, "store"])->name("reply.store");

        # Payment model routes
        Route::post("/employees/edit/{employee}", [PaymentController::class, "store"])->name("payment.store");
        Route::post("/employee/generate-all-payment-sheets", [PaymentController::class, "store_many"])->name("payment.store_many");
    });

Route::controller(EmployeeDashboardController::class)
    ->middleware(["auth", "role:employee"])
    ->prefix("my-dashboard")
    ->group(function(){
        Route::get("/", "index")->name("dashboard");
        Route::get("/my-data", "data")->name("user.data");
        Route::get("/my-payment-history", "payment_history")->name("user.payment_history");
        Route::get("/faq", "faq")->name("user.faq");
        Route::get("salary/details/{payment}", "salary")->name("salary-details");
        Route::get("/payment/show/{payment}", [PaymentController::class, "show"])->name("payment.show");

        Route::get("/messages", function(){
            return view("user.view-messages");
        })->name("message.index");

        Route::post("/messages/{id}", function($id){
            $notification = auth()->user()->employee->notifications()->find($id);
            if ($notification){
                $notification->markAsRead();
            }
            return back();
        })->name("notification.markAsRead");
});


require __DIR__.'/auth.php';
