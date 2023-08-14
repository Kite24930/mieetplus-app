<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;

class AdminController extends Controller
{
    public function companyList() {
        $data = [
            'companies' => Company::all(),
            'count' => Company::count(),
        ];
        return view('dashboard.company-list', $data);
    }

    public function companyAdd() {
        return view('dashboard.company-add');
    }

    public function companyAddPost(Request $request) {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:filter,dns', 'max:255', 'unique:'.User::class],
        ]);

        try {
            $password = Str::random(10);

            DB::beginTransaction();

            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($password),
            ]);

            $user->assignRole('company');

            DB::commit();

            event(new Registered($user));

            $contact = 'contact@mie-projectm.com';

            $body = $request->name."様%0D%0A%0D%0A平素より大変お世話になっております。%0D%0Aこの度はMieet Plus 就活部にご登録いただきまして誠にありがとうございます。%0D%0Aお手続きよりお時間をいただきまして、ありがとうございました。%0D%0A%0D%0AMieet Plus 就活部への登録が完了致しました。%0D%0A%0D%0A以下のURLからログインしてください。%0D%0Ahttps://mieet-plus.com/login%0D%0A%0D%0Aアカウント情報のメールアドレスはこのお送りしているメールアドレスをご使用ください。%0D%0Aパスワード：".$password."%0D%0A※初回ログイン時に任意のパスワードに変更する必要があります。%0D%0A%0D%0A%0D%0Aご不明な点等ありましたら、お手数をおかけいたしますが、下記の問い合わせ先もしくは弊社の担当までご連絡ください。%0D%0A%0D%0A今後ともどうぞよろしくお願い致します。%0D%0A%0D%0A※このメールに心当たりがない場合は、お手数ですが破棄してください。%0D%0A%0D%0A問い合わせ先%0D%0AMieet Plus 運営事務局(株式会社プロジェクトM)%0D%0AEmail：".$contact;

            $data = [
                'msg' => 'ok',
                'name' => $request->name,
                'email' => $request->email,
                'body' => $body,
            ];
        } catch (\Exception $e) {
            DB::rollBack();
            $data = [
                'msg' => 'error',
                'err' => $e->getMessage(),
            ];
        }
        return view('dashboard.company-add-complete', $data);
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
