<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function companyList() {
        $data = [
            'companies' => Company::all(),
        ];
        return view('dashboard.company-list', $data);
    }

    public function companyAdd() {
        return view('dashboard.company-add');
    }

    public function companyEdit($id) {
        $data = [
            'company' => Company::find($id),
        ];
        return view('dashboard.company-edit', $data);
    }

    public function studentList() {
        $data = [
            'users' => User::all(),
        ];
        return view('dashboard.student-list', $data);
    }
}
