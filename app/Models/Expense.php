<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Expense extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'createdDate',
        'receiptPath',
        'expenseCost',
        'expenseFor',
        'otherExpense',
        'rentalAgency',
        'carClass',
        'ticketNo',
        'airline',
        'daysInHotel',
        'status',
        'hotelName',
        'expenseType_id',
        'user_id'
    ];

    

     //define accessor
     public function getUsernameAttribute()
     {
        if (!empty($this->user_id)) {
            return User::find($this->user_id)->name;
        }
  
     }

     public function getExpenseTypeAttribute()
     {
        if (!empty($this->expenseType_id)) {
         return ExpenseType::find($this->expenseType_id);
        }
     }

     protected $appends = ['user_name', 'expenseType'];
}
