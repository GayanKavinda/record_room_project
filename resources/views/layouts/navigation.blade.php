<nav x-data="{ open: false }" class="bg-gray-900 shadow-md">
    <!-- Container -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            
            <!-- Logo and Title (Left) -->
            <div class="flex items-center space-x-3">
                <a href="{{ route('dashboard') }}" class="flex items-center space-x-2">
                    <img src="{{ asset('images/sri lanka.png') }}" alt="Logo" class="w-10 h-10">
                    <span class="text-yellow-400 font-semibold text-lg">Record Room Management System</span>
                </a>
            </div>

            <!-- Centered Navigation Links (Hidden on mobile) -->
            <div class="hidden md:flex space-x-8">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-yellow-400 hover:text-white transition">
                    {{ __('Home') }}
                </x-nav-link>
                <!-- Add Record Room and Stored Files -->
    <x-nav-link :href="route('record-room.index')" :active="request()->routeIs('record-room.index')" class="text-gray-300 hover:text-white transition">
        {{ __('Record Room') }}
    </x-nav-link>
    <x-nav-link :href="route('record-room.storedFiles')" :active="request()->routeIs('record-room.storedFiles')" class="text-gray-300 hover:text-white transition">
        {{ __('Stored Files') }}
    </x-nav-link>
                <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-gray-300 hover:text-white transition">
                    {{ __('About') }}
                </x-nav-link>
                <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-gray-300 hover:text-white transition">
                    {{ __('Contact') }}
                </x-nav-link>
            </div>

            <!-- User Dropdown (Right) -->
            <div class="hidden md:flex md:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="flex items-center px-4 py-2 bg-gray-800 text-gray-200 rounded-md hover:bg-gray-700 transition">
                            <span class="mr-2">{{ Auth::user()->name }}</span>
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')" class="text-gray-700 hover:bg-gray-100">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();" 
                                class="text-gray-700 hover:bg-gray-100">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Menu Button -->
            <div class="md:hidden">
                <button @click="open = !open" class="text-gray-300 hover:text-white focus:outline-none">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open}" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{'hidden': !open, 'inline-flex': open}" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Dropdown Menu with Transition -->
    <div :class="{'block': open, 'hidden': !open}" class="md:hidden bg-gray-800 transition-all duration-300 ease-in-out">
        <div class="space-y-1 px-4 py-3">
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-yellow-400 hover:text-white block">
                {{ __('Home') }}
            </x-nav-link>
            <x-nav-link :href="route('about')" :active="request()->routeIs('about')" class="text-gray-300 hover:text-white block">
                {{ __('About') }}
            </x-nav-link>
            <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')" class="text-gray-300 hover:text-white block">
                {{ __('Contact') }}
            </x-nav-link>
        </div>

        <!-- Mobile User Dropdown -->
        <div class="border-t border-gray-700 px-4 py-3">
            <div class="text-base font-medium text-gray-200">{{ Auth::user()->name }}</div>
            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-gray-700 block mt-2">
                {{ __('Profile') }}
            </x-dropdown-link>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <x-dropdown-link :href="route('logout')"
                    onclick="event.preventDefault(); this.closest('form').submit();" 
                    class="text-gray-300 hover:bg-gray-700 block mt-2">
                    {{ __('Log Out') }}
                </x-dropdown-link>
            </form>
        </div>
    </div>
</nav>
