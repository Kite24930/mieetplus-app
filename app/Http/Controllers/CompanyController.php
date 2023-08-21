<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\FollowerList;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    public function companyDetailEdit(Request $request) {
        $company = Company::where('user_id', Auth::id())->first();
        $data = [
            'company' => $company,
            'categories' => Category::all(),
        ];
        if ($request->session()->has('msg')) {
            $data['msg'] = $request->session()->get('msg');
        }
        return view('dashboard.company-detail-edit', $data);
    }

    public function companyDetailEditPost(Request $request) {
        $target = Company::where('user_id', Auth::id())->first();
        $top_img_validate = 'nullable|file|mimes:jpeg,png,jpg|max:2048';
        if ($target === null) {
            $top_img_validate = 'required|file|mimes:jpeg,png,jpg|max:2048';
        }
        $request->validate([
            'name' => 'required|max:255',
            'ruby' => 'required|max:255',
            'category' => 'required',
            'url' => 'url|active_url|nullable',
            'location' => 'required|max:255',
            'location_lat' => 'numeric',
            'location_lng' => 'numeric',
            'work_location' => 'required|max:255',
            'establishment_date' => 'required|date_format:Y-m',
            'capital' => 'required|numeric|max:255',
            'sales' => 'nullable|numeric',
            'employee_number' => 'required|numeric|max:255',
            'graduated_number' => 'nullable|numeric|max:255',
            'contents' => 'required',
            'pr' => 'nullable',
            'job_description' => 'nullable',
            'culture' => 'nullable',
            'environment' => 'nullable',
            'feature' => 'required',
            'career_path' => 'required',
            'desired_person' => 'required',
            'transfer' => 'required',
            'notice' => 'nullable',
            'faculties' => 'nullable',
            'occupations' => 'nullable',
            'recruit_name' => 'nullable|max:255',
            'recruit_ruby' => 'nullable|max:255',
            'recruit_email' => 'nullable|email|max:255',
            'top_img' => $top_img_validate,
            'logo_img' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'job_description_tellers' => 'required',
            'tellers_img_1' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'culture_tellers' => 'required',
            'tellers_img_2' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'environment_tellers' => 'required',
            'tellers_img_3' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
        ],
        [
            'name.required' => '企業名を入力してください。',
            'name.max' => '企業名は255文字以内で入力してください。',
            'ruby.required' => '企業名（ふりがな）を入力してください。',
            'ruby.max' => '企業名（ふりがな）は255文字以内で入力してください。',
            'category.required' => '業種を選択してください。',
            'url.url' => 'URLの形式が正しくありません。',
            'url.active_url' => 'URLが有効ではありません。',
            'location.required' => '所在地を入力してください。',
            'location.max' => '所在地は255文字以内で入力してください。',
            'location_lat.numeric' => '緯度は数値で入力してください。',
            'location_lng.numeric' => '経度は数値で入力してください。',
            'work_location.required' => '勤務地を入力してください。',
            'work_location.max' => '勤務地は255文字以内で入力してください。',
            'establishment_date.required' => '設立年月を入力してください。',
            'establishment_date.date_format' => '設立年月はYYYY-MMの形式で入力してください。',
            'capital.required' => '資本金を入力してください。',
            'capital.numeric' => '資本金は数値で入力してください。',
            'capital.max' => '資本金は255文字以内で入力してください。',
            'sales.numeric' => '売上は数値で入力してください。',
            'sales.max' => '売上は255文字以内で入力してください。',
            'employee_number.required' => '従業員数を入力してください。',
            'employee_number.numeric' => '従業員数は数値で入力してください。',
            'employee_number.max' => '従業員数は255文字以内で入力してください。',
            'graduated_number.numeric' => '三重大OB・OG数は数値で入力してください。',
            'graduated_number.max' => '三重大OB・OG数は255文字以内で入力してください。',
            'contents.required' => '事業内容を入力してください。',
            'contents.max' => '事業内容は2000文字以内で入力してください。',
            'pr.max' => 'PRは2000文字以内で入力してください。',
            'job_description.max' => '仕事内容は2000文字以内で入力してください。',
            'culture.max' => '社内の雰囲気・社風は2000文字以内で入力してください。',
            'environment.max' => '労働環境は2000文字以内で入力してください。',
            'feature.required' => '他社と比べた強み・弱みを入力してください。',
            'feature.max' => '他社と比べた強み・弱みは2000文字以内で入力してください。',
            'career_path.required' => 'キャリアパスを入力してください。',
            'career_path.max' => 'キャリアパスは2000文字以内で入力してください。',
            'desired_person.required' => '求める能力・人物像を入力してください。',
            'desired_person.max' => '求める能力・人物像は2000文字以内で入力してください。',
            'transfer.required' => '転勤・異動についてを入力してください。',
            'transfer.max' => '転勤・異動については2000文字以内で入力してください。',
            'notice.max' => 'お知らせは2000文字以内で入力してください。',
            'faculties.required' => '対象学部を選択してください。',
            'occupations.required' => '募集職種を選択してください。',
            'recruit_name.max' => '採用担当者名は255文字以内で入力してください。',
            'recruit_ruby.max' => '採用担当者名（ふりがな）は255文字以内で入力してください。',
            'recruit_email.email' => '採用担当者メールアドレスの形式が正しくありません。',
            'recruit_email.max' => '採用担当者メールアドレスは255文字以内で入力してください。',
            'top_img.required' => 'トップ画像を選択してください。',
            'top_img.file' => 'トップ画像はファイルを選択してください。',
            'top_img.mimes' => 'トップ画像はjpeg,png,jpg形式のファイルを選択してください。',
            'top_img.max' => 'トップ画像は2MB以内のファイルを選択してください。',
            'logo_img.file' => 'ロゴ画像はファイルを選択してください。',
            'logo_img.mimes' => 'ロゴ画像はjpeg,png,jpg形式のファイルを選択してください。',
            'logo_img.max' => 'ロゴ画像は2MB以内のファイルを選択してください。',
            'job_description_tellers.required' => 'Tellers[実際の仕事内容]を入力してください。',
            'job_description_tellers.max' => 'Tellers[実際の仕事内容]は1000文字以内で入力してください。',
            'tellers_img_1.file' => 'Tellers[実際の仕事内容]画像1はファイルを選択してください。',
            'tellers_img_1.mimes' => 'Tellers[実際の仕事内容]画像1はjpeg,png,jpg形式のファイルを選択してください。',
            'tellers_img_1.max' => 'Tellers[実際の仕事内容]画像1は2MB以内のファイルを選択してください。',
            'culture_tellers.required' => 'Tellers[社内の雰囲気・社風]を入力してください。',
            'culture_tellers.max' => 'Tellers[社内の雰囲気・社風]は1000文字以内で入力してください。',
            'tellers_img_2.file' => 'Tellers[社内の雰囲気・社風]画像2はファイルを選択してください。',
            'tellers_img_2.mimes' => 'Tellers[社内の雰囲気・社風]画像2はjpeg,png,jpg形式のファイルを選択してください。',
            'tellers_img_2.max' => 'Tellers[社内の雰囲気・社風]画像2は2MB以内のファイルを選択してください。',
            'environment_tellers.required' => 'Tellers[労働環境]を入力してください。',
            'environment_tellers.max' => 'Tellers[労働環境]は1000文字以内で入力してください。',
            'tellers_img_3.file' => 'Tellers[労働環境]画像3はファイルを選択してください。',
            'tellers_img_3.mimes' => 'Tellers[労働環境]画像3はjpeg,png,jpg形式のファイルを選択してください。',
            'tellers_img_3.max' => 'Tellers[労働環境]画像3は2MB以内のファイルを選択してください。',
        ]);

        function img_save($file, $column, $id) {
            $target = Company::where('user_id', $id)->first();
            if ($target !== null) {
                if ($target->$column !== null) {
                    if (Storage::disk('public')->exists('company/'.$id.'/'.$target->$column)) {
                        Storage::disk('public')->delete('company/'.$id.'/'.$target->$column);
                    }
                }
            }
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/company/'.$id, $fileName);
            return $fileName;
        }

        $files = [
            'top_img',
            'logo',
            'tellers_img_1',
            'tellers_img_2',
            'tellers_img_3',
        ];

        try {
            $fileName = [
                'top_img' => null,
                'logo' => null,
                'tellers_img_1' => null,
                'tellers_img_2' => null,
                'tellers_img_3' => null,
            ];
            foreach ($files as $fileTarget) {
                if ($request->file($fileTarget)) {
                    $fileName[$fileTarget] = img_save($request->file($fileTarget), $fileTarget, Auth::id());
                } else {
                    if ($target) {
                        $fileName[$fileTarget] = $target->$fileTarget;
                    }
                }
            }
            if ($target !== null) {
                $target->update([
                    'name' => $request->name,
                    'ruby' => $request->ruby,
                    'category' => $request->category,
                    'url' => $request->url,
                    'location' => $request->location,
                    'location_lat' => $request->location_lat,
                    'location_lng' => $request->location_lng,
                    'work_location' => $request->work_location,
                    'establishment_date' => $request->establishment_date.'-1',
                    'capital' => $request->capital,
                    'sales' => $request->sales,
                    'employee_number' => $request->employee_number,
                    'graduated_number' => $request->graduated_number,
                    'content' => $request->contents,
                    'pr' => $request->pr,
                    'job_description' => $request->job_description,
                    'culture' => $request->culture,
                    'environment' => $request->environment,
                    'feature' => $request->feature,
                    'career_path' => $request->career_path,
                    'desired_person' => $request->desired_person,
                    'transfer' => $request->transfer,
                    'notice' => $request->notice,
                    'faculties' => $request->faculties,
                    'occupations' => $request->occupations,
                    'recruit_name' => $request->recruit_name,
                    'recruit_ruby' => $request->recruit_ruby,
                    'recruit_email' => $request->recruit_email,
                    'top_img' => $fileName['top_img'],
                    'logo' => $fileName['logo'],
                    'job_description_tellers' => $request->job_description_tellers,
                    'tellers_img_1' => $fileName['tellers_img_1'],
                    'culture_tellers' => $request->culture_tellers,
                    'tellers_img_2' => $fileName['tellers_img_2'],
                    'environment_tellers' => $request->environment_tellers,
                    'tellers_img_3' => $fileName['tellers_img_3'],
                ]);
            } else {
                Company::create([
                    'user_id' => Auth::id(),
                    'name' => $request->name,
                    'ruby' => $request->ruby,
                    'category' => $request->category,
                    'url' => $request->url,
                    'location' => $request->location,
                    'location_lat' => $request->location_lat,
                    'location_lng' => $request->location_lng,
                    'work_location' => $request->work_location,
                    'establishment_date' => $request->establishment_date.'-1',
                    'capital' => $request->capital,
                    'sales' => $request->sales,
                    'employee_number' => $request->employee_number,
                    'graduated_number' => $request->graduated_number,
                    'content' => $request->contents,
                    'pr' => $request->pr,
                    'job_description' => $request->job_description,
                    'culture' => $request->culture,
                    'environment' => $request->environment,
                    'feature' => $request->feature,
                    'career_path' => $request->career_path,
                    'desired_person' => $request->desired_person,
                    'transfer' => $request->transfer,
                    'notice' => $request->notice,
                    'faculties' => $request->faculties,
                    'occupations' => $request->occupations,
                    'recruit_name' => $request->recruit_name,
                    'recruit_ruby' => $request->recruit_ruby,
                    'recruit_email' => $request->recruit_email,
                    'top_img' => $fileName['top_img'],
                    'logo' => $fileName['logo'],
                    'job_description_tellers' => $request->job_description_tellers,
                    'tellers_img_1' => $fileName['tellers_img_1'],
                    'culture_tellers' => $request->culture_tellers,
                    'tellers_img_2' => $fileName['tellers_img_2'],
                    'environment_tellers' => $request->environment_tellers,
                    'tellers_img_3' => $fileName['tellers_img_3'],
                ]);
            }
        } catch (\Exception $e) {
            return redirect()->route('companyDetailEdit')->with('msg', '企業情報の更新に失敗しました。');
        }
        return redirect()->route('companyDetailEdit')->with('msg', '企業情報を更新しました。');
    }

    public function followers() {
        $followers = FollowerList::where('company_id', Auth::id())->orderBy('created_at', 'desc');
        $data = [
            'followers' => $followers->get(),
            'count' => $followers->count(),
        ];
        return view('dashboard.followers-list', $data);
    }
}
