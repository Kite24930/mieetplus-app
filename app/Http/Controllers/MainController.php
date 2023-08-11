<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Follower;
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
        $faker = \Faker\Factory::create('ja_JP');

        $companyData = [];

        for ($i = 1; $i <= 10; $i++) {
            $companyData[] = [
                'id' => $i,
                'company_name' => $faker->company,
                'business_description' => $faker->realText(400),
                'company_pr' => $faker->realText(400),
                'business_details' => $faker->realText(400),
                'photo1' => $faker->imageUrl(480, 640, 'cats'),
                'photo2' => $faker->imageUrl(480, 640, 'cats'),
                'photo3' => $faker->imageUrl(480, 640, 'cats'),
                'followed' => $faker->boolean,
            ];
            $postData[] =[
                'id' => $i,
                'company_name' => $faker->company,
                'introduction' => $faker->realText(400),
                'photo' => $faker->imageUrl(640, 640, 'cats'),
            ];
        }
        $data = [
            'companies' => $companyData,
            'posts' => $postData,
        ];
        return view('recruit.recruit', $data);
    }

    public function companyDetail($id) {
        $data = [];
        return view('recruit.detail', $data);
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
                $data = [
                    'user' => Auth::user(),
                    'company' => Company::where('user_id', Auth::id())->first(),
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
