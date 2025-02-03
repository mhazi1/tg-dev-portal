<x-main-layout>
    <x-page-heading>Verify Client</x-page-heading>
    <x-page-back route="clients" />
    <x-forms.background>
        <x-forms.form method="POST" action="/clients">
            @method('PATCH')
            <x-forms.input label="Name" name="name" value="{{$client->name}}" />
            <x-forms.input label="Role" name="role"  value="{{$client->role}}" />
            <x-forms.input label="Company" name="company"  value="{{$client->company}}" />
            <input hidden name="id"  value="{{$client->id}}">
            
            
            <div class="text-right">
                <x-forms.button class="mt-5" >Verify</x-forms.button>
            </div>
        </x-forms.form>
    </x-forms.background>
</x-main-layout>