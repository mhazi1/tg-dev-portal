<x-main-layout>
    <x-page-heading>Register User</x-page-heading>
    <x-page-back route="users" />

    <x-forms.background>
        <x-forms.form method="POST" action="/register" class="loading-form" >
            <x-forms.input label="Name" name="name" />
            <x-forms.input label="Email" name="email" type="email" />
            
            <x-forms.select label="Role" name="role" class="dark:text-white/90 dark:bg-gray-800/90">
                <option value="support">Support</option>
                <option value="developer">Developer</option>
                <option value="admin">Admin</option>
            </x-forms.select> 
            <div class="text-right">
                <x-forms.button class="mt-5" >Register</x-forms.button>
            </div>
        </x-forms.form>
    </x-forms.background>
</x-main-layout>