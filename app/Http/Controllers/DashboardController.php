<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function adminDashboard() {
        return "This is Admin";
    }

    public function userDashboard() {
        return "This is USER";
    }
}
