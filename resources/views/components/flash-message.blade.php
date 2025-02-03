{{-- @if (session()->has('success'))
    <div class="fixed px-4 py-3 text-white border rounded-lg shadow-lg bottom-4 right-4 bg-emerald-500/80 backdrop-blur-sm border-emerald-400/50">
        <p class="text-sm font-medium">
            {{ session('success') }}
        </p>
    </div>
@endif

@if (session()->has('error'))
    <div class="fixed px-4 py-3 text-white border rounded-lg shadow-lg bottom-4 right-4 bg-red-500/80 backdrop-blur-sm border-red-400/50">
        <p class="text-sm font-medium">
            {{ session('error') }}
        </p>
    </div>
@endif

@if (session()->has('warning'))
    <div class="fixed px-4 py-3 text-white border rounded-lg shadow-lg bottom-4 right-4 bg-amber-500/80 backdrop-blur-sm border-amber-400/50">
        <p class="text-sm font-medium">
            {{ session('warning') }}
        </p>
    </div>
@endif

@if (session()->has('info'))
    <div class="fixed px-4 py-3 text-white border rounded-lg shadow-lg bottom-4 right-4 bg-blue-500/80 backdrop-blur-sm border-blue-400/50">
        <p class="text-sm font-medium">
            {{ session('info') }}
        </p>
    </div>
@endif --}}
@if (session()->has('success'))
    <div x-data="{ show: true }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-8"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-8"
         x-init="setTimeout(() => show = false, 3000)"
         @click="show = false"
         class="fixed px-4 py-3 text-white transition-colors duration-200 border rounded-lg shadow-lg cursor-pointer bottom-4 right-4 bg-emerald-500/80 backdrop-blur-sm border-emerald-400/50 hover:bg-emerald-500/90">
        <div class="flex items-center space-x-3">
            <p class="text-sm font-medium">{{ session('success') }}</p>
            <button class="text-white/80 hover:text-white" @click="show = false">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

@if (session()->has('error'))
    <div x-data="{ show: true }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-8"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-8"
         x-init="setTimeout(() => show = false, 3000)"
         @click="show = false"
         class="fixed px-4 py-3 text-white transition-colors duration-200 border rounded-lg shadow-lg cursor-pointer bottom-4 right-4 bg-red-500/80 backdrop-blur-sm border-red-400/50 hover:bg-red-500/90">
        <div class="flex items-center space-x-3">
            <p class="text-sm font-medium">{{ session('error') }}</p>
            <button class="text-white/80 hover:text-white" @click="show = false">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

@if (session()->has('warning'))
    <div x-data="{ show: true }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-8"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-8"
         x-init="setTimeout(() => show = false, 3000)"
         @click="show = false"
         class="fixed px-4 py-3 text-white transition-colors duration-200 border rounded-lg shadow-lg cursor-pointer bottom-4 right-4 bg-amber-500/80 backdrop-blur-sm border-amber-400/50 hover:bg-amber-500/90">
        <div class="flex items-center space-x-3">
            <p class="text-sm font-medium">{{ session('warning') }}</p>
            <button class="text-white/80 hover:text-white" @click="show = false">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif

@if (session()->has('info'))
    <div x-data="{ show: true }"
         x-show="show"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 transform translate-x-8"
         x-transition:enter-end="opacity-100 transform translate-x-0"
         x-transition:leave="transition ease-in duration-300"
         x-transition:leave-start="opacity-100 transform translate-x-0"
         x-transition:leave-end="opacity-0 transform translate-x-8"
         x-init="setTimeout(() => show = false, 3000)"
         @click="show = false"
         class="fixed px-4 py-3 text-white transition-colors duration-200 border rounded-lg shadow-lg cursor-pointer bottom-4 right-4 bg-blue-500/80 backdrop-blur-sm border-blue-400/50 hover:bg-blue-500/90">
        <div class="flex items-center space-x-3">
            <p class="text-sm font-medium">{{ session('info') }}</p>
            <button class="text-white/80 hover:text-white" @click="show = false">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>
    </div>
@endif