<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;


class CompanyController extends Controller
{
    public function index()
    {
        return Company::all()->except(1);
    }

}
