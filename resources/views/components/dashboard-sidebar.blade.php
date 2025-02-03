<aside id="separator-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full shadow-md sm:translate-x-0" aria-label="Sidebar">
    <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-700">
        <div class="flex items-center py-3">
            <a href="{{route('dashboard')}}" class="flex items-center mb-2">
                <img src="{{ asset('storage/tg-logo-final.png') }}" alt="" class="w-8 h-8 rounded-full"  >
                <span class="ml-3 text-lg font-semibold text-slate-100">Trustgate Dev Portal</span>
            </a>
        </div>
    <ul class="space-y-2 font-medium">
            <x-dashboard-item  text="Dashboard" >
                <x-logo.logo-dashboard />
            </x-dashboard-item>
            <x-dashboard-item text="Certificates">
                <x-logo.logo-cert />
            </x-dashboard-item>
            <x-dashboard-item text="Clients">
                <x-logo.logo-clients />
            </x-dashboard-item>
            @can('modify users')
                <x-dashboard-item text="Users">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-person-video2" viewBox="0 0 16 16">
                        <path d="M10 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5"/>
                        <path d="M2 1a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2zM1 3a1 1 0 0 1 1-1h2v2H1zm4 10V2h9a1 1 0 0 1 1 1v9c0 .285-.12.543-.31.725C14.15 11.494 12.822 10 10 10c-3.037 0-4.345 1.73-4.798 3zm-4-2h3v2H2a1 1 0 0 1-1-1zm3-1H1V8h3zm0-3H1V5h3z"/>
                      </svg>
                </x-dashboard-item>
            @endcan
    </ul>
    <ul class="pt-4 mt-20 space-y-2 font-medium border-t border-gray-200 dark:border-gray-300">
            <x-dashboard-item text="Profile">
                <x-logo.logo-profile />
            </x-dashboard-item>
            
             <li class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-red-500 dark:hover:bg-red-500">
                <x-logo.logo-logout />
                <form action="{{route('logout')}}" method="POST" class="flex items-center">
                    @csrf
                    @method('DELETE')
                    <button class="flex items-center ms-3 "> 
                        Logout
                    </button>
                </form>
            </li>
    </ul>
    </div>
</aside>