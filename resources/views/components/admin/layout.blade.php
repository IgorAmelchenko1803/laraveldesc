<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Панель администратора') }}
        </h2>
    </x-slot>
    <hr>
   <x-admin.nav>
        {{--Enter your content --}}
        {{$slot}}
   </x-admin>
    
</x-app-layout>
