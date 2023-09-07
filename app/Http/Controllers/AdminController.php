<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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
                'first_login' => 0,
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

    public function companyDetail($id) {
        $data = [
            'company' => Company::find($id),
        ];
        return view('dashboard.company-detail-admin', $data);
    }

    public function companyEdit($id, Request $request) {
        $data = [
            'company' => Company::find($id),
            'categories' => Category::all(),
            'target_id' => $id,
        ];
        if ($request->session()->has('msg')) {
            $data['msg'] = $request->session()->get('msg');
        }
        return view('dashboard.company-detail-edit-admin', $data);
    }

    public function adminCompanyEditPost($id, Request $request) {
        $target = Company::find($id);
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
            'contents' => 'required|max:16777215',
            'pr' => 'nullable|max:16777215',
            'job_description' => 'nullable|max:16777215',
            'culture' => 'nullable|max:16777215',
            'environment' => 'nullable|max:16777215',
            'feature' => 'required|max:16777215',
            'career_path' => 'required|max:16777215',
            'desired_person' => 'required|max:16777215',
            'transfer' => 'required|max:16777215',
            'notice' => 'nullable|max:16777215',
            'faculties' => 'nullable',
            'occupations' => 'nullable',
            'recruit_name' => 'nullable|max:255',
            'recruit_ruby' => 'nullable|max:255',
            'recruit_email' => 'nullable|email|max:255',
            'top_img' => $top_img_validate,
            'logo_img' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'job_description_tellers' => 'required|max:16777215',
            'tellers_img_1' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'culture_tellers' => 'required|max:16777215',
            'tellers_img_2' => 'nullable|file|mimes:jpeg,png,jpg|max:2048',
            'environment_tellers' => 'required|max:16777215',
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
                'contents.max' => '事業内容のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'pr.max' => 'PRのデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'job_description.max' => '仕事内容のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'culture.max' => '社内の雰囲気・社風のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'environment.max' => '労働環境のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'feature.required' => '他社と比べた強み・弱みを入力してください。',
                'feature.max' => '他社と比べた強み・弱みのデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'career_path.required' => 'キャリアパスを入力してください。',
                'career_path.max' => 'キャリアパスのデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'desired_person.required' => '求める能力・人物像を入力してください。',
                'desired_person.max' => '求める能力・人物像のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'transfer.required' => '転勤・異動についてを入力してください。',
                'transfer.max' => '転勤・異動についてのデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'notice.max' => 'その他の注意事項のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
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
                'job_description_tellers.max' => 'Tellers[実際の仕事内容]のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'tellers_img_1.file' => 'Tellers[実際の仕事内容]画像1はファイルを選択してください。',
                'tellers_img_1.mimes' => 'Tellers[実際の仕事内容]画像1はjpeg,png,jpg形式のファイルを選択してください。',
                'tellers_img_1.max' => 'Tellers[実際の仕事内容]画像1は2MB以内のファイルを選択してください。',
                'culture_tellers.required' => 'Tellers[社内の雰囲気・社風]を入力してください。',
                'culture_tellers.max' => 'Tellers[社内の雰囲気・社風]のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'tellers_img_2.file' => 'Tellers[社内の雰囲気・社風]画像2はファイルを選択してください。',
                'tellers_img_2.mimes' => 'Tellers[社内の雰囲気・社風]画像2はjpeg,png,jpg形式のファイルを選択してください。',
                'tellers_img_2.max' => 'Tellers[社内の雰囲気・社風]画像2は2MB以内のファイルを選択してください。',
                'environment_tellers.required' => 'Tellers[労働環境]を入力してください。',
                'environment_tellers.max' => 'Tellers[労働環境]のデータ容量が大きすぎます。約16Mバイト以内にしてください。',
                'tellers_img_3.file' => 'Tellers[労働環境]画像3はファイルを選択してください。',
                'tellers_img_3.mimes' => 'Tellers[労働環境]画像3はjpeg,png,jpg形式のファイルを選択してください。',
                'tellers_img_3.max' => 'Tellers[労働環境]画像3は2MB以内のファイルを選択してください。',
            ]);

        function img_save($file, $column, $target_id) {
            $target = Company::where('user_id', $target_id)->first();
            if ($target !== null) {
                if ($target->$column !== null) {
                    if (Storage::disk('public')->exists('company/'.$target_id.'/'.$target->$column)) {
                        Storage::disk('public')->delete('company/'.$target_id.'/'.$target->$column);
                    }
                }
            }
            $fileName = $file->getClientOriginalName();
            $file->storeAs('public/company/'.$target_id, $fileName);
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
            $target_id = $target->user_id;
            $fileName = [
                'top_img' => null,
                'logo' => null,
                'tellers_img_1' => null,
                'tellers_img_2' => null,
                'tellers_img_3' => null,
            ];
            foreach ($files as $fileTarget) {
                if ($request->file($fileTarget)) {
                    $fileName[$fileTarget] = img_save($request->file($fileTarget), $fileTarget, $target_id);
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
            }
        } catch (\Exception $e) {
            return redirect()->route('adminCompanyEdit', $id)->with('msg', '企業情報の更新に失敗しました。');
        }
        return redirect()->route('adminCompanyEdit', $id)->with('msg', '企業情報を更新しました。');
    }

    public function studentList() {
        $data = [
            'users' => User::all(),
        ];
        return view('dashboard.student-list', $data);
    }
}
