<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Follower;
use App\Models\FollowerList;
use App\Models\Student;
use App\Models\StudentList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MainController extends Controller
{
    public function index() {
        return view('index');
    }

    public function recruit() {
        $companyData = Company::inRandomOrder()->take(10);
        $postData = Company::inRandomOrder()->take(10);
        $data = [
            'tellers_companies' => $companyData->get(),
            'tellers_companies_list' => $companyData->pluck('user_id')->toArray(),
            'posts_companies' => $postData->get(),
            'posts_companies_list' => $postData->pluck('user_id')->toArray(),
            'auth' => Auth::check() ? Auth::user()->getRoleNames()[0] : 'guest',
        ];
        if (Auth::check()) {
            $data['followed'] = FollowerList::where('student_id', Auth::id())->pluck('company_id')->toArray();
            $data['user'] = Auth::user();
        }
        return view('recruit.recruit', $data);
    }

    public function companyDetail($id) {
        $data = [
            'company' => Company::where('user_id', $id)->first(),
            'auth' => Auth::check() ? Auth::user()->getRoleNames()[0] : 'guest',
        ];
        if (Auth::check()) {
            $data['followed'] = FollowerList::where('student_id', Auth::id())->pluck('company_id')->toArray();
            $data['user'] = Auth::user();
        }
        return view('recruit.detail', $data);
    }

    public function search() {
        $data = [
            'companies' => Company::all(),
        ];
        if (Auth::check()) {
            $data['followed'] = FollowerList::where('student_id', Auth::id())->pluck('company_id')->toArray();
            $data['user'] = Auth::user();
        }
        return view('recruit.search', $data);
    }

    public function followed() {
        $data = [
            'followed' => FollowerList::where('student_id', Auth::id())->get(),
        ];
        if (Auth::check()) {
            $data['followed'] = FollowerList::where('student_id', Auth::id())->pluck('company_id')->toArray();
            $data['user'] = Auth::user();
        }
        return view('recruit.followed', $data);
    }

    public function profile() {
        $data = [
            'account' => StudentList::where('user_id', Auth::id())->first(),
        ];
        if (Auth::check()) {
            $data['followed'] = FollowerList::where('student_id', Auth::id())->pluck('company_id')->toArray();
            $data['user'] = Auth::user();
        }
        return view('profile.show', $data);
    }

    public function dashboard() {
        switch (Auth::user()->getRoleNames()[0]) {
            case 'admin':
                $data = [
                    'students' => StudentList::orderBy('created_at', 'desc')->take(5)->get(),
                    'student_count' => Student::count(),
                    'company_count' => User::role('company')->count(),
                    'today_followed_count' => Follower::whereDate('created_at', date('Y-m-d'))->count(),
                ];
                break;
            case 'company':
                $company = Company::where('user_id', Auth::id())->first();
                $fistLogin = Auth::user()->first_login;
                if ($company === null) {
                    if ($fistLogin === 1) {
                        return redirect()->route('companyDetailEdit');
                    }
                    return redirect()->route('companyFirstLogin');
                }
                $data = [
                    'user' => Auth::user(),
                    'company' => Company::where('user_id', Auth::id())->first(),
                    'students' => FollowerList::where('company_id', Auth::id())->orderBy('created_at', 'desc')->take(5)->get(),
                    'all_followers' => FollowerList::where('company_id', Auth::id())->count(),
                    'monthly_followers' => FollowerList::where('company_id', Auth::id())->whereBetween('created_at', [date('Y-m-d', strtotime('-1 month')), date('Y-m-d')])->count(),
                    'weekly_followers' => FollowerList::where('company_id', Auth::id())->whereBetween('created_at', [date('Y-m-d', strtotime('-1 week')), date('Y-m-d')])->count(),
                ];
                break;
            case 'student':
                $data = [
                    'user' => Auth::user(),
                ];
                break;
            default:
                $data = [];
                break;
        }
        return view('dashboard.dashboard', $data);
    }
}
