<x-main-layout>
   <x-page-heading>Add Client</x-page-heading>
   <x-page-back route="clients" />
   <x-forms.background>
      <x-forms.form method="POST" action="{{route('store-client')}}" class="loading-form">
         <x-forms.input label="Name" name="name" placeholder="Abu bin Ali"  />
         <x-forms.input label="Role" name="role" placeholder="Human Resource Manager" />
         <x-forms.input label="Company" name="company" placeholder="TechGuard Solutions" />
         <x-forms.divider />
         <div class="text-center">
            <x-forms.button>Add</x-forms.button>
         </div>
      </x-forms.form>
   </x-forms.background>
</x-main-layout>