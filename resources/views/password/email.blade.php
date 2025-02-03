<x-layout>
    <div class="flex items-center justify-center min-h-screen">
      <!-- Flash Messages -->
      @if (session('error'))
        <div class="fixed p-4 mb-4 text-red-800 bg-red-200 rounded-md shadow-lg top-4 right-4">
          {{ session('error') }}
        </div>
      @endif
  
      <div class="relative flex flex-col justify-center w-1/3 min-h-full px-6 py-12 bg-gray-600 shadow-md lg:px-8 rounded-2xl">

         <!-- Back Button -->
         <a href="{{ route('login') }}" class="absolute flex items-center ml-2 text-white top-4 left-4 hover:text-gray-300">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="mr-2 bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8"/>
              </svg>
            Back
          </a>
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
          <form class="space-y-6" action="{{route('send-reset-email')}}" method="POST">
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
     
            <!-- Submit Button -->
            <div>
              <button 
                type="submit" 
                class="flex w-full justify-center rounded-md bg-gray-500 px-3 py-1.5 text-sm/6 font-semibold text-white hover:text-black/80 shadow-xs hover:bg-gray-400 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
              >
                Reset Password
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
    <x-flash-message />
  </x-layout>