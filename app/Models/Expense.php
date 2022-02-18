<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;

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
        'hotelName',
        'expenseType_id',
        'user_id'
    ];
}
