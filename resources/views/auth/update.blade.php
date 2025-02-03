<x-main-layout>
    <x-page-heading>Update User</x-page-heading>
    
    <x-page-back route="users" />

    <x-forms.background>
        <x-forms.form method="POST" action="{{route('update-user')}}">
            @method('PATCH')
            <x-forms.input label="Name" name="name" value="{{$user->name}}"  />
            <x-forms.input label="Email" name="email" type="email" value="{{$user->email}}" />
            <div class="relative">
                <x-forms.select label="Role" name="role" 
                    class="pr-8 appearance-none dark:bg-gray-800 dark:text-white dark:border-gray-600">
                    @foreach (['support', 'developer', 'admin'] as $role)
                        <option value="{{ $role }}" {{ $user->hasRole($role) ? 'selected' : '' }}>
                            {{ ucfirst($role) }}
                        </option>
                    @endforeach
                </x-forms.select>
            </div>
            <input hidden name="id"  value="{{$user->id}}">
            <div class="">
                <x-forms.button class="mt-5" >Update</x-forms.button>
            </div>
        </x-forms.form>
    </x-forms.background>
</x-main-layout>