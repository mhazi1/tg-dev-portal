<x-main-layout>
   <x-page-heading>Add Certificate</x-page-heading>
   <x-page-back route="certificates" />
   <x-forms.background>
      <x-forms.form method="POST" action="{{route('store-certificate')}}" class="loading-form">
         <x-forms.input label="Common Name" name="common_name" placeholder="example.com"  />
         <x-forms.input label="Country" name="country" placeholder="MY" />
         <x-forms.input label="Organization" name="organization" placeholder="Let's Encrypt" />
         <x-forms.input label="Expiration Date" name="expiry_date" type="date" />
         <x-forms.divider />
         <div class="text-center">
            <x-forms.button>Add</x-forms.button>
         </div>
      </x-forms.form>
   </x-forms.background>
</x-main-layout>