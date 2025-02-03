 <x-layout>
  <div class="flex items-center justify-center min-h-screen">
    <!-- Flash Messages -->
    @if (session('error'))
      <div class="fixed p-4 mb-4 text-red-800 bg-red-200 rounded-md shadow-lg top-4 right-4">
        {{ session('error') }}
      </div>
    @endif

    <div class="flex flex-col justify-center w-1/3 min-h-full px-6 py-12 bg-gray-600 shadow-md lg:px-8 rounded-2xl">
      <!-- Logo and Title -->
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <img src="{{ asset('storage/tg-logo-final.png') }}" alt="TechGuard Logo" class="mx-auto w-36 h-36">
        <h2 class="mt-10 font-bold tracking-tight text-center text-gray-900 dark:text-white text-2xl/9">
          TechGuard Dev Portal
        </h2>
      </div>

      <!-- Validation Errors -->
      @if ($errors->any())
        <div class="mt-4 sm:mx-auto sm:w-full sm:max-w-sm">
          <div class="p-3 bg-red-100 rounded-md">
            <ul class="text-sm text-red-600 list-disc list-inside">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        </div>
      @endif
   
      <!-- Login Form -->
      <div class="sm:mx-auto sm:w-full sm:max-w-sm">
        <form class="space-y-6" action="/login" method="POST">
          @csrf
          
          <!-- Email Field -->
          <div>
            <label for="email" class="block font-medium text-gray-900 dark:text-white text-sm/6">
              Email address
            </label>
            <div class="mt-2">
              <input 
                type="email" 
                name="email" 
                id="email" 
                value="{{ old('email') }}"
                autocomplete="email" 
                required 
                class="block w-full rounded-md bg-white border border-slate-600 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('email') border-red-500 @enderror"
              >
            </div>
          </div>
                 
          <!-- Password Field -->
          <div>
            <div class="flex items-center justify-between">
              <label for="password" class="block font-medium text-gray-900 dark:text-white text-sm/6">
                Password
              </label>
              <div class="text-sm">
                <a href="{{route('forgot-password')}}" class="font-semibold text-white/50 hover:text-white/30">
                  Forgot password?
                </a>
              </div>
            </div>
            <div class="mt-2">
              <input 
                type="password" 
                name="password" 
                id="password" 
                autocomplete="current-password" 
                required 
                class="block w-full rounded-md bg-white border border-slate-600 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6 @error('password') border-red-500 @enderror"
              >
            </div>
          </div>
   
          <!-- Submit Button -->
          <div>
            <button 
              type="submit" 
              class="flex w-full justify-center rounded-md bg-gray-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:text-black/80 shadow-xs hover:bg-gray-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
              Login
            </button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <x-flash-message />
</x-layout>