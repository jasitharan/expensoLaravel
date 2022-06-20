<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use HasFactory, Sortable;
    
    protected $fillable = [
        'name'
    ];
    
    public $sortable = [
        'name',
        'created_at'
    ];
}
