<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index ()
    {

            if (auth()->user()->role == '1') {
                return view('/user/dashboard');
            }
            elseif (auth()->user()->role == '2') {
                return view('/admin/dashboard');
            }
            elseif (auth()->user()->role == '3') {
                return view('/superadmin/dashboard');
            }
            elseif (auth()->user()->role == '4') {
                return view('/user/dashboard_ass');
            }
            elseif (auth()->user()->role == '5') {
                return view('/user/dashboard_assdss');
            }
  
    }
}
