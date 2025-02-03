<x-main-layout>

    <div class="py-5 mt-5 mb-5 ml-3">
        <span class="text-3xl font-bold dark:text-white">Clients</span>
        <div class="block mt-8 space-x-4 ">
            <a href="{{route('add-client')}}" class="p-2 text-sm bg-green-600 rounded-lg hover:bg-green-500">Add Client</a>
        </div>
    </div>
    
    <div class="p-4 pb-8 ml-3 shadow-md bg-white/90 rounded-xl dark:bg-gray-700">
        <x-table-clients :clients="$clients" />
        <div class="mt-5">
            @if(method_exists($clients, 'links'))
                {{ $clients->links() }}
            @endif
        </div>
    </div>
    <x-flash-message />  
</x-main-layout>