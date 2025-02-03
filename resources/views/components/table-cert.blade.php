<div class="relative overflow-x-auto">
    <div class="relative mt-4 overflow-x-auto border rounded-md border-slate-300">
        <table class="w-full text-sm text-left text-gray-500 rtl:text-right dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                        <span class="text-white/90">Common Name</span>
                    </th>
                    <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                        <span class="text-white/90">Country</span>
                    </th>
                    <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                        <span class="text-white/90">Organization</span>
                    </th>
                    <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                        <span class="text-white/90">Expiry Date</span>
                    </th>
                    <th scope="col" class="px-3 py-1 text-center border border-slate-500">
                        <span class="text-white/90">Status</span>
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
                @foreach ($certs as $cert)
                <tr class="" >
                    <th scope="row" class="px-3 py-1 font-medium border border-slate-500 ">
                        <span class="text-white/80">{{$cert->common_name}}</span>
                    </th>
                    <td class="px-3 py-1 text-center border border-slate-500">
                        <span class="text-white/80">{{$cert->country}}</span>
                    </td>
                    <td class="px-3 py-1 text-center border border-slate-500">
                        <span class="text-white/80">{{$cert->organization}}</span>
                    </td>
                    <td class="px-3 py-1 text-center border border-slate-500">
                        <span class="text-white/80">{{ Carbon\Carbon::parse($cert->expiry_date)->format('Y-m-d') }}</span>
                    </td>
                    <td class="px-3 py-1 text-center border border-slate-500">
                        @if ($cert->status == 'active')
                        <span class="px-2 py-1 bg-green-500 rounded-lg text-black/90">Active</span>
                        @elseif ($cert->status == 'revoked')
                        <span class="px-2 py-1 bg-yellow-500 rounded-lg text-black/90">Expired</span>
                        @endif
                    </td>
                    <td class="px-3 py-1 text-center border border-slate-500">
                        @if($cert->verified)
                            <span class="text-white/80">Yes</span>
                        @else
                            <span class="px-3 py-1 bg-red-900 rounded-lg text-white/80">No</span>
                        @endif
                    </td>
                    
                    @if ($cert->verified)
                        <td class="items-center py-2 border border-slate-500" colspan="2">
                            <form action="{{ route('delete-certificate') }}" method="POST" class="flex justify-center">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" value="{{ $cert->id }}" name="id">
                                <button class="flex items-center px-3 py-1 rounded-lg dark:bg-red-500/90 dark:hover:bg-red-400/90 delete-btn"
                                data-delete-url="{{ route('delete-certificate', ['id' => $cert->id]) }}"> 
                                    <span class="font-semibold text-white/90">Delete</span>
                                </button>
                            </form>
                        </td>
                    @else
                        <td class="items-center py-2 border border-slate-500">
                            <a href="{{route('get-certificate', $cert->id)}}" class="flex justify-center">   
                                <button class="flex items-center px-3 py-1 rounded-lg dark:bg-blue-500/80 dark:hover:bg-blue-400/90"> 
                                   <span class="font-semibold text-white/90">Verify</span>
                                </button>
                            </a>                    
                        </td>
                        <td class="items-center py-2 border border-slate-500">
                            <form action="{{ route('delete-certificate') }}" method="POST" class="flex justify-center">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" value="{{ $cert->id }}" name="id">
                                <button class="flex items-center px-3 py-1 rounded-lg dark:bg-red-500/90 dark:hover:bg-red-400/90 delete-btn"
                                data-delete-url="{{ route('delete-certificate', ['id' => $cert->id]) }}"> 
                                    <span class="font-semibold text-white/90">Delete</span>
                                </button>
                            </form>
                        </td>
                    @endif
                </tr>                 
                @endforeach
            </tbody>
        </table>
    </div>        
</div>