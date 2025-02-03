<x-layout>
    <div class="flex items-center justify-center min-h-screen">
      <div class="flex flex-col justify-center w-1/3 min-h-full px-6 py-12 bg-gray-700 shadow-md lg:px-8 rounded-2xl">
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <img src="{{ Vite::asset('resources/images/tg-logo-final.png') }}" alt="" class="mx-auto w-36 h-36"  >
          <h2 class="mt-10 font-bold tracking-tight text-center text-gray-900 dark:text-white text-2xl/9">TechGuard Dev Portal</h2>
          <h3 class="mt-5 font-bold tracking-tight text-center text-gray-900 dark:text-white text-xl/9">Set Password</h3>
        </div>
      
        <div class="sm:mx-auto sm:w-full sm:max-w-sm">
          <form class="space-y-6" action="{{route('store-password')}}" method="POST">
            @csrf
            <div>
              <div class="flex items-center justify-between">
                <label for="password" class="block font-medium text-gray-900 dark:text-white text-sm/6">Password</label>
              </div>
              <div class="mt-2">
                <input type="password" name="password" id="password" autocomplete="current-password" required class="block w-full rounded-md bg-white border border-slate-600 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
              </div>
            </div>

            <div>
                <div class="flex items-center justify-between">
                  <label for="password_confirmation" class="block font-medium text-gray-900 dark:text-white text-sm/6">Confirm Password</label>
                </div>
                <div class="mt-2">
                  <input type="password" name="password_confirmation" id="password_confirmation" autocomplete="current-password" required class="block w-full rounded-md bg-white border border-slate-600 px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6">
                </div>
              </div>
      
            <div class="mt-5">
              <button type="submit" class="flex w-full justify-center rounded-md bg-gray-600 px-3 py-1.5 text-sm/6 font-semibold text-white shadow-xs hover:bg-gray-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Confirm</button>
            </div>
            <input type="text" hidden value="{{$token}}" name="token">
            <input type="email" hidden value="{{$email}}" name="email">
          </form>
        </div>
      </div>
    </div>
    
   </x-layout>