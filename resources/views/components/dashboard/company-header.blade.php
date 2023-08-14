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
                    企業情報
                </div>
            </div>
        </a>
        <a href="{{ route('studentList') }}">
            <div class="flex justify-start items-center link rounded p-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.0002 20.725C11.8335 20.725 11.6709 20.704 11.5122 20.662C11.3535 20.62 11.1995 20.5577 11.0502 20.475L6.0502 17.775C5.71686 17.5917 5.45853 17.346 5.2752 17.038C5.09186 16.73 5.0002 16.384 5.0002 16V11.2L2.6002 9.87499C2.41686 9.77499 2.28353 9.64999 2.2002 9.49999C2.11686 9.34999 2.0752 9.18333 2.0752 8.99999C2.0752 8.81666 2.11686 8.64999 2.2002 8.49999C2.28353 8.34999 2.41686 8.22499 2.6002 8.12499L11.0502 3.52499C11.2002 3.44166 11.3545 3.37899 11.5132 3.33699C11.6719 3.29499 11.8342 3.27433 12.0002 3.27499C12.1669 3.27499 12.3295 3.29599 12.4882 3.33799C12.6469 3.37999 12.8009 3.44233 12.9502 3.52499L22.4752 8.72499C22.6419 8.80833 22.7712 8.92933 22.8632 9.08799C22.9552 9.24666 23.0009 9.41733 23.0002 9.59999V16C23.0002 16.2833 22.9042 16.521 22.7122 16.713C22.5202 16.905 22.2829 17.0007 22.0002 17C21.7169 17 21.4792 16.904 21.2872 16.712C21.0952 16.52 20.9995 16.2827 21.0002 16V10.1L19.0002 11.2V16C19.0002 16.3833 18.9085 16.7293 18.7252 17.038C18.5419 17.3467 18.2835 17.5923 17.9502 17.775L12.9502 20.475C12.8002 20.5583 12.6462 20.621 12.4882 20.663C12.3302 20.705 12.1675 20.7257 12.0002 20.725ZM12.0002 12.7L18.8502 8.99999L12.0002 5.29999L5.1502 8.99999L12.0002 12.7ZM12.0002 18.725L17.0002 16.025V12.25L12.9752 14.475C12.8252 14.5583 12.6669 14.621 12.5002 14.663C12.3335 14.705 12.1669 14.7257 12.0002 14.725C11.8335 14.725 11.6669 14.704 11.5002 14.662C11.3335 14.62 11.1752 14.5577 11.0252 14.475L7.0002 12.25V16.025L12.0002 18.725Z" fill="#586C61"/>
                </svg>
                <div class="ms-3">
                    フォロワーリスト
                </div>
            </div>
        </a>
    </div>
    <hr class="w-full">
    <div class="w-full px-3 mb-7 flex flex-col gap-2 text-sm">
        <a href="{{ route('companySetting') }}">
            <div class="flex justify-start items-center link rounded p-2">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M13.8753 22H10.1253C9.87534 22 9.65867 21.9167 9.47534 21.75C9.292 21.5833 9.18367 21.375 9.15034 21.125L8.85034 18.8C8.63367 18.7167 8.42934 18.6167 8.23734 18.5C8.04534 18.3833 7.858 18.2583 7.67534 18.125L5.50034 19.025C5.267 19.1083 5.03367 19.1167 4.80034 19.05C4.567 18.9833 4.38367 18.8417 4.25034 18.625L2.40034 15.4C2.267 15.1833 2.22534 14.95 2.27534 14.7C2.32534 14.45 2.45034 14.25 2.65034 14.1L4.52534 12.675C4.50867 12.5583 4.50034 12.4457 4.50034 12.337V11.663C4.50034 11.5543 4.50867 11.4417 4.52534 11.325L2.65034 9.9C2.45034 9.75 2.32534 9.55 2.27534 9.3C2.22534 9.05 2.267 8.81667 2.40034 8.6L4.25034 5.375C4.367 5.14167 4.546 4.99567 4.78734 4.937C5.02867 4.87833 5.26634 4.891 5.50034 4.975L7.67534 5.875C7.85867 5.74167 8.05034 5.61667 8.25034 5.5C8.45034 5.38333 8.65034 5.28333 8.85034 5.2L9.15034 2.875C9.18367 2.625 9.292 2.41667 9.47534 2.25C9.65867 2.08333 9.87534 2 10.1253 2H13.8753C14.1253 2 14.342 2.08333 14.5253 2.25C14.7087 2.41667 14.817 2.625 14.8503 2.875L15.1503 5.2C15.367 5.28333 15.5713 5.38333 15.7633 5.5C15.9553 5.61667 16.1427 5.74167 16.3253 5.875L18.5003 4.975C18.7337 4.89167 18.967 4.88333 19.2003 4.95C19.4337 5.01667 19.617 5.15833 19.7503 5.375L21.6003 8.6C21.7337 8.81667 21.7753 9.05 21.7253 9.3C21.6753 9.55 21.5503 9.75 21.3503 9.9L19.4753 11.325C19.492 11.4417 19.5003 11.5543 19.5003 11.663V12.337C19.5003 12.4457 19.4837 12.5583 19.4503 12.675L21.3253 14.1C21.5253 14.25 21.6503 14.45 21.7003 14.7C21.7503 14.95 21.7087 15.1833 21.5753 15.4L19.7253 18.6C19.592 18.8167 19.4043 18.9627 19.1623 19.038C18.9203 19.1133 18.683 19.109 18.4503 19.025L16.3253 18.125C16.142 18.2583 15.9503 18.3833 15.7503 18.5C15.5503 18.6167 15.3503 18.7167 15.1503 18.8L14.8503 21.125C14.817 21.375 14.7087 21.5833 14.5253 21.75C14.342 21.9167 14.1253 22 13.8753 22ZM12.0503 15.5C13.017 15.5 13.842 15.1583 14.5253 14.475C15.2087 13.7917 15.5503 12.9667 15.5503 12C15.5503 11.0333 15.2087 10.2083 14.5253 9.525C13.842 8.84167 13.017 8.5 12.0503 8.5C11.067 8.5 10.2377 8.84167 9.56234 9.525C8.887 10.2083 8.54967 11.0333 8.55034 12C8.55034 12.9667 8.88767 13.7917 9.56234 14.475C10.237 15.1583 11.0663 15.5 12.0503 15.5ZM12.0503 13.5C11.6337 13.5 11.2793 13.354 10.9873 13.062C10.6953 12.77 10.5497 12.416 10.5503 12C10.5503 11.5833 10.6963 11.229 10.9883 10.937C11.2803 10.645 11.6343 10.4993 12.0503 10.5C12.467 10.5 12.8213 10.646 13.1133 10.938C13.4053 11.23 13.551 11.584 13.5503 12C13.5503 12.4167 13.4043 12.771 13.1123 13.063C12.8203 13.355 12.4663 13.5007 12.0503 13.5ZM11.0003 20H12.9753L13.3253 17.35C13.842 17.2167 14.3213 17.0207 14.7633 16.762C15.2053 16.5033 15.6093 16.191 15.9753 15.825L18.4503 16.85L19.4253 15.15L17.2753 13.525C17.3587 13.2917 17.417 13.046 17.4503 12.788C17.4837 12.53 17.5003 12.2673 17.5003 12C17.5003 11.7333 17.4837 11.471 17.4503 11.213C17.417 10.955 17.3587 10.709 17.2753 10.475L19.4253 8.85L18.4503 7.15L15.9753 8.2C15.6087 7.81667 15.2047 7.496 14.7633 7.238C14.322 6.98 13.8427 6.784 13.3253 6.65L13.0003 4H11.0253L10.6753 6.65C10.1587 6.78333 9.67967 6.97933 9.23834 7.238C8.797 7.49667 8.39267 7.809 8.02534 8.175L5.55034 7.15L4.57534 8.85L6.72534 10.45C6.642 10.7 6.58367 10.95 6.55034 11.2C6.517 11.45 6.50034 11.7167 6.50034 12C6.50034 12.2667 6.517 12.525 6.55034 12.775C6.58367 13.025 6.642 13.275 6.72534 13.525L4.57534 15.15L5.55034 16.85L8.02534 15.8C8.392 16.1833 8.79634 16.5043 9.23834 16.763C9.68034 17.0217 10.1593 17.2173 10.6753 17.35L11.0003 20Z" fill="#586C61"/>
                </svg>
                <div class="ms-3">
                    設定
                </div>
            </div>
        </a>
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
