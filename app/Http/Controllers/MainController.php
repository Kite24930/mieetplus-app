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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class MainController extends Controller
{
    private $faculties = [
        '人文学部',
        '教育学部',
        '医学部',
        '工学部',
        '生物資源学部',
        '人文社会科学研究科',
        '教育学研究科',
        '医学系研究科',
        '工学研究科',
        '生物資源学研究科',
        '地域イノベーション学研究科',
    ];

    private $glade = [
        '1',
        '2',
        '3',
        '4',
        '5',
        '6',
        'M1',
        'M2',
        'M3',
        'M4',
    ];

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
            $data['user'] = Auth::user();
        }
        return view('recruit.followed', $data);
    }

    public function profile(Request $request) {
        $data = [
            'request' => $request,
            'account' => StudentList::where('user_id', Auth::id())->first(),
        ];
        if (Auth::check()) {
            $data['followed'] = FollowerList::where('student_id', Auth::id())->pluck('company_id')->toArray();
            $data['user'] = Auth::user();
        }
        return view('profile.show', $data);
    }

    public function profileEdit(Request $request) {
        $data = [
            'request' => $request,
            'account' => StudentList::where('user_id', Auth::id())->first(),
            'faculties' => $this->faculties,
            'glades' => $this->glade,
        ];
        if (Auth::check()) {
            $data['followed'] = FollowerList::where('student_id', Auth::id())->pluck('company_id')->toArray();
            $data['user'] = Auth::user();
        }
        return view('profile.edit', $data);
    }

    public function profileEditPost(Request $request) {
        $target = Student::where('user_id', Auth::id())->first();
        $request->validate([
            'email' => ['required', 'string', 'email:filter,dns', 'max:255', 'ends_with:@m.mie-u.ac.jp'],
            'faculty' => ['required', 'string', 'max:255'],
            'glade' => ['required', 'string', 'max:255'],
            'screen_name' => ['nullable', 'string', 'max:255'],
            'img' => ['nullable', 'file', 'mimes:jpeg,png,jpg', 'max:2048'],
        ],
        [
            'email.ends_with' => 'メールアドレスは @m.mie-u.ac.jp で終わる必要があります。',
            'img.mimes' => '画像はjpeg,png,jpg形式でアップロードしてください。',
            'img.max' => '画像は2MB以下でアップロードしてください。',
        ]);

        function img_save($file, $id) {
            $target = Student::where('user_id', $id)->first();
            if ($target->img !== null) {
                if (Storage::disk('public')->exists('student/'.$id.'/'.$target->img)) {
                    Storage::disk('public')->delete('student/'.$id.'/'.$target->img);
                }
            }
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/student/'.$id, $fileName);
            return $fileName;
        }

        try {
            DB::beginTransaction();
            if (isset($request->img)) {
                $fileName = img_save($request->file('img'), Auth::id());
                $target->update([
                    'img' => $fileName,
                ]);
            }
            $notice = 0;
            if (isset($request->notice)) {
                $notice = 1;
            }
            $history = 0;
            if (isset($request->history)) {
                $history = 1;
            }
            if ($request->email !== $target->univ_email) {
                $target->update([
                    'univ_email' => $request->email,
                    'email_verified_at' => null,
                ]);
            }
            $target->update([
                'faculty' => $request->faculty,
                'glade' => $request->glade,
                'screen_name' => $request->screen_name,
                'notice' => $notice,
                'history' => $history,
            ]);
            DB::commit();
            return redirect()->route('profile.show')->with('success', 'プロフィールの編集に成功しました。');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('profile.edit')->with('error', 'プロフィールの編集に失敗しました。');
        }
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
