<header class="fixed top-0 left-0 bg-white flex flex-col justify-start items-center">
    <a href="{{ route('index') }}">
        <img src="{{ asset('storage/mieet_plus_logo.png') }}" alt="Mieet Plus" class="w-36 mt-12 mb-6">
    </a>
    <div class="w-full px-5 my-9">
        <div class="green-background badge py-0.5 px-2 leading-normal rounded inline-block">
            ログイン中
        </div>
        <div class="py-1">
            <i class="bi bi-person-circle"></i><span class="text-xs">{{ Auth::user()->name }}</span>
        </div>
    </div>
    <div class="w-full px-3 mb-7 flex flex-col gap-2 text-sm">
        <a href="{{ route('dashboard') }}">
            <div class="flex justify-start items-center link rounded p-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M17.7895 12.5263H11.4737V6.21053C11.4737 5.93135 11.3628 5.66361 11.1654 5.4662C10.968 5.2688 10.7002 5.15789 10.4211 5.15789C8.75553 5.15789 7.1274 5.65178 5.74257 6.5771C4.35773 7.50241 3.27839 8.8176 2.64102 10.3563C2.00365 11.8951 1.83688 13.5883 2.16181 15.2218C2.48674 16.8553 3.28877 18.3558 4.46647 19.5335C5.64418 20.7112 7.14467 21.5133 8.77819 21.8382C10.4117 22.1631 12.1049 21.9964 13.6437 21.359C15.1824 20.7216 16.4976 19.6423 17.4229 18.2574C18.3482 16.8726 18.8421 15.2445 18.8421 13.5789C18.8421 13.2998 18.7312 13.032 18.5338 12.8346C18.3364 12.6372 18.0686 12.5263 17.7895 12.5263Z" fill="#586C61"/>
                    <path d="M13.5789 2C13.2998 2 13.032 2.1109 12.8346 2.30831C12.6372 2.50572 12.5263 2.77346 12.5263 3.05263V10.4211C12.5263 10.7002 12.6372 10.968 12.8346 11.1654C13.032 11.3628 13.2998 11.4737 13.5789 11.4737H20.9474C21.2265 11.4737 21.4943 11.3628 21.6917 11.1654C21.8891 10.968 22 10.7002 22 10.4211C21.9975 8.18842 21.1095 6.04795 19.5308 4.46924C17.9521 2.89053 15.8116 2.00251 13.5789 2Z" fill="#586C61"/>
                </svg>
                <div class="ms-3">
                    ダッシュボード
                </div>
            </div>
        </a>
        <a href="{{ route('companyList') }}">
            <div class="flex justify-start items-center link rounded p-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M4 21C3.45 21 2.979 20.804 2.587 20.412C2.195 20.02 1.99934 19.5493 2 19V8C2 7.45 2.196 6.979 2.588 6.587C2.98 6.195 3.45067 5.99934 4 6H8V4C8 3.45 8.196 2.979 8.588 2.587C8.98 2.195 9.45067 1.99934 10 2H14C14.55 2 15.021 2.196 15.413 2.588C15.805 2.98 16.0007 3.45067 16 4V6H20C20.55 6 21.021 6.196 21.413 6.588C21.805 6.98 22.0007 7.45067 22 8V19C22 19.55 21.804 20.021 21.412 20.413C21.02 20.805 20.5493 21.0007 20 21H4ZM4 19H20V8H4V19ZM10 6H14V4H10V6Z" fill="#586C61"/>
                </svg>
                <div class="ms-3">
                    企業アカウント
                </div>
            </div>
        </a>
        <a href="{{ route('studentList') }}">
            <div class="flex justify-start items-center link rounded p-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 20.725C11.8333 20.725 11.6706 20.704 11.512 20.662C11.3533 20.62 11.1993 20.5577 11.05 20.475L6.04995 17.775C5.71662 17.5917 5.45828 17.346 5.27495 17.038C5.09162 16.73 4.99995 16.384 4.99995 16V11.2L2.59995 9.87501C2.41662 9.77501 2.28328 9.65001 2.19995 9.50001C2.11662 9.35001 2.07495 9.18334 2.07495 9.00001C2.07495 8.81668 2.11662 8.65001 2.19995 8.50001C2.28328 8.35001 2.41662 8.22501 2.59995 8.12501L11.05 3.52501C11.2 3.44168 11.3543 3.37901 11.513 3.33701C11.6716 3.29501 11.834 3.27434 12 3.27501C12.1666 3.27501 12.3293 3.29601 12.488 3.33801C12.6466 3.38001 12.8006 3.44234 12.95 3.52501L22.475 8.72501C22.6416 8.80834 22.771 8.92934 22.863 9.08801C22.955 9.24668 23.0006 9.41734 23 9.60001V16C23 16.2833 22.9039 16.521 22.712 16.713C22.52 16.905 22.2826 17.0007 22 17C21.7166 17 21.479 16.904 21.287 16.712C21.095 16.52 20.9993 16.2827 21 16V10.1L19 11.2V16C19 16.3833 18.9083 16.7293 18.725 17.038C18.5416 17.3467 18.2833 17.5923 17.95 17.775L12.95 20.475C12.8 20.5583 12.646 20.621 12.488 20.663C12.33 20.705 12.1673 20.7257 12 20.725ZM12 12.7L18.85 9.00001L12 5.30001L5.14995 9.00001L12 12.7ZM12 18.725L17 16.025V12.25L12.975 14.475C12.825 14.5583 12.6666 14.621 12.5 14.663C12.3333 14.705 12.1666 14.7257 12 14.725C11.8333 14.725 11.6666 14.704 11.5 14.662C11.3333 14.62 11.175 14.5577 11.025 14.475L6.99995 12.25V16.025L12 18.725Z" fill="#586C61"/>
                </svg>
                <div class="ms-3">
                    学生アカウント
                </div>
            </div>
        </a>
    </div>
    <hr class="w-full">
    <div class="w-full px-3 mt-9 text-sm">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                <div class="flex justify-start items-center link rounded p-2">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5 21C4.45 21 3.979 20.804 3.587 20.412C3.195 20.02 2.99934 19.5493 3 19V5C3 4.45 3.196 3.979 3.588 3.587C3.98 3.195 4.45067 2.99934 5 3H11C11.2833 3 11.521 3.096 11.713 3.288C11.905 3.48 12.0007 3.71733 12 4C12 4.28333 11.904 4.521 11.712 4.713C11.52 4.905 11.2827 5.00067 11 5H5V19H11C11.2833 19 11.521 19.096 11.713 19.288C11.905 19.48 12.0007 19.7173 12 20C12 20.2833 11.904 20.521 11.712 20.713C11.52 20.905 11.2827 21.0007 11 21H5ZM17.175 13H10C9.71667 13 9.479 12.904 9.287 12.712C9.095 12.52 8.99934 12.2827 9 12C9 11.7167 9.096 11.479 9.288 11.287C9.48 11.095 9.71734 10.9993 10 11H17.175L15.3 9.125C15.1167 8.94167 15.025 8.71667 15.025 8.45C15.025 8.18333 15.1167 7.95 15.3 7.75C15.4833 7.55 15.7167 7.44567 16 7.437C16.2833 7.42834 16.525 7.52433 16.725 7.725L20.3 11.3C20.5 11.5 20.6 11.7333 20.6 12C20.6 12.2667 20.5 12.5 20.3 12.7L16.725 16.275C16.525 16.475 16.2873 16.571 16.012 16.563C15.7367 16.555 15.4993 16.4507 15.3 16.25C15.1167 16.05 15.029 15.8123 15.037 15.537C15.045 15.2617 15.141 15.0327 15.325 14.85L17.175 13Z" fill="#586C61"/>
                    </svg>
                    <div class="ms-3">
                        ログアウト
                    </div>
                </div>
            </a>
        </form>
    </div>
</header>
