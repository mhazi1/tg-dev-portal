<x-main-layout>
    
    <div class="py-5 mt-5 mb-5 ml-3">
        <span class="text-3xl font-bold dark:text-white">Users</span>
        <div class="block mt-8 space-x-4 ">
            <a href="{{route('register')}}" class="p-2 text-sm bg-green-600 rounded-lg hover:bg-green-500">Register User</a>
        </div>
    </div>
    
    <div class="p-4 pb-8 ml-3 shadow-md bg-white/90 rounded-xl dark:bg-gray-700">
    <div class="relative overflow-x-auto">
        <div class="relative mt-4 overflow-x-auto border rounded-md border-slate-300">
            <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                            <span class="text-white/90">Name</span>
                        </th>
                        <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                            <span class="text-white/90">Email</span>
                        </th>
                        <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                            <span class="text-white/90">Role</span>
                        </th>
                        <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                            <span class="text-white/90">Verified</span>
                        </th>
                        <th scope="col" colspan="2" class="px-6 py-3 text-center border border-slate-500">
                            <span class="text-white/90">Action</span>
                        </th>
                        
                    </tr>
                </thead>
                <tbody class="border-slate-500 dark:bg-gray-800 dark:border-gray-700">
                    @foreach ($users as $user)
                    <tr class="" >
                        <th scope="row" class="px-3 py-1 font-medium border border-slate-500 ">
                            <span class="text-white/80">{{$user->name}}
                        </th>
                        <td class="px-3 py-1 border border-slate-500">
                            <span class="text-white/80">{{$user->email}}
                        </td>
                        <td class="px-3 py-1 text-center border border-slate-500 ">
                            <span class="text-white/80">{{ucfirst($user->getRoleNames()->first())}}
                        </td>
                        <td class="px-6 py-4 text-center border border-slate-500">
                            @if ($user->password_set)
                            <span class="px-2 py-1 rounded-lg text-white/80">Yes</span>
                            @else
                            <span class="px-2 py-1 bg-red-500 rounded-lg text-black/90">No</span>
                            @endif
                        </td>
                        <td class="px-3 py-1 text-center border border-slate-500">
                            <a href="{{route('get-user', $user->id)}}" class="flex justify-center">   
                                <button class="flex items-center px-3 py-1 rounded-lg dark:bg-blue-500/80 dark:hover:bg-blue-400/90"> 
                                   <span class="font-semibold text-white/90">Edit</span>
                                </button>
                            </a> 
                        </td>
                        <td class="px-3 py-1 border border-slate-500">
                            <form action="{{route('delete-user')}}" method="POST" class="flex justify-center">
                                @csrf
                                @method('DELETE')
                                <input hidden value="{{$user->id}}" name="id" >
                                <button class="flex items-center px-3 py-1 rounded-lg dark:bg-red-500/90 dark:hover:bg-red-400/90 delete-btn"
                                data-delete-url="{{ route('delete-user',['id' => $user->id]) }}"> 
                                    <span class="font-semibold text-white/90">Delete</span>
                                </button>
                            </form>
                        </td>
                    </tr>                 
                    @endforeach
                </tbody>
            </table>
        </div>        
    </div>
    <div class="mt-5">
        @if(method_exists($users, 'links'))
            {{ $users->links() }}
        @endif
    </div>
</div>
<x-flash-message />  
</x-main-layout>