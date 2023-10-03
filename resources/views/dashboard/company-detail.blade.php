<x-dashboard-template title="管理画面">
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
        <div class="w-full">
            <h2 class="text-2xl m-3">企業情報詳細</h2>
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
                        {{ $company->name }}
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
                        {{ $company->ruby }}
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
                        {{ $company->category }}
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
                        @if(isset($company->url))
                            <a href="{{ $company->url }}" target="_blank" class="underline"><i class="bi bi-box-arrow-up-right"></i>{{ $company->url }}</a>
                        @else
                            <span class="text-grey-500">未登録</span>
                        @endif
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
                        {{ $company->location }}
                        <div id="map" class="w-full h-[400px] mt-3 rounded">

                        </div>
                        <x-text-input id="location_lat" type="hidden" name="location_lat" :value="isset($company) ? $company->location_lat : old('location_lat')" required />
                        <x-text-input id="location_lng" type="hidden" name="location_lng" :value="isset($company) ? $company->location_lng : old('location_lng')" required />
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
                        {{ $company->work_location }}
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
                        {{ date('Y年m月', strtotime($company->establishment_date)) }}
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
                        {{ $company->capital }}百万円
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
                        @if(isset($company->sales))
                            {{ $company->sales }}百万円
                        @else
                            <span class="text-grey-500">未登録</span>
                        @endif
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
                        {{ $company->employee_number }}人
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
                        @if($company->graduated_number)
                            {{ $company->graduated_number }}人
                        @else
                            <span class="text-grey-500">未登録</span>
                        @endif
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
                        <div data-target="contents" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="contents" id="contents" class="hidden" required>@if(isset($company)) {{ $company->content }} @else {{ old('contents') }} @endif</textarea>
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
                        <div data-target="pr" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="pr" id="pr" class="hidden">@if(isset($company)) {{ $company->pr }} @else {{ old('pr') }} @endif</textarea>
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
                        <div data-target="job_description" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="job_description" id="job_description" class="hidden">@if(isset($company)) {{ $company->job_description }} @else {{ old('job_description') }} @endif</textarea>
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
                        <div data-target="culture" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="culture" id="culture" class="hidden">@if(isset($company)) {{ $company->culture }} @else {{ old('culture') }} @endif</textarea>
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
                        <div data-target="environment" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="environment" id="environment" class="hidden">@if(isset($company)) {{ $company->environment }} @else {{ old('environment') }} @endif</textarea>
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
                        <div data-target="feature" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="feature" id="feature" class="hidden" required>@if(isset($company)) {{ $company->feature }} @else {{ old('feature') }} @endif</textarea>
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
                        <div data-target="career_path" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="career_path" id="career_path" class="hidden" required>@if(isset($company)) {{ $company->career_path }} @else {{ old('career_path') }} @endif</textarea>
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
                        <div data-target="desired_person" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="desired_person" id="desired_person" class="hidden" required>@if(isset($company)) {{ $company->desired_person }} @else {{ old('desired_person') }} @endif</textarea>
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
                        <div data-target="transfer" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="transfer" id="transfer" class="hidden" required>@if(isset($company)) {{ $company->transfer }} @else {{ old('transfer') }} @endif</textarea>
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
                        <div data-target="notice" class="viewer relative z-10 w-full">

                        </div>
                        <textarea name="notice" id="notice" class="hidden">@if(isset($company)) {{ $company->notice }} @else {{ old('notice') }} @endif</textarea>
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
                        {{ $company->faculties }}
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
                        {{ $company->occupations }}
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
                        {{ $company->recruit_name }}
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
                        {{ $company->recruit_ruby }}
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
                        {{ $company->recruit_email }}
                    </td>
                </tr>
                <tr>
                    <td class="align-middle back-grey-50 p-4">
                        <div class="w-full flex justify-start items-center gap-2">
                            <div>TOP画像</div>
                            <div class="badge bg-red text-white p-1 rounded">必須</div>
                        </div>
                    </td>
                    <td class="p-4 flex justify-start items-center">
                        <div class="flex flex-col justify-start items-center mt-5">
                            詳細画面TOP画像
                            @if(isset($company))
                                <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}" alt="{{ $company->name }}" class="w-60 h-32 top_img object-cover border border-green-600">
                        </div>
                        <div class="text-right ms-5 w-60">
                            投稿用表示
                            <div id="top_img_check">
                                <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}" alt="{{ $company->name }}" class="border border-green-600 top_img">
                            </div>
                            @else
                                <img src="http://via.placeholder.com/240x240" alt="placeholder" class="w-60 h-32 top_img object-cover border border-green-600">
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
                        @if(isset($company->logo))
                            <div class="text-right">
                                アイコン表示
                                <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->logo) }}" alt="{{ $company->name }}" class="w-24 h-24 logo object-cover rounded-full border border-green-600">
                            </div>
                        @else
                            <div class="text-right">
                                アイコン表示
                                <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->top_img) }}" alt="{{ $company->name }}" class="w-24 h-24 logo object-cover rounded-full border border-green-600">
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
                        @if(isset($company->movie))
                            <a href="{{ $company->movie }}">動画リンク</a>
                        @else
                            Mieet Plus 就活部では、貴社のPR動画も掲載できます。
                            <br>
                            動画の掲載をご希望の場合は、編集ページの動画掲載希望メールボタンより必要事項を入力し、ご連絡ください。
                            <br>
                            動画の送信方法としては、圧縮ファイルをメールに添付していただくか、Googleドライブなどのクラウドストレージにアップロードしていただき、そのURLをメールに添付していただくか、GigaFile便などのファイル転送サービスをご利用いただくかのいずれかとなります。
                            <br>
                            【掲載方法】
                            <br>
                            お送りいただいた動画を、Mieet Plus 就活部のYouTubeチャンネルに掲載いたします。その後、貴社の企業情報詳細画面に動画を埋め込みます。
                        @endif
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
                        <h2>テキストコンテンツ</h2>
                        <div data-target="job_description_tellers" class="viewer relative z-10 w-full border" data-bs-target="job_description_preview_container" data-bs-button="job_description_preview_btn" data-bs-background="tellers_img_1_url" data-bs-preview="job_description_preview">

                        </div>
                        <textarea name="job_description_tellers" id="job_description_tellers" class="hidden">@if(isset($company)) {{ $company->job_description_tellers }} @else {{ old('job_description_tellers') }} @endif</textarea>
                        <hr>
                        <div class="flex items-center gap-2 mt-4">
                            <h2>背景画像</h2>
                            <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                        </div>
                        <div id="tellers_img_1_file" class="ml-3 mt-4 omission">
                            @if($company->tellers_img_1)
                                {{ $company->tellers_img_1 }}
                                <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_1) }}" alt="{{ $company->name }}" class="w-auto h-60 object-cover border border-green-600 tellers-img" data-bs-target="job_description_preview">
                            @else
                                ファイルが選択されていません
                            @endif
                        </div>
                    </td>
                    <td class="flex-center-box flex-col p-4">
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
                                <div id="job_description_preview_container" data-target="job_description_tellers" class="viewer container w-full  p-2 break-words break-all">

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
                        <h2>テキストコンテンツ</h2>
                        <div data-target="culture_tellers" class="viewer relative z-10 w-full border" data-bs-target="culture_preview_container" data-bs-button="culture_preview_btn" data-bs-background="tellers_img_2_url" data-bs-preview="culture_preview">

                        </div>
                        <textarea name="culture_tellers" id="culture_tellers" class="hidden">@if(isset($company)) {{ $company->culture_tellers }} @else {{ old('culture_tellers') }} @endif</textarea>
                        <hr>
                        <div class="flex items-center gap-2 mt-4">
                            <h2>背景画像</h2>
                            <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                        </div>
                        <div class="mt-5">
                            <div id="tellers_img_2_file" class="ml-3 mt-4 omission">
                                @if($company->tellers_img_2)
                                    {{ $company->tellers_img_2 }}
                                    <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_2) }}" alt="{{ $company->name }}" class="w-auto h-60 object-cover border border-green-600 tellers-img" data-bs-target="culture_preview">
                                @else
                                    ファイルが選択されていません
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="flex-center-box flex-col p-4">
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
                                <div id="culture_preview_container" class="viewer container w-full  p-2 break-words break-all" data-target="culture_tellers">

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
                        <h2>テキストコンテンツ</h2>
                        <div data-target="environment_tellers" class="viewer relative z-10 w-full" data-bs-target="environment_preview_container" data-bs-button="environment_preview_btn" data-bs-background="tellers_img_3_url" data-bs-preview="environment_preview">

                        </div>
                        <textarea name="environment_tellers" id="environment_tellers" class="hidden">@if(isset($company)) {{ $company->environment_tellers }} @else {{ old('environment_tellers') }} @endif</textarea>
                        <hr>
                        <div class="flex items-center gap-2 mt-4">
                            <h2>背景画像</h2>
                            <div class="badge bg-gray-400 text-white p-1 rounded">任意</div>
                        </div>
                        <div class="mt-5">
                            <div id="tellers_img_3_file" class="ml-3 mt-4 omission">
                                @if($company->tellers_img_3)
                                    {{ $company->tellers_img_3 }}
                                    <img src="{{ asset('storage/company/'.$company->user_id.'/'.$company->tellers_img_3) }}" alt="{{ $company->name }}" class="w-auto h-60 object-cover border border-green-600 tellers-img" data-bs-target="environment_preview">
                                @else
                                    ファイルが選択されていません
                                @endif
                            </div>
                        </div>
                    </td>
                    <td class="flex-center-box flex-col p-4">
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
                                <div id="environment_preview_container" class="viewer container w-full p-2 break-words break-all" data-target="environment_tellers">

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
        </div>
    </main>
    <footer class="flex flex-col justify-start items-center z-50">
        <div class="flex-center-box p-3 w-80 gap-3">
            <a href="{{ route('companyDetailEdit', $company->id) }}" class="green-btn w-full text-center">
                編集する
            </a>
        </div>
    </footer>
    @vite(['resources/js/dashboard/company/companyDetail.js'])
</x-dashboard-template>
