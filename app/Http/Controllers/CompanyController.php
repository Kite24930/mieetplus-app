<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class CompanyController extends Controller
{
    public function firstLogin() {
        $company = Company::where('user_id', Auth::id())->first();
        $fistLogin = Auth::user()->first_login;
        if ($fistLogin === 1) {
            if ($company === null) {
                return redirect()->route('companyDetailEdit');
            }
            return redirect()->route('dashboard');
        }
        $data = [
            'user' => Auth::user(),
        ];
        return view('dashboard.first-login', $data);
    }

    public function firstLoginPost(Request $request) {
        $request->validate([
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ],
        [
            'password.confirmed' => 'パスワードが一致しません。',
            'password.min' => 'パスワードは8文字以上である必要があります。',
            'password.regex' => 'パスワードは半角英数字である必要があります。',
        ]);

        try {
            $user = Auth::user();
            $user->update([
                'password' => Hash::make($request->password),
                'first_login' => 1,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('companyFirstLogin')->with('error', 'ユーザー情報の取得に失敗しました。');
        }
        return redirect()->route('companyDetailEdit');
    }

    public function companyDetail() {
        $company = Company::where('user_id', Auth::id())->first();
        $data = [
            'company' => $company,
        ];
        return view('dashboard.company-detail', $data);
    }

    public function companyDetailEdit() {
        $company = Company::where('user_id', Auth::id())->first();
        $data = [
            'company' => $company,
        ];
        return view('dashboard.company-detail-edit', $data);
    }

    public function companyDetailEditPost(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'name_kana' => 'required|max:255',
            'postal_code' => 'required|max:7',
            'address' => 'required|max:255',
            'tel' => 'required|max:255',
            'email' => 'required|max:255',
            'url' => 'required|max:255',
            'establishment' => 'required|max:255',
            'capital' => 'required|max:255',
            'representative' => 'required|max:255',
            'industry' => 'required|max:255',
            'business' => 'required|max:255',
            'employees' => 'required|max:255',
            'recruit' => 'required|max:255',
            'image' => 'file|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $company = Company::where('user_id', Auth::id())->first();
            $company->update([
                'name' => $request->name,
                'name_kana' => $request->name_kana,
                'postal_code' => $request->postal_code,
                'address' => $request->address,
                'tel' => $request->tel,
                'email' => $request->email,
                'url' => $request->url,
                'establishment' => $request->establishment,
                'capital' => $request->capital,
                'representative' => $request->representative,
                'industry' => $request->industry,
                'business' => $request->business,
                'employees' => $request->employees,
                'recruit' => $request->recruit,
            ]);
            if ($request->file('image')) {
                $file = $request->file('image');
                $fileName = time() . $file->getClientOriginalName();
                $target_path = public_path('images/company/');
                $file->move($target_path, $fileName);
                $company->update([
                    'image' => $fileName,
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->route('companyDetailEdit')->with('error', '企業情報の更新に失敗しました。');
        }
        return redirect()->route('dashboard')->with('success', '企業情報を更新しました。');
    }
}
