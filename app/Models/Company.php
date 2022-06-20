<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;

class Company extends Model
{
    use HasFactory, Sortable;
    
    protected $fillable = [
        'name',
        'address_id'
    ];
    
    public $sortable = [
        'name',
        'created_at'
    ];
    
    public function getAddressAttribute()
     {
        if (!empty($this->address_id)) {
         return Address::find($this->address_id);
        }
     }
    
    protected $appends = ['address'];
}
