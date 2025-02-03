<x-main-layout>
    <div class="ml-10 ">
        <span class="text-3xl font-bold dark:text-white">Dashboard</span>
    </div>
    <div class="grid gap-5 ml-10 lg:grid-cols-4">
        <x-dashboard-card :number="$activeCertificates" text="Active Certificates" />
        <div class="p-4 pb-10 mt-10 bg-white/90 rounded-xl dark:bg-gray-700 dark:shadow-md">
            <p class="text-sm text-slate-500 dark:text-white/50">Expiring in 30 Days</p>
            <p class="mt-2 text-2xl font-bold dark:text-yellow-400/90 ">{{ $expiringSoon }}</p>
        </div>
        <x-dashboard-card :number="$verifiedClients" text="Verified Clients"  />
    </div>
    
    {{-- <div class="w-1/2 p-4 pb-10 mt-10 ml-10 shadow-md bg-white/90 rounded-xl dark:bg-gray-700 ">
        <span class="font-bold text-slate-800 dark:text-white/50">Recent Activity</span>
        <ul class="mt-3 text-sm list-disc">
            <li class="mt-4 ml-3 text-black/70 dark:text-white/90">IT Support added new certificate</li>
            <li class="mt-4 ml-3 text-black/70 dark:text-white/90">Developer verified certificate</li>
            <li class="mt-4 ml-3 text-black/70 dark:text-white/90">Admin registered a new User as Developer</li>
        </ul>
    </div> --}}
    
    <div class="p-4 pb-8 mx-10 mt-10 shadow-md bg-white/90 rounded-xl dark:bg-gray-700">
        <span class="font-bold text-slate-800 dark:text-white/50">Recent Certificates</span>
        <x-table-cert :certs="$certs" />
        <div class="mt-5">
            @if(method_exists($certs, 'links'))
                {{ $certs->links() }}
            @endif
        </div>
    </div>
    <x-flash-message />    
</x-main-layout>