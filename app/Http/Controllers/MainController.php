<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Company;
use App\Models\Filter;
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

    private $prefectures = [
        '北海道',
        '青森県',
        '岩手県',
        '宮城県',
        '秋田県',
        '山形県',
        '福島県',
        '茨城県',
        '栃木県',
        '群馬県',
        '埼玉県',
        '千葉県',
        '東京都',
        '神奈川県',
        '新潟県',
        '富山県',
        '石川県',
        '福井県',
        '山梨県',
        '長野県',
        '岐阜県',
        '静岡県',
        '愛知県',
        '三重県',
        '滋賀県',
        '京都府',
        '大阪府',
        '兵庫県',
        '奈良県',
        '和歌山県',
        '鳥取県',
        '島根県',
        '岡山県',
        '広島県',
        '山口県',
        '徳島県',
        '香川県',
        '愛媛県',
        '高知県',
        '福岡県',
        '佐賀県',
        '長崎県',
        '熊本県',
        '大分県',
        '宮崎県',
        '鹿児島県',
        '沖縄県',
    ];

    public function index() {
        return view('index');
    }

    public function recruit(Request $request) {
        $tellersCompany = Company::where('status', 1)->inRandomOrder();
        $postsCompany = Company::where('status', 1)->inRandomOrder();
        $tellersCompanyList = Company::pluck('user_id')->toArray();
        $postsCompanyList = Company::pluck('user_id')->toArray();
        $searchResult = [];
        if ($request->has('filter')) {
            if ($request->filter === '1') {
                if ($request->has('category')) {
                    $category = explode(',', $request->category);
                    $tellersCategoryList = Company::whereIn('category', $category)->pluck('user_id')->toArray();
                    $postsCategoryList = Company::whereIn('category', $category)->pluck('user_id')->toArray();
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersCategoryList);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsCategoryList);
                }
                if ($request->has('location') && isset($request->location)) {
                    $location = explode(',', $request->location);
                    $tellersLocationArray = [];
                    $postsLocationArray = [];
                    foreach ($location as $i => $loc) {
                        $tellersLocationList = Company::where('location', 'like', '%'.$loc.'%')->pluck('user_id')->toArray();
                        $postsLocationList = Company::where('location', 'like', '%'.$loc.'%')->pluck('user_id')->toArray();
                        $tellersLocationArray = array_merge($tellersLocationArray, $tellersLocationList);
                        $postsLocationArray = array_merge($postsLocationArray, $postsLocationList);
                    }
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersLocationArray);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsLocationArray);
                }
                if ($request->has('work_location') && isset($request->work_location)) {
                    $work_location = explode(',', $request->work_location);
                    $tellersWorkLocationArray = [];
                    $postsWorkLocationArray = [];
                    foreach ($work_location as $wl) {
                        $tellersWorkLocationList = Company::where('work_location', 'like', '%'.$wl.'%')->pluck('user_id')->toArray();
                        $postsWorkLocationList = Company::where('work_location', 'like', '%'.$wl.'%')->pluck('user_id')->toArray();
                        $tellersWorkLocationArray = array_merge($tellersWorkLocationArray, $tellersWorkLocationList);
                        $postsWorkLocationArray = array_merge($postsWorkLocationArray, $postsWorkLocationList);
                    }
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersWorkLocationArray);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsWorkLocationArray);
                }
                if ($request->has('establishment_date') && isset($request->establishment_date)) {
                    switch ($request->establishment_date_type) {
                        case 'before':
                            $tellersEstablishmentList = Company::where('establishment_date', '<=', $request->establishment_date)->pluck('user_id')->toArray();
                            $postsEstablishmentList = Company::where('establishment_date', '<=', $request->establishment_date)->pluck('user_id')->toArray();
                            break;
                        case 'after':
                            $tellersEstablishmentList = Company::where('establishment_date', '>=', $request->establishment_date)->pluck('user_id')->toArray();
                            $postsEstablishmentList = Company::where('establishment_date', '>=', $request->establishment_date)->pluck('user_id')->toArray();
                            break;
                        case 'equal':
                            $tellersEstablishmentList = Company::where('establishment_date', $request->establishment_date)->pluck('user_id')->toArray();
                            $postsEstablishmentList = Company::where('establishment_date', $request->establishment_date)->pluck('user_id')->toArray();
                            break;
                        default:
                            break;
                    }
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersEstablishmentList);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsEstablishmentList);
                }
                if ($request->has('capital') && isset($request->capital)) {
                    switch ($request->capital_type) {
                        case 'more':
                            $tellersCapitalList = Company::where('capital', '>=', $request->capital)->pluck('user_id')->toArray();
                            $postsCapitalList = Company::where('capital', '>=', $request->capital)->pluck('user_id')->toArray();
                            break;
                        case 'less':
                            $tellersCapitalList = Company::where('capital', '<=', $request->capital)->pluck('user_id')->toArray();
                            $postsCapitalList = Company::where('capital', '<=', $request->capital)->pluck('user_id')->toArray();
                            break;
                        case 'equal':
                            $tellersCapitalList = Company::where('capital', $request->capital)->pluck('user_id')->toArray();
                            $postsCapitalList = Company::where('capital', $request->capital)->pluck('user_id')->toArray();
                            break;
                        default:
                            break;
                    }
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersCapitalList);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsCapitalList);
                }
                if ($request->has('sales') && isset($request->sales)) {
                    switch ($request->sales_type) {
                        case 'more':
                            $tellersSalesList = Company::where('sales', '>=', $request->sales)->pluck('user_id')->toArray();
                            $postsSalesList = Company::where('sales', '>=', $request->sales)->pluck('user_id')->toArray();
                            break;
                        case 'less':
                            $tellersSalesList = Company::where('sales', '<=', $request->sales)->pluck('user_id')->toArray();
                            $postsSalesList = Company::where('sales', '<=', $request->sales)->pluck('user_id')->toArray();
                            break;
                        case 'equal':
                            $tellersSalesList = Company::where('sales', $request->sales)->pluck('user_id')->toArray();
                            $postsSalesList = Company::where('sales', $request->sales)->pluck('user_id')->toArray();
                            break;
                        default:
                            break;
                    }
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersSalesList);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsSalesList);
                }
                if ($request->has('employee_number') && isset($request->employee_number)) {
                    switch ($request->employee_number_type) {
                        case 'more':
                            $tellersEmployeeList = Company::where('employee_number', '>=', $request->employee_number)->pluck('user_id')->toArray();
                            $postsEmployeeList = Company::where('employee_number', '>=', $request->employee_number)->pluck('user_id')->toArray();
                            break;
                        case 'less':
                            $tellersEmployeeList = Company::where('employee_number', '<=', $request->employee_number)->pluck('user_id')->toArray();
                            $postsEmployeeList = Company::where('employee_number', '<=', $request->employee_number)->pluck('user_id')->toArray();
                            break;
                        case 'equal':
                            $tellersEmployeeList = Company::where('employee_number', $request->employee_number)->pluck('user_id')->toArray();
                            $postsEmployeeList = Company::where('employee_number', $request->employee_number)->pluck('user_id')->toArray();
                            break;
                        default:
                            break;
                    }
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersEmployeeList);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsEmployeeList);
                }
                if ($request->has('graduated_number') && isset($request->graduated_number)) {
                    switch ($request->graduated_number_type) {
                        case 'more':
                            $tellersGraduatedList = Company::where('graduated_number', '>=', $request->graduated_number)->pluck('user_id')->toArray();
                            $postsGraduatedList = Company::where('graduated_number', '>=', $request->graduated_number)->pluck('user_id')->toArray();
                            break;
                        case 'less':
                            $tellersGraduatedList = Company::where('graduated_number', '<=', $request->graduated_number)->pluck('user_id')->toArray();
                            $postsGraduatedList = Company::where('graduated_number', '<=', $request->graduated_number)->pluck('user_id')->toArray();
                            break;
                        case 'equal':
                            $tellersGraduatedList = Company::where('graduated_number', $request->graduated_number)->pluck('user_id')->toArray();
                            $postsGraduatedList = Company::where('graduated_number', $request->graduated_number)->pluck('user_id')->toArray();
                            break;
                        default:
                            break;
                    }
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersGraduatedList);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsGraduatedList);
                }
                if ($request->has('faculties') && isset($request->faculties)) {
                    $faculties = explode(',', $request->faculties);
                    $tellersFacultyArray = [];
                    $postsFacultyArray = [];
                    foreach ($faculties as $faculty) {
                        $tellersFacultyList = Company::where('faculties', 'like', '%'.$faculty.'%')->pluck('user_id')->toArray();
                        $postsFacultyList = Company::where('faculties', 'like', '%'.$faculty.'%')->pluck('user_id')->toArray();
                        $tellersFacultyArray = array_merge($tellersFacultyArray, $tellersFacultyList);
                        $postsFacultyArray = array_merge($postsFacultyArray, $postsFacultyList);
                    }
                    $tellersCompanyList = array_intersect($tellersCompanyList, $tellersFacultyArray);
                    $postsCompanyList = array_intersect($postsCompanyList, $postsFacultyArray);
                }
                $tellersCompanyList = $tellersCompany->whereIn('user_id', $tellersCompanyList)->get();
                $postsCompanyList = $postsCompany->whereIn('user_id', $postsCompanyList)->get();
            } else {
                $tellersCompanyList = $tellersCompany->get();
                $postsCompanyList = $postsCompany->get();
            }
        } else {
            $filter = Filter::where('user_id', Auth::id());
            if ($filter->count() > 0) {
                $filter = $filter->first();
                $activate = false;
                $param = [
                    'filter' => 0,
                ];
                if (isset($filter->category)) {
                    $activate = true;
                    $param['category'] = $filter->category;
                }
                if (isset($filter->location)) {
                    $activate = true;
                    $param['location'] = $filter->location;
                }
                if (isset($filter->work_location)) {
                    $activate = true;
                    $param['work_location'] = $filter->work_location;
                }
                if (isset($filter->establishment_date)) {
                    $activate = true;
                    $param['establishment_date'] = $filter->establishment_date;
                    $param['establishment_date_type'] = $filter->establishment_date_type;
                }
                if (isset($filter->capital)) {
                    $activate = true;
                    $param['capital'] = $filter->capital;
                    $param['capital_type'] = $filter->capital_type;
                }
                if (isset($filter->sales)) {
                    $activate = true;
                    $param['sales'] = $filter->sales;
                    $param['sales_type'] = $filter->sales_type;
                }
                if (isset($filter->employee_number)) {
                    $activate = true;
                    $param['employee_number'] = $filter->employee_number;
                    $param['employee_number_type'] = $filter->employee_number_type;
                }
                if (isset($filter->graduated_number)) {
                    $activate = true;
                    $param['graduated_number'] = $filter->graduated_number;
                    $param['graduated_number_type'] = $filter->graduated_number_type;
                }
                if (isset($filter->faculties)) {
                    $activate = true;
                    $param['faculties'] = $filter->faculties;
                }
                if ($activate) {
                    $param['filter'] = 1;
                    return redirect()->route('recruit', $param);
                } else {
                    return redirect()->route('recruit', $param);
                }
            } else {
                $tellersCompanyList = $tellersCompany->get();
                $postsCompanyList = $postsCompany->get();
            }
        }
        $data = [
            'request' => $request,
            'tellers_companies' => $tellersCompanyList->take(10),
            'tellers_companies_list' => $tellersCompanyList,
            'posts_companies' => $postsCompanyList->take(10),
            'posts_companies_list' => $postsCompanyList,
            'auth' => Auth::check() ? Auth::user()->getRoleNames()[0] : 'guest',
            'categories' => Category::all(),
            'prefectures' => $this->prefectures,
            'faculties' => $this->faculties,
        ];
        if (Auth::check()) {
            $data['followed'] = FollowerList::where('student_id', Auth::id())->pluck('company_id')->toArray();
            $data['user'] = Auth::user();
        }
        return view('recruit.recruit', $data);
    }

    public function filter(Request $request) {
        $filter = Filter::where('user_id', Auth::id());
        $activate = false;
        $param = [
            'filter' => 0,
        ];
        $DBParam = [];
        if ($request->category_activate) {
            $activate = true;
            $param['category'] = $request->filter_category;
            $DBParam['category'] = $request->filter_category;
        } else {
            $DBParam['category'] = null;
        }
        if ($request->location_activate) {
            $activate = true;
            $param['location'] = $request->filter_location;
            $DBParam['location'] = $request->filter_location;
        } else {
            $DBParam['location'] = null;
        }
        if ($request->work_location_activate) {
            $activate = true;
            $param['work_location'] = $request->filter_work_location;
            $DBParam['work_location'] = $request->filter_work_location;
        } else {
            $DBParam['work_location'] = null;
        }
        if ($request->establishment_activate) {
            $activate = true;
            $param['establishment_date'] = $request->filter_establishment_date.'-01';
            $param['establishment_date_type'] = $request->filter_establishment_date_type;
            $DBParam['establishment_date'] = $request->filter_establishment_date.'-01';
            $DBParam['establishment_date_type'] = $request->filter_establishment_date_type;
        } else {
            $DBParam['establishment_date'] = null;
            $DBParam['establishment_date_type'] = null;
        }
        if ($request->capital_activate) {
            $activate = true;
            $param['capital'] = $request->filter_capital;
            $param['capital_type'] = $request->filter_capital_type;
            $DBParam['capital'] = $request->filter_capital;
            $DBParam['capital_type'] = $request->filter_capital_type;
        } else {
            $DBParam['capital'] = null;
            $DBParam['capital_type'] = null;
        }
        if ($request->sales_activate) {
            $activate = true;
            $param['sales'] = $request->filter_sales;
            $param['sales_type'] = $request->filter_sales_type;
            $DBParam['sales'] = $request->filter_sales;
            $DBParam['sales_type'] = $request->filter_sales_type;
        } else {
            $DBParam['sales'] = null;
            $DBParam['sales_type'] = null;
        }
        if ($request->employee_activate) {
            $activate = true;
            $param['employee_number'] = $request->filter_employee_number;
            $param['employee_number_type'] = $request->filter_employee_number_type;
            $DBParam['employee_number'] = $request->filter_employee_number;
            $DBParam['employee_number_type'] = $request->filter_employee_number_type;
        } else {
            $DBParam['employee_number'] = null;
            $DBParam['employee_number_type'] = null;
        }
        if ($request->graduated_activate) {
            $activate = true;
            $param['graduated_number'] = $request->filter_graduated_number;
            $param['graduated_number_type'] = $request->filter_graduated_number_type;
            $DBParam['graduated_number'] = $request->filter_graduated_number;
            $DBParam['graduated_number_type'] = $request->filter_graduated_number_type;
        } else {
            $DBParam['graduated_number'] = null;
            $DBParam['graduated_number_type'] = null;
        }
        if ($request->faculty_activate) {
            $activate = true;
            $param['faculties'] = $request->filter_faculty;
            $DBParam['faculties'] = $request->filter_faculty;
        } else {
            $DBParam['faculties'] = null;
        }
        if (isset($request->save)) {
            if ($filter->count() > 0) {
                $filter->update($DBParam);
            } else {
                $DBParam['user_id'] = Auth::id();
                Filter::create($DBParam);
            }
        }
        if ($activate) {
            $param['filter'] = 1;
            return redirect()->route('recruit', $param);
        }
        return redirect()->route('recruit',$param);
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

    public function searchResult(Request $request) {
        $data = [

        ];
        return view('recruit.searchResult', $data);
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
