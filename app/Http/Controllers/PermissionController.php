<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permission;

class PermissionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $permissions = Permission::all();
        return view('pages.permission.index', compact('permissions'));
    }
}
