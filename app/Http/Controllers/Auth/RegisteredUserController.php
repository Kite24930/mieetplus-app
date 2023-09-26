<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'screen_name' => ['nullable', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:filter,dns', 'max:255', 'unique:'.User::class, 'ends_with:@m.mie-u.ac.jp'],
            'sex' => ['required', 'numeric', 'max:3'],
            'birthday' => ['required', 'date'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'faculty' => ['required', 'string', 'max:255'],
            'glade' => ['required', 'string', 'max:255'],
        ],
        [
            'email.ends_with' => 'メールアドレスは @m.mie-u.ac.jp で終わる必要があります。',
            'email.unique' => 'このメールアドレスは既に登録されています。',
            'email.email' => 'メールアドレスの形式が正しくありません。',
            'name.required' => '名前は必須です。',
            'sex.required' => '性別は必須です。',
            'birthday.required' => '生年月日は必須です。',
            'password.required' => 'パスワードは必須です。',
            'password.confirmed' => 'パスワードが一致しません。',
            'password.min' => 'パスワードは8文字以上である必要があります。',
            'password.regex' => 'パスワードは半角英数字である必要があります。',
            'faculty.required' => '学部は必須です。',
            'glade.required' => '学科は必須です。',
        ]);

        DB::beginTransaction();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $student = Student::create([
            'user_id' => $user->id,
            'univ_email' => $request->email,
            'sex' => $request->sex,
            'birthday' => $request->birthday,
            'faculty' => $request->faculty,
            'glade' => $request->glade,
            'screen_name' => $request->screen_name,
        ]);

        $user->assignRole('student');

        DB::commit();

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
