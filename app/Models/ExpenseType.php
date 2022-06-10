<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;



class ExpenseType extends Model
{
    use HasFactory, Sortable;

    protected $fillable = [
        'expType',
        'createdDate',
        'modifedBy',
        'updatedDate',
        'expCostLimit',
        'url_image'
    ];

    public $sortable = [
        'expType',
        'created_at',
        'expCostLimit',
    ];
}
