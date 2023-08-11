<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function companyList() {
        $data = [
            'users' => User::all(),
        ];
        return view('dashboard.company-list', $data);
    }

    public function studentList() {
        $data = [
            'users' => User::all(),
        ];
        return view('dashboard.student-list', $data);
    }
}
