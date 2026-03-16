<nav class="bg-white border-b border-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">

            {{-- LEFT SIDE --}}
            <div class="flex items-center">

                {{-- LOGO --}}
                <div class="shrink-0 flex items-center">
                    <img src="{{ asset('images/logo-infokan.png') }}" alt="Logo" class="h-12">
                </div>

                {{-- MENU --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">

                    <a href="{{ route('home') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-200 no-underline
                       {{ request()->routeIs('home') 
                            ? 'border-[#0096D6] text-[#1A4F73]' 
                            : 'border-transparent text-gray-500 hover:text-[#0096D6] hover:border-[#4EB8E5]' }}">
                        Home
                    </a>

                    <a href="{{ route('laporan') }}"
                       class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium transition duration-200 no-underline
                       {{ request()->routeIs('laporan') 
                            ? 'border-[#0096D6] text-[#1A4F73]' 
                            : 'border-transparent text-gray-500 hover:text-[#0096D6] hover:border-[#4EB8E5]' }}">
                        Laporan Saya
                    </a>

                </div>

            </div>


            {{-- RIGHT SIDE --}}
            <div class="flex items-center">

                {{-- Belum login --}}
                @guest
                    <a href="{{ route('login') }}" class="btn-primary no-underline">
                        Login
                    </a>
                @endguest


                {{-- Sudah login --}}
                @auth
                <div class="hidden sm:flex sm:items-center sm:ms-4">
                    <x-dropdown align="right" width="48">

                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center gap-2 px-3 py-2 text-sm font-medium text-[#1A4F73] border border-transparent bg-white rounded-md hover:text-[#0096D6] transition">
                                <span>{{ Auth::user()->nama }}</span>

                                <svg class="h-4 w-4 fill-current" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                        d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                        clip-rule="evenodd"/>
                                </svg>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link href="{{ route('profile.edit') }}" class="no-underline">
                                Profile
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')" 
                                    class="no-underline hover:bg-red-500 hover:text-white"
                                    onclick="event.preventDefault(); this.closest('form').submit();">
                                    Logout
                                </x-dropdown-link>
                            </form>
                        </x-slot>

                    </x-dropdown>
                </div>
                @endauth

            </div>
        </div>
    </div>
</nav>