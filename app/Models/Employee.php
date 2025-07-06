<?php

namespace App\Models;

use App\Notifications\BroadcastMessage;
use App\Notifications\NewPayment;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;
use PhpParser\Node\Expr\Cast\Array_;

class Employee extends Model
{
    use HasFactory, Notifiable;

    protected $guarded = ["id"];

    // Relationships

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function salaries(): BelongsToMany
    {
        return $this->belongsToMany(Salary::class)->withPivot("amount");
    }

    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class);
    }

    // Local scopes
    public function scopeValidated(Builder $query){
        $query->where("status", "validated");
    }

    public function scopeRejected(Builder $query){
        $query->where("status", "rejected");
    }

    public function scopePending(Builder $query){
        $query->where("status", "pending");
    }


    // HELPERS

    public static function generateOTP()
    {
        return strtoupper(substr(Str::uuid()->toString(), 0, 6));
    }

    // Get gross salaries name and amount in an array
    public function getGrossSalaries(): Array
    {
        $gross_salaries = Salary::gross()->get();
        $gross = [];

        foreach($gross_salaries as $salary){
            $value = $this->salaries->contains($salary)
            ? $this->salaries->firstWhere('id', $salary->id)->pivot->amount 
            : $salary->price;

            $gross[] = [
                "id" => $salary->id,
                "name" => $salary->name,
                "amount" => $value,
            ];
        }
        return $gross;
    }

    // Get deduction salaries name and amount in an array
    public function getDeductionSalaries(): Array
    {
        $deduction_salaries = Salary::deduction()->get();
        $deductions = [];

        foreach($deduction_salaries as $salary){
            $extra = null;

            # Select the value either in the normal table or in the pivot table
            $value = $this->salaries->contains($salary) 
            ? $this->salaries->firstWhere('id', $salary->id)->pivot->amount 
            : $salary->price;

            if ($salary->id == 4){
                $base_salary = $this->getGrossSalaries()[0]["amount"];
                $extra = " ($value % of $base_salary)";
                $value = ($value * $base_salary)/ 100 ;
            }

            $deductions[] = [
                "id" => $salary->id,
                "name" => $salary->name,
                "amount" => $value,
                "extra" => $extra,
            ];
        }

        return $deductions;
    }
    
    // Attributes
    public function getIsValidatedAttribute():bool
    {
        return $this->status == "validated";
    }

    public function getIsPendingAttribute():bool
    {
        return $this->status == "pending";
    }

    public function getIsRejectedAttribute():bool
    {
        return $this->status == "rejected";
    }

    public function getImageUrlAttribute()
    {
        if (!$this->user){
            return asset("img/profile_avatar.png");
        }
        return Storage::url($this->user->image);
    }

    public function getGrossSalaryAttribute() : float
    {
        $total_gross = 0;
        foreach ($this->getGrossSalaries() as $salary){
            $total_gross += $salary["amount"];
        }

        return $total_gross;
    }

    public function getDeductionSalaryAttribute() : float
    {
        $total_deductions = 0;
        foreach($this->getDeductionSalaries() as $salary){
            $total_deductions += $salary["amount"];
        }
        
        return $total_deductions;
    }

    public function getNetSalaryAttribute(): float
    {
        return $this->gross_salary - $this->deduction_salary;
    }

    public function getUnreadPaymentNotificationsAttribute (){

        $unreadPaymentNotifications = $this->unreadNotifications->filter(function($notification){
            return $notification->type == NewPayment::class;
        });

        return $unreadPaymentNotifications;
    }

    public function getUnreadNewsNotificationsAttribute (){
        $unreadNewsNotifications = $this->unreadNotifications->filter(function($notification){
            return $notification->type == BroadcastMessage::class;
        });

        return $unreadNewsNotifications;
    }
}
