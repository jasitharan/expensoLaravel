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
         return User::find($this->user_id)->name;
     }

     public function getExpenseTypeNameAttribute()
     {
         return ExpenseType::find($this->expenseType_id)->expType;
     }
     
     public function getExpenseTypeImageAttribute()
     {
         return ExpenseType::find($this->expenseType_id)->url_image;
     }

     protected $appends = ['user_name','expenseType_name','expenseType_image'];
}
