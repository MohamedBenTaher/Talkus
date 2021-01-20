<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(){
        $departments =  Department::orderBy('name','ASC')->get();
        return response()->json($departments);
    }
}
