<x-main-layout>
    <div class="max-w-4xl px-4 py-8 mx-auto">
        {{-- Header Section --}}
        <div class="mb-8">
            <div class="flex items-center justify-between">
                <div class="flex items-center gap-4">
                    {{-- Large Initial Avatar --}}
                    <div class="flex items-center justify-center w-auto h-auto m-auto">
                        <img src="{{ asset('storage/profile.jpg') }}" alt="" class="object-cover w-32 h-32 border border-gray-700 rounded-full shadow-lg"  >
                        
                    </div>
                    
                    <div class="ml-2">
                        <h1 class="text-3xl font-semibold text-white">{{ucfirst($user->name)}}</h1>
                        <div class="mt-3">
                            <span class="inline-flex items-center px-2 py-1 text-sm font-medium text-blue-400 rounded-md bg-blue-900/50 ring-1 ring-inset ring-blue-500/20">
                                {{ucfirst($user->getRoleNames()->first())}}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    
        {{-- Main Content Section --}}
        <div class="bg-gray-700 border border-gray-700 rounded-lg shadow-lg">
            <div class="px-6 pt-5 border-b border-gray-700">
                <h2 class="text-lg font-medium text-gray-100">User Information</h2>
            </div>
            <div>
                <div class="w-full h-px mt-5 bg-white/50"></div>
            </div>
            <div class="px-6 py-5">
                <dl class="space-y-6">
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Full Name</dt>
                        <dd class="mt-1 text-lg text-gray-100">{{ucfirst($user->name)}}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Email Address</dt>
                        <dd class="mt-1 text-lg text-gray-100">{{ucfirst($user->email)}}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Role</dt>
                        <dd class="mt-1 text-lg text-gray-100">{{ucfirst($user->getRoleNames()->first())}}</dd>
                    </div>
                    
                    <div>
                        <dt class="text-sm font-medium text-gray-400">Member Since</dt>
                        <dd class="mt-1 text-lg text-gray-100">{{ $user->created_at->format('F j, Y') }}</dd>
                    </div>
                </dl>
            </div>
        </div>
    </div>
    
</x-main-layout>