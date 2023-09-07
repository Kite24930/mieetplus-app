<x-dashboard-template title="学生アカウント">
    <x-dashboard.admin-header>

    </x-dashboard.admin-header>
    <main class="w-full py-6 px-4">
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
            <h2 class="text-2xl m-3">学生アカウント詳細</h2>
            <table class="bg-white w-full border border-green-600 rounded">
                <tbody class="w-full">
                    <tr>
                        <td class="align-middle back-grey-50 p-4">ID</td>
                        <td class="p-4">{{ $student->id }}</td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">USER ID</td>
                        <td class="p-4">{{ $student->user_id }}</td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">氏名</td>
                        <td class="p-4">{{ $student->name }}</td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">ログインメール</td>
                        <td class="p-4">{{ $student->email }}</td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">学籍メール</td>
                        <td class="p-4">{{ $student->univ_email }}</td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">学部</td>
                        <td class="p-4">{{ $student->faculty }}</td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">学年</td>
                        <td class="p-4">{{ $student->glade }}</td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">表示名</td>
                        <td class="p-4">
                            @if(isset($student->screen_name))
                                {{ $student->screen_name }}
                            @else
                                (未設定)
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">トップ画像</td>
                        <td class="p-4">
                            @if(isset($student->img))
                                <img src="{{ asset('storage/student/'.$student->user_id.'/'.$student->img) }}" alt="{{ $student->name }}" class="h-32 w-32 object-cover rounded-full mieet-border">
                            @else
                                (未設定)
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">通知メール設定</td>
                        <td class="p-4">
                            @if($student->notice === 1)
                                通知する
                            @else
                                通知しない
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td class="align-middle back-grey-50 p-4">閲覧履歴設定</td>
                        <td class="p-4">
                            @if($student->history === 1)
                                履歴の使用を許可
                            @else
                                履歴の使用を許可しない
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    @vite(['resources/js/dashboard/studentDetail.js'])
</x-dashboard-template>
