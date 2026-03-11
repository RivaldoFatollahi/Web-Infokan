<nav class="flex items-center justify-between px-3 py-1 bg-white border-b border-gray-300">
    <div>
        <img src="{{ asset('images/logo-infokan.png') }}" alt="Logo" style="height:55px;">
    </div>

    {{-- MENU --}}
    <div>
        <ul class="flex gap-8 p-0 m-0 list-none">

            <li>
                <a href="{{ route('home') }}"
                   class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-200 no-underline
                   {{ request()->routeIs('home') 
                        ? 'border-[#0096D6] text-[#1A4F73]' 
                        : 'border-transparent text-gray-500 hover:text-[#0096D6] hover:border-[#4EB8E5]' }}">
                    Home
                </a>
            </li>

            <li>
                <a href="{{ route('laporan') }}"
                   class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-200 no-underline
                   {{ request()->routeIs('laporan') 
                        ? 'border-[#0096D6] text-[#1A4F73]' 
                        : 'border-transparent text-gray-500 hover:text-[#0096D6] hover:border-[#4EB8E5]' }}">
                    Laporan Saya
                </a>
            </li>

        </ul>
    </div>

    {{-- AUTH AREA --}}
    <div class="relative">

        {{-- Belum login --}}
        @guest
            <a href="{{ route('login') }}" class="px-4 py-2 text-white rounded-md transition no-underline" style="background:#0096D6">
                Login
            </a>
        @endguest


        {{-- Sudah login --}}
        @auth
        <div class="hidden sm:flex sm:items-center sm:ms-4">
            <x-dropdown align="right" width="48">
                {{-- Trigger --}}
                <x-slot name="trigger">
                    <button
                        class="inline-flex items-center gap-2 px-3 py-2 text-sm border border-transparent font-medium text-[#1A4F73] bg-white rounded-md hover:text-[#0096D6] transition">
                        <span>{{ Auth::user()->nama }}</span>

                        <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                            <path fill-rule="evenodd"
                                d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                clip-rule="evenodd"/>
                        </svg>

                    </button>
                </x-slot>

                {{-- Dropdown Content --}}
                <x-slot name="content">
                    {{-- <x-dropdown-link :href="route('')"> --}}
                    <x-dropdown-link href="" class="no-underline hover:bg-[#0096D6] hover:text-white">
                        Profile
                    </x-dropdown-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-dropdown-link :href="route('logout')" class="no-underline hover:bg-red-500 hover:text-white"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            Logout
                        </x-dropdown-link>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>
        @endauth

    </div>
</nav>