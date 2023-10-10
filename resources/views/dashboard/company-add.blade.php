<x-dashboard-template title="企業アカウント" css="dashboard/dashboard.css">
    <x-dashboard.admin-header>

    </x-dashboard.admin-header>
    <main class="w-full py-6 px-4 flex justify-center">
        <div class="w-full max-w-xl px-4 py-8 rounded-3xl bg-white flex-center-box flex-col">
            <h1 class="text-4xl">企業アカウント発行</h1>
            <form method="POST" action="{{ route('companyAddPost') }}" class="w-full">
                @csrf
                <!-- Name -->
                <div class="my-8">
                    <x-text-input id="name" class="block mt-1 w-full h-12" placeholder="企業名" type="text" name="name" :value="old('name')" autofocus required autocomplete="name" />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email Address -->
                <div class="my-8">
                    <x-text-input id="email" class="block mt-1 w-full h-12" placeholder="メールアドレス" type="email" name="email" :value="old('email')" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <x-primary-button id="register" class="green-btn w-full">
                    企業アカウント発行
                </x-primary-button>
            </form>
        </div>
    </main>
    @vite(['resources/js/dashboard/companyAdd.js'])
</x-dashboard-template>
