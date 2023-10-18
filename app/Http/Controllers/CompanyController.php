<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Department;
use App\Models\FollowerList;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules;
use Illuminate\Validation\Rules\Password;
use InterventionImage;

class CompanyController extends Controller
{
    public function firstLogin() {
        $company = Company::where('user_id', Auth::id())->first();
        $fistLogin = Auth::user()->first_login;
        if ($fistLogin === 1) {
            if ($company === null) {
                return redirect()->route('companyDetailEdit', 0);
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
        return redirect()->route('companyDetailEdit', 0);
    }

    public function companyDepartmentList() {
        $companies = Company::where('user_id', Auth::id());
        $limit = Department::where('user_id', Auth::id())->first();
        $data = [
            'companies' => $companies->get(),
            'count' => $companies->count(),
            'limit' => $limit,
        ];
        return view('dashboard.company-department-list', $data);
    }

    public function companyDetail($id) {
        $company = Company::find($id);
        $data = [
            'company' => $company,
        ];
        return view('dashboard.company-detail', $data);
    }

    public function companyDetailEdit(Request $request, $id) {
        $company = Company::find($id);
        if (isset($company)) {
            $target = $id;
        } else {
            $target = 0;
        }
        $data = [
            'id' => $target,
            'company' => $company,
            'categories' => Category::all(),
        ];
        if ($request->session()->has('msg')) {
            $data['msg'] = $request->session()->get('msg');
        }
        return view('dashboard.company-detail-edit', $data);
    }

    public function companyDetailEditPost(Request $request, $id) {
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
            'capital' => 'required|numeric',
            'sales' => 'nullable|numeric',
            'employee_number' => 'required|numeric',
            'graduated_number' => 'nullable|numeric',
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

        function img_save($file, $column, $id, $height = 1200) {
            $saveFile = InterventionImage::make($file);
            $saveFile->orientate();
            $saveFile->resize(null, $height, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });
            $fileName = $file->getClientOriginalName();
            $filePath = storage_path('app/public/company/'.$id.'/'.$fileName);
            $saveFile->save(storage_path('app/public/company/'.$id.'/'.$fileName));
            $targetFile = InterventionImage::make($filePath);
            $limitSize = 200000;
            if ($targetFile->filesize() > $limitSize) {
                img_save($file, $column, $id, $height - 100);
            }
            $target = Company::find($id);
            if ($target !== null) {
                if ($target->$column !== null) {
                    if (Storage::disk('public')->exists('company/'.$id.'/'.$target->$column) && $target->$column !== $fileName) {
                        Storage::disk('public')->delete('company/'.$id.'/'.$target->$column);
                    }
                }
            }
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
            $file_id = $id;
            if ($target === null) {
                $file_id = DB::table('companies')->max('id') + 1;
            }
            if (Storage::disk('public')->exists('company/'.$file_id)) {
                Storage::disk('public')->makeDirectory('company/'.$file_id);
                if (!str_ends_with(sprintf('%o', fileperms(storage_path('app/public/company/' . $file_id))), '0755')) {
                    chmod(storage_path('app/public/company/'.$file_id), 0755);
                }
            }
            foreach ($files as $fileTarget) {
                if ($request->file($fileTarget)) {
                    $fileName[$fileTarget] = img_save($request->file($fileTarget), $fileTarget, $file_id);
                } else {
                    if ($target) {
                        $fileName[$fileTarget] = $target->$fileTarget;
                    }
                }
            }

            DB::beginTransaction();
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
                $target = Company::create([
                    'id' => $file_id,
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
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('companyDetailEdit', $target->id)->with('msg', '企業情報の更新に失敗しました。\n'.$e->getMessage());
        }
        return redirect()->route('companyDetailEdit', $target->id)->with('msg', '企業情報を更新しました。');
    }

    public function followers() {
        $companies = Company::where('user_id', Auth::id())->get();
        foreach ($companies as $company) {
            $followList = FollowerList::where('company_id', $company->id)->orderBy('created_at', 'desc');
            $followers[$company->id] = $followList->get();
            $count[$company->id] = $followList->count();
        }
        $data = [
            'companies' => $companies,
            'followers' => $followers,
            'count' => $count,
        ];
        return view('dashboard.followers-list', $data);
    }

    public function setting() {
        $data = [
            'company' => Company::where('user_id', Auth::id())->first()
        ];
        return view('dashboard.company-setting', $data);
    }

    public function passwordUpdate(Request $request): RedirectResponse {
        $validated = $request->validateWithBag('updatePassword', [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ],
        [
            'current_password.required' => '現在のパスワードを入力してください。',
            'current_password.current_password' => '現在のパスワードが正しくありません。',
            'password.required' => '新しいパスワードを入力してください。',
            'password.confirmed' => '新しいパスワードが一致しません。',
            'password.min' => '新しいパスワードは8文字以上である必要があります。',
            'password.regex' => '新しいパスワードは半角英数字である必要があります。',
        ]);

        $request->user()->update([
            'password' => Hash::make($validated['password']),
        ]);

        return back()->with('status', 'password-updated');
    }
}
