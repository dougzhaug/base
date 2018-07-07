<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class BaseController extends Controller
{
    protected $admin;

    public function __construct()
    {
        $this->middleware('auth:admin');
    }
}
