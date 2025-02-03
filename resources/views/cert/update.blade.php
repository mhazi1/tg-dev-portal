<x-main-layout>
    <x-page-heading>Verify Certificate</x-page-heading>

    <x-page-back route="certificates" />
    <x-forms.background>
        <x-forms.form method="POST" action="/certificates">
            @method('PATCH')
            <x-forms.input label="Name" name="common_name" value="{{$cert->common_name}}" />
            <x-forms.input label="Country" name="country"  value="{{$cert->country}}" />
            <x-forms.input label="Organization" name="organization"  value="{{$cert->organization}}" />
            <x-forms.input label="Expiration Date" name="expiry_date" type="date" value="{{ Carbon\Carbon::parse($cert->expiry_date)->format('Y-m-d') }}" />
            <input hidden name="id"  value="{{$cert->id}}">
            <div class="">
                <x-forms.button class="mt-5" >Verify</x-forms.button>
            </div>
        </x-forms.form>
    
    </x-forms.background>
</x-main-layout>