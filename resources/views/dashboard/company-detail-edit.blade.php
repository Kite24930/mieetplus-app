<x-dashboard-template title="管理画面" css="dashboard/companyDetail.css">
    <x-dashboard.company-header>

    </x-dashboard.company-header>
    <main class="w-full flex flex-col py-6 px-4 mb-10">
        @if(isset($msg))
            <div>
                <h1 class="text-3xl bg-yellow-500 underline p-3 inline-block rounded">{{ $msg }}</h1>
            </div>
        @endif
        @if($errors->count() > 0)
            <div>
                <ul class="text-xl bg-yellow-500 text-red-500 underline p-3 inline-block rounded">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form id="form" action="{{ route('companyDetailEditPost', $id) }}" method="POST" class="w-full" enctype="multipart/form-data">
            @csrf
            <h2 class="text-2xl m-3">企業情報</h2>
            <table class="bg-white w-full border border-green-600 rounded">
                <tbody class="w-full">
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>企業名</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="name" class="w-full" placeholder="企業名" type="text" name="name" :value="isset($company) ? $company->name : old('name')" required />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>企業名ふりがな</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="ruby" class="w-full" placeholder="企業名ふりがな" type="text" name="ruby" :value="isset($company) ? $company->ruby : old('ruby')" required />
                            <x-input-error :messages="$errors->get('ruby')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>業種</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-input-select id="category" class="w-full" name="category" required style="color: #ACB6BE">
                                <option value="placeholder" disabled @if(!isset($company)) selected @endif class="hidden">業種</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->name }}" @if(isset($company)) @if($company->category == $category->name) selected @endif @else @if(old('category') == $category->name) selected @endif @endif>{{ $category->name }}</option>
                                @endforeach
                            </x-input-select>
                            <x-input-error :messages="$errors->get('category')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>Webサイト</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="url" class="w-full" placeholder="https://example.com/recruit" type="url" name="url" :value="isset($company) ? $company->url : old('url')" />
                            <a id="urlCheck" href="@if(isset($company)) $company->url @endif" target="_blank" class="underline"><i class="bi bi-box-arrow-up-right"></i>リンクを確認(<span id="urlLink"></span>)</a>
                            <x-input-error :messages="$errors->get('url')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>本社所在地</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="location" class="w-full" placeholder="本社所在地" type="text" name="location" :value="isset($company) ? $company->location : old('location')" required />
                            <x-input-error :messages="$errors->get('location')" class="mt-2" />
                            <div class="mt-3">
                                <button id="addressToMap" type="button" class="green-btn px-3 text-sm">
                                    住所をマップに反映
                                </button>
                            </div>
                            <div id="map" class="w-full h-[400px] mt-3 rounded">

                            </div>
                            <x-text-input id="location_lat" type="hidden" name="location_lat" :value="isset($company) ? $company->location_lat : old('location_lat')" required />
                            <x-text-input id="location_lng" type="hidden" name="location_lng" :value="isset($company) ? $company->location_lng : old('location_lng')" required />
                            <label for="map" class="text-sm">
                                マップ上で本社所在地にピンを合わせてください。
                                <br>
                                ピンはドラッグで移動できます。
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>勤務地</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="work_location" class="w-full" placeholder="勤務地" type="text" name="work_location" :value="isset($company) ? $company->work_location : old('work_location')" required />
                            <label for="work_location" class="text-sm">
                                例）三重県津市、大阪府大阪市、東京都千代田区
                            </label>
                            <x-input-error :messages="$errors->get('work_location')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>設立年月</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="establishment_date" class="w-40" placeholder="設立年月" type="month" name="establishment_date" :value="isset($company) ? date('Y-m', strtotime($company->establishment_date)) : old('establishment_date')" required />
                            <x-input-error :messages="$errors->get('establishment_date')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>資本金</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-start items-center">
                                <x-text-input id="capital" class="w-32 text-right no-spin" placeholder="資本金" type="number" name="capital" :value="isset($company) ? $company->capital : old('capital')" required />
                                <div>
                                    百万円
                                </div>
                            </div>
                            <label for="capital" class="text-sm">
                                ※百万円単位
                            </label>
                            <x-input-error :messages="$errors->get('capital')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>売上金</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-start items-center">
                                <x-text-input id="sales" class="w-32 text-right no-spin" placeholder="売上金" type="number" name="sales" :value="isset($company) ? $company->sales : old('sales')" />
                                <div>
                                    百万円
                                </div>
                            </div>
                            <label for="sales" class="text-sm">
                                ※百万円単位
                            </label>
                            <x-input-error :messages="$errors->get('sales')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>従業員数</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-start items-center">
                                <x-text-input id="employee_number" class="w-32 text-right no-spin" placeholder="従業員数" type="number" name="employee_number" :value="isset($company) ? $company->employee_number : old('employee_number')" required />
                                <div>
                                    人
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('employee_number')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>三重大学OB・OG数</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex justify-start items-center">
                                <x-text-input id="graduated_number" class="w-32 text-right no-spin" placeholder="OB・OG数" type="number" name="graduated_number" :value="isset($company) ? $company->graduated_number : old('graduated_number')" />
                                <div>
                                    人
                                </div>
                            </div>
                            <x-input-error :messages="$errors->get('graduated_number')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>事業内容</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="contents" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="contents" id="contents" class="hidden" required>@if(isset($company)) {{ $company->content }} @else {{ old('contents') }} @endif</textarea>
                            <label for="contents" class="text-sm">
                                企業の事業内容を入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                            </label>
                            <x-input-error :messages="$errors->get('contents')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>企業PR</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="pr" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="pr" id="pr" class="hidden">@if(isset($company)) {{ $company->pr }} @else {{ old('pr') }} @endif</textarea>
                            <label for="pr" class="text-sm">
                                企業のPRを入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                            </label>
                            <x-input-error :messages="$errors->get('pr')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>実際の仕事内容</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="job_description" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="job_description" id="job_description" class="hidden">@if(isset($company)) {{ $company->job_description }} @else {{ old('job_description') }} @endif</textarea>
                            <label for="job_description" class="text-sm">
                                採用後に実際に行う業務の内容を具体的に入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                                <br>
                                <span class="text-green-500">※登録しない場合はTellersと同様の内容が表示されます。</span>
                            </label>
                            <x-input-error :messages="$errors->get('job_description')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>社内の雰囲気・社風</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="culture" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="culture" id="culture" class="hidden">@if(isset($company)) {{ $company->culture }} @else {{ old('culture') }} @endif</textarea>
                            <label for="culture" class="text-sm">
                                どんな雰囲気で仕事をしているのか、職場がどんな空気感で仕事をしているのか、社員同士の関係性などを入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                                <br>
                                <span class="text-green-500">※登録しない場合はTellersと同様の内容が表示されます。</span>
                            </label>
                            <x-input-error :messages="$errors->get('culture')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>労働環境</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="environment" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="environment" id="environment" class="hidden">@if(isset($company)) {{ $company->environment }} @else {{ old('environment') }} @endif</textarea>
                            <label for="environment" class="text-sm">
                                現代の就活生はワークライフバランスを重視しています。
                                <br>
                                残業時間がどのくらいあるのか、休日出勤はあるのか、年間休日日数や休日パターンなどの情報を入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                                <br>
                                <span class="text-green-500">※登録しない場合はTellersと同様の内容が表示されます。</span>
                            </label>
                            <x-input-error :messages="$errors->get('environment')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>他社と比べた強み・弱み</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="feature" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="feature" id="feature" class="hidden" required>@if(isset($company)) {{ $company->feature }} @else {{ old('feature') }} @endif</textarea>
                            <label for="feature" class="text-sm">
                                貴社の強みと弱みを入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                            </label>
                            <x-input-error :messages="$errors->get('feature')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>キャリアパス</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="career_path" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="career_path" id="career_path" class="hidden" required>@if(isset($company)) {{ $company->career_path }} @else {{ old('career_path') }} @endif</textarea>
                            <label for="career_path" class="text-sm">
                                キャリアパスを入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                            </label>
                            <x-input-error :messages="$errors->get('career_path')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>求める能力・人物像</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="desired_person" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="desired_person" id="desired_person" class="hidden" required>@if(isset($company)) {{ $company->desired_person }} @else {{ old('desired_person') }} @endif</textarea>
                            <label for="desired_person" class="text-sm">
                                求める能力・人物像を入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                            </label>
                            <x-input-error :messages="$errors->get('desired_person')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>転勤・異動</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="transfer" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="transfer" id="transfer" class="hidden" required>@if(isset($company)) {{ $company->transfer }} @else {{ old('transfer') }} @endif</textarea>
                            <label for="transfer" class="text-sm">
                                転勤の有無や頻度、異動の有無や頻度、制度などを入力してください。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                            </label>
                            <x-input-error :messages="$errors->get('transfer')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>お知らせ</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div data-target="notice" class="editor relative z-10 w-full">

                            </div>
                            <textarea name="notice" id="notice" class="hidden">@if(isset($company)) {{ $company->notice }} @else {{ old('notice') }} @endif</textarea>
                            <label for="notice" class="text-sm">
                                企業詳細ページにお知らせなどを表示できます。
                                <br>
                                例）採用情報の更新、イベントの開催など
                                <br>
                                自由に入力していただけます。
                                <br>
                                ※表や画像はPCでは画面幅の50%程度、スマートフォンでは表示領域の100%のサイズで表示されます
                            </label>
                            <x-input-error :messages="$errors->get('notice')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>対象学部</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <div class="flex gap-9">
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <input id="humanities" type="checkbox" value="人文学部" class="faculties">
                                        <label for="humanities">人文学部</label>
                                    </div>
                                    <div>
                                        <input id="education" type="checkbox" value="教育学部" class="faculties">
                                        <label for="education">教育学部</label>
                                    </div>
                                    <div>
                                        <input id="medicine" type="checkbox" value="医学部" class="faculties">
                                        <label for="medicine">医学部</label>
                                    </div>
                                    <div>
                                        <input id="engineering" type="checkbox" value="工学部" class="faculties">
                                        <label for="engineering">工学部</label>
                                    </div>
                                    <div>
                                        <input id="bioresources" type="checkbox" value="生物資源学部" class="faculties">
                                        <label for="bioresources">生物資源学部</label>
                                    </div>
                                </div>
                                <div class="flex flex-col gap-3">
                                    <div>
                                        <input id="humanities_grad" type="checkbox" value="人文社会科学研究科" class="faculties">
                                        <label for="humanities_grad">人文社会科学研究科</label>
                                    </div>
                                    <div>
                                        <input id="education_grad" type="checkbox" value="教育学研究科" class="faculties">
                                        <label for="education_grad">教育学研究科</label>
                                    </div>
                                    <div>
                                        <input id="medicine_grad" type="checkbox" value="医学系研究科" class="faculties">
                                        <label for="medicine_grad">医学系研究科</label>
                                    </div>
                                    <div>
                                        <input id="engineering_grad" type="checkbox" value="工学研究科" class="faculties">
                                        <label for="engineering_grad">工学研究科</label>
                                    </div>
                                    <div>
                                        <input id="bioresources_grad" type="checkbox" value="生物資源学研究科" class="faculties">
                                        <label for="bioresources_grad">生物資源学研究科</label>
                                    </div>
                                    <div>
                                        <input id="regional_innovation" type="checkbox" value="地域イノベーション学研究科" class="faculties">
                                        <label for="regional_innovation">地域イノベーション学研究科</label>
                                    </div>
                                </div>
                            </div>
                            <x-text-input id="faculties" class="hidden" type="hidden" name="faculties" :value="isset($company) ? $company->faculties : old('faculties')" required />
                            <x-input-error :messages="$errors->get('faculties')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>募集職種</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="occupations" class="w-full" placeholder="募集職種" type="text" name="occupations" :value="isset($company) ? $company->occupations : old('occupations')" />
                            <x-input-error :messages="$errors->get('occupations')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>採用担当者名</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="recruit_name" class="w-full" placeholder="採用担当者名" type="text" name="recruit_name" :value="isset($company) ? $company->recruit_name : old('recruit_name')" />
                            <x-input-error :messages="$errors->get('recruit_name')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>採用担当者ふりがな</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="recruit_ruby" class="w-full" placeholder="採用担当者ふりがな" type="text" name="recruit_ruby" :value="isset($company) ? $company->recruit_ruby : old('recruit_ruby')" />
                            <x-input-error :messages="$errors->get('recruit_ruby')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>採用担当者メールアドレス</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            <x-text-input id="recruit_email" class="w-full" placeholder="採用担当者メールアドレス" type="email" name="recruit_email" :value="isset($company) ? $company->recruit_email : old('recruit_email')" />
                            <x-input-error :messages="$errors->get('recruit_email')" class="mt-2" />
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>TOP画像</div>
                                <div class="badge bg-red text-white p-1 rounded">必須</div>
                            </div>
                        </td>
                        <td class="p-4 flex justify-start gap-5">
                            <div>
                                <input id="top_img" name="top_img" type="file" accept="image/jpeg,image/png" class="hidden">
                                <div>
                                    <label for="top_img" class="green-btn px-3">ファイルを選択</label>
                                    <br>
                                    <div id="top_img_file" class="ml-3 omission w-80 inline-block mt-4">ファイルが選択されていません</div>
                                </div>
                                <br>
                                <div class="text-sm">
                                    <span class="text-base text-green-500">※JPEG, PNGのみ</span>
                                    <br>
                                    投稿画像としての使用及び企業情報詳細画面の最上部に表示されます。
                                    <br>
                                    ※2MB以上のファイルを選択するとアップロードできない場合があります。
                                </div>
                                <x-input-error :messages="$errors->get('top_img')" class="mt-2" />
                                <div class="flex flex-col items-end mt-5">
                                    詳細画面TOP画像
                            @if(isset($company))
                                    <img src="{{ asset('storage/company/'.$company->id.'/'.$company->top_img) }}" alt="{{ $company->name }}" class="w-60 h-32 top_img object-cover border border-green-600">
                                </div>
                            </div>
                            <div class="text-right ms-5 w-60">
                                投稿用表示
                                <div id="top_img_check">
                                    <img src="{{ asset('storage/company/'.$company->id.'/'.$company->top_img) }}" alt="{{ $company->name }}" class="border border-green-600 top_img">
                                </div>
                            @else
                                    <img src="http://via.placeholder.com/240x240" alt="placeholder" class="w-60 h-32 top_img object-cover border border-green-600">
                                </div>
                            </div>
                            <div class="text-right ms-5 w-60">
                                投稿用表示
                                <div id="top_img_check">
                                    <img src="http://via.placeholder.com/240x240" alt="placeholder" class="border border-green-600 top_img">
                                </div>
                            @endif
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>ロゴ画像</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4 flex justify-start">
                            <div>
                                <input id="logo" name="logo" type="file" accept="image/jpeg,image/png" class="hidden">
                                <div>
                                    <label for="logo" class="green-btn px-3">ファイルを選択</label>
                                    <br>
                                    <span id="logo_file" class="ml-3 omission w-80 inline-block mt-4">ファイルが選択されていません</span>
                                </div>
                                <br>
                                <div class="text-sm">
                                    <span class="text-base text-green-500">※JPEG, PNGのみ</span>
                                    <br>
                                    アイコン画像として使用します。
                                    <br>
                                    設定されない場合は、TOP画像がアイコン画像として使用されます。
                                    <br>
                                    ※2MB以上のファイルを選択するとアップロードできない場合があります。
                                </div>
                                <x-input-error :messages="$errors->get('logo')" class="mt-2" />
                            </div>
                            @if(isset($company))
                            <div class="text-right">
                                アイコン表示
                                <img src="{{ asset('storage/company/'.$company->id.'/'.$company->logo) }}" alt="{{ $company->name }}" class="w-24 h-24 logo object-cover rounded-full border border-green-600">
                            </div>
                            @else
                            <div class="text-right">
                                アイコン表示
                                <img src="http://via.placeholder.com/100x100" alt="placeholder" class="w-24 h-24 logo object-cover rounded-full border border-green-600">
                            </div>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">
                            <div class="w-full flex justify-start items-center gap-2">
                                <div>PR動画</div>
                                <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                            </div>
                        </td>
                        <td class="p-4">
                            Mieet Plus 就活部では、貴社のPR動画も掲載できます。
                            <br>
                            動画の掲載をご希望の場合は、以下の動画掲載希望メールボタンより必要事項を入力し、ご連絡ください。
                            <br>
                            動画の送信方法としては、圧縮ファイルをメールに添付していただくか、Googleドライブなどのクラウドストレージにアップロードしていただき、そのURLをメールに添付していただくか、GigaFile便などのファイル転送サービスをご利用いただくかのいずれかとなります。
                            <br>
                            【掲載方法】
                            <br>
                            お送りいただいた動画を、Mieet Plus 就活部のYouTubeチャンネルに掲載いたします。その後、貴社の企業情報詳細画面に動画を埋め込みます。
                            <br>
                            <button id="movie_request" type="button" class="green-btn px-3">
                                動画掲載希望メール
                            </button>
                            <x-input-error :messages="$errors->get('recruit_email')" class="mt-2" />
                        </td>
                    </tr>
                </tbody>
            </table>
            <h2 class="text-2xl m-3">Tellers設定</h2>
            <table class="tellers bg-white w-full border border-green-600 rounded">
                <tbody class="w-full">
                <tr>
                    <td class="align-middle back-grey-50 p-4" colspan="2">
                        <div class="w-full flex justify-start items-center gap-2">
                            <div>実際の仕事内容</div>
                            <div class="badge bg-red text-white p-1 rounded">必須</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">
                        <div data-target="job_description_tellers" class="tellers-editor relative z-10 w-full" data-bs-target="job_description_preview_container" data-bs-button="job_description_preview_btn" data-bs-background="tellers_img_1_url" data-bs-preview="job_description_preview">

                        </div>
                        <textarea name="job_description_tellers" id="job_description_tellers" class="hidden">@if(isset($company)) {{ $company->job_description_tellers }} @else {{ old('job_description_tellers') }} @endif</textarea>
                        <label for="job_description_tellers" class="text-sm">
                            採用後に実際に行う業務の内容を具体的に入力してください。
                            <br>
                            ※表や画像は表示領域の100%のサイズで表示されます
                        </label>
                        <x-input-error :messages="$errors->get('job_description_tellers')" class="mt-2" />
                        <hr>
                        <div class="flex items-center gap-2 mt-4">
                            <h2>背景画像</h2>
                            <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                        </div>
                        <input id="tellers_img_1" name="tellers_img_1" type="file" accept="image/jpeg,image/png" class="hidden tellers-img" data-bs-target="job_description_preview" data-bs-label="tellers_img_1_file">
                        <div class="mt-5">
                            <label for="tellers_img_1" class="green-btn px-5">ファイルを選択</label>
                            <br>
                            <div id="tellers_img_1_file" class="ml-3 mt-4 omission">ファイルが選択されていません</div>
                        </div>
                        <br>
                        <div class="text-sm">
                            <span class="text-base text-green-500">※JPEG, PNGのみ</span>
                            <br>
                            Tellers[実際の仕事内容]の背景として使用します。
                            <br>
                            設定されない場合は、サンプル画像が背景として使用されます。
                            <br>
                            ※2MB以上のファイルを選択するとアップロードできない場合があります。
                        </div>
                        <input type="hidden" id="tellers_img_1_url" value="@if(isset($company)) {{ asset('storage/company/'.$company->id.'/'.$company->tellers_img_1) }} @else https://via.placeholder.com/480x640.png/007799?text=cats+perferendis @endif">
                        <x-input-error :messages="$errors->get('tellers_img_1')" class="mt-2" />
                    </td>
                    <td class="flex-center-box flex-col p-4">
                        <button id="job_description_preview_btn" type="button" class="green-btn px-3 mb-3" data-target="job_description_preview_container" data-bs-text="job_description_tellers">プレビュー更新</button>
                        <div id="job_description_preview" class="w-[207px] h-[460px] preview relative flex-center-box">
                            <div class="absolute top-0 left-0 w-full flex flex-col mt-3 text-2xs">
                                <div class="progress-wrapper w-full flex justify-evenly">
                                    <div class="progress-bar mx-1"></div>
                                    <div class="progress-bar mx-1"></div>
                                    <div class="progress-bar mx-1"></div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div class="flex flex-col ml-2">
                                        <div class="flex justify-start items-center">
                                            <img src="http://via.placeholder.com/25x25" alt="icon" class="company-img rounded-full">
                                            <div class="company-name px-2 text-white">
                                                @if(isset($companyName))
                                                    {{ $companyName }}
                                                @else
                                                    株式会社　〇〇〇〇
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="follow-btn border rounded px-2 py-1 text-white inline-block">
                                                <i class="bi bi-balloon-heart-fill text-white"></i>
                                                フォローする
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 text-2xl">
                                        <i class="bi bi-x-lg text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full text-white text-2xs p-2 break-words break-all">
                                <div class="text-sm text-white">【実際の仕事内容】</div>
                                <div id="job_description_preview_container" class="container w-full  p-2 break-words break-all">

                                </div>
                            </div>
                            <div class="absolute bottom-0 right-0 w-full">
                                <div class="w-full flex justify-between items-end text-2xl p-4">
                                    <div><i class="bi bi-arrow-left-circle-fill text-white"></i></div>
                                    <div class="text-base text-white">1/3</div>
                                    <div><i class="bi bi-arrow-right-circle-fill text-white"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-green-500">
                            ※あくまでもプレビューですので、実際の表示とは異なる場合があります。
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="tellers bg-white w-full my-3 border border-green-600 rounded">
                <tbody class="w-full">
                <tr>
                    <td class="align-middle back-grey-50 p-4" colspan="2">
                        <div class="w-full flex justify-start items-center gap-2">
                            <div>社内の雰囲気・社風</div>
                            <div class="badge bg-red text-white p-1 rounded">必須</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">
                        <div data-target="culture_tellers" class="tellers-editor relative z-10 w-full" data-bs-target="culture_preview_container" data-bs-button="culture_preview_btn" data-bs-background="tellers_img_2_url" data-bs-preview="culture_preview">

                        </div>
                        <textarea name="culture_tellers" id="culture_tellers" class="hidden">@if(isset($company)) {{ $company->culture_tellers }} @else {{ old('culture_tellers') }} @endif</textarea>
                        <label for="culture_tellers" class="text-sm">
                            社内の雰囲気や社風など、普段の業務を行う時の空気感が伝わる内容を入力してください。
                            <br>
                            ※表や画像は表示領域の100%のサイズで表示されます
                        </label>
                        <x-input-error :messages="$errors->get('culture_tellers')" class="mt-2" />
                        <hr>
                        <div class="flex items-center gap-2 mt-4">
                            <h2>背景画像</h2>
                            <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                        </div>
                        <input id="tellers_img_2" name="tellers_img_2" type="file" accept="image/jpeg,image/png" class="hidden tellers-img" data-bs-target="culture_preview" data-bs-label="tellers_img_2_file">
                        <div class="mt-5">
                            <label for="tellers_img_2" class="green-btn px-5">ファイルを選択</label>
                            <br>
                            <div id="tellers_img_2_file" class="ml-3 mt-4 omission">ファイルが選択されていません</div>
                        </div>
                        <br>
                        <div class="text-sm">
                            <span class="text-base text-green-500">※JPEG, PNGのみ</span>
                            <br>
                            Tellers[社内の雰囲気・社風]の背景として使用します。
                            <br>
                            設定されない場合は、サンプル画像が背景として使用されます。
                            <br>
                            ※2MB以上のファイルを選択するとアップロードできない場合があります。
                        </div>
                        <input type="hidden" id="tellers_img_2_url" value="@if(isset($company)) {{ asset('storage/company/'.$company->id.'/'.$company->tellers_img_2) }} @else https://via.placeholder.com/480x640.png/007799?text=cats+perferendis @endif">
                        <x-input-error :messages="$errors->get('tellers_img_1')" class="mt-2" />
                    </td>
                    <td class="flex-center-box flex-col p-4">
                        <button id="culture_preview_btn" type="button" class="green-btn px-3 mb-3" data-target="culture_preview_container" data-bs-text="culture_tellers">プレビュー更新</button>
                        <div id="culture_preview" class="w-[207px] h-[460px] preview relative flex-center-box">
                            <div class="absolute top-0 left-0 w-full flex flex-col mt-3 text-2xs">
                                <div class="progress-wrapper w-full flex justify-evenly">
                                    <div class="progress-bar mx-1"></div>
                                    <div class="progress-bar mx-1"></div>
                                    <div class="progress-bar mx-1"></div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div class="flex flex-col ml-2">
                                        <div class="flex justify-start items-center">
                                            <img src="http://via.placeholder.com/25x25" alt="icon" class="company-img rounded-full">
                                            <div class="company-name px-2 text-white">
                                                @if(isset($companyName))
                                                    {{ $companyName }}
                                                @else
                                                    株式会社　〇〇〇〇
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="follow-btn border rounded px-2 py-1 text-white inline-block">
                                                <i class="bi bi-balloon-heart-fill text-white"></i>
                                                フォローする
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 text-2xl">
                                        <i class="bi bi-x-lg text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full text-white text-2xs p-2 break-words break-all">
                                <div class="text-sm text-white">【社内の雰囲気・社風】</div>
                                <div id="culture_preview_container" class="container w-full  p-2 break-words break-all">

                                </div>
                            </div>
                            <div class="absolute bottom-0 right-0 w-full">
                                <div class="w-full flex justify-between items-end text-2xl p-4">
                                    <div><i class="bi bi-arrow-left-circle-fill text-white"></i></div>
                                    <div class="text-base text-white">2/3</div>
                                    <div><i class="bi bi-arrow-right-circle-fill text-white"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-green-500">
                            ※あくまでもプレビューですので、実際の表示とは異なる場合があります。
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
            <table class="tellers bg-white w-full border border-green-600 rounded">
                <tbody class="w-full">
                <tr>
                    <td class="align-middle back-grey-50 p-4" colspan="2">
                        <div class="w-full flex justify-start items-center gap-2">
                            <div>労働環境</div>
                            <div class="badge bg-red text-white p-1 rounded">必須</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="p-4">
                        <div data-target="environment_tellers" class="tellers-editor relative z-10 w-full" data-bs-target="environment_preview_container" data-bs-button="environment_preview_btn" data-bs-background="tellers_img_3_url" data-bs-preview="environment_preview">

                        </div>
                        <textarea name="environment_tellers" id="environment_tellers" class="hidden">@if(isset($company)) {{ $company->environment_tellers }} @else {{ old('environment_tellers') }} @endif</textarea>
                        <label for="environment_tellers" class="text-sm">
                            普段の残業の頻度や時間、休日出勤の頻度や休日のパターンなど、
                            <br>
                            ワークライフバランスに関わる内容を入力してください。
                            <br>
                            ※表や画像は表示領域の100%のサイズで表示されます
                        </label>
                        <x-input-error :messages="$errors->get('environment_tellers')" class="mt-2" />
                        <hr>
                        <div class="flex items-center gap-2 mt-4">
                            <h2>背景画像</h2>
                            <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                        </div>
                        <input id="tellers_img_3" name="tellers_img_3" type="file" accept="image/jpeg,image/png" class="hidden tellers-img" data-bs-target="environment_preview" data-bs-label="tellers_img_3_file">
                        <div class="mt-5">
                            <label for="tellers_img_3" class="green-btn px-5">ファイルを選択</label>
                            <br>
                            <div id="tellers_img_3_file" class="ml-3 mt-4 omission">ファイルが選択されていません</div>
                        </div>
                        <br>
                        <div class="text-sm">
                            <span class="text-base text-green-500">※JPEG, PNGのみ</span>
                            <br>
                            Tellers[労働環境]の背景として使用します。
                            <br>
                            設定されない場合は、サンプル画像が背景として使用されます。
                            <br>
                            ※2MB以上のファイルを選択するとアップロードできない場合があります。
                        </div>
                        <input type="hidden" id="tellers_img_3_url" value="@if(isset($company)) {{ asset('storage/company/'.$company->id.'/'.$company->tellers_img_3) }} @else https://via.placeholder.com/480x640.png/007799?text=cats+perferendis @endif">
                        <x-input-error :messages="$errors->get('tellers_img_1')" class="mt-2" />
                    </td>
                    <td class="flex-center-box flex-col p-4">
                        <button id="environment_preview_btn" type="button" class="green-btn px-3 mb-3" data-target="environment_preview_container" data-bs-text="environment_tellers">プレビュー更新</button>
                        <div id="environment_preview" class="w-[207px] h-[460px] preview relative flex-center-box">
                            <div class="absolute top-0 left-0 w-full flex flex-col mt-3 text-2xs">
                                <div class="progress-wrapper w-full flex justify-evenly">
                                    <div class="progress-bar mx-1"></div>
                                    <div class="progress-bar mx-1"></div>
                                    <div class="progress-bar mx-1"></div>
                                </div>
                                <div class="flex justify-between mt-2">
                                    <div class="flex flex-col ml-2">
                                        <div class="flex justify-start items-center">
                                            <img src="http://via.placeholder.com/25x25" alt="icon" class="company-img rounded-full">
                                            <div class="company-name px-2 text-white">
                                                @if(isset($companyName))
                                                    {{ $companyName }}
                                                @else
                                                    株式会社　〇〇〇〇
                                                @endif
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <div class="follow-btn border rounded px-2 py-1 text-white inline-block">
                                                <i class="bi bi-balloon-heart-fill text-white"></i>
                                                フォローする
                                            </div>
                                        </div>
                                    </div>
                                    <div class="p-3 text-2xl">
                                        <i class="bi bi-x-lg text-white"></i>
                                    </div>
                                </div>
                            </div>
                            <div class="w-full text-white text-2xs p-2 break-words break-all">
                                <div class="text-sm text-white">【労働環境】</div>
                                <div id="environment_preview_container" class="container w-full p-2 break-words break-all">

                                </div>
                            </div>
                            <div class="absolute bottom-0 right-0 w-full">
                                <div class="w-full flex justify-between items-end text-2xl p-4">
                                    <div><i class="bi bi-arrow-left-circle-fill text-white"></i></div>
                                    <div class="text-base text-white">3/3</div>
                                    <div><i class="bi bi-arrow-right-circle-fill text-white"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="text-sm text-green-500">
                            ※あくまでもプレビューですので、実際の表示とは異なる場合があります。
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </main>
    <footer class="flex flex-col justify-start items-center z-50">
        <div class="flex-center-box p-3 w-80 gap-3">
            <button type="button" id="dropdown" class="text-3xl hidden">
                <i class="bi bi-list"></i>
            </button>
            <button type="button" id="preview" class="green-btn w-full hidden">
                プレビュー
            </button>
            <button type="button" id="submit" class="green-btn w-full">
                保存する
            </button>
        </div>
    </footer>
    @vite(['resources/js/dashboard/company/companyDetailEdit.js'])
</x-dashboard-template>
