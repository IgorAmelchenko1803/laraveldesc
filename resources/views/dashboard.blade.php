<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Доска объявлений') }}
        </h2>
    </x-slot>

    <x-admin.elements.ul>
       @foreach($subjects as $subject)
            <x-admin.elements.ul>
                <x-admin.elements.li>
                    {{$subject->name}}
                </x-admin.elements.li>
                @foreach($subject->subcategories as $categories)
                    <x-admin.elements.li>
                        <x-admin.elements.a href="/{{$subject->id}}/{{$categories->id}}">
                            {{$categories->name}}
                        </x-admin.elements.a>
                    </x-admin.elements.li>
                @endforeach
            </x-admin.elements.ul>
       @endforeach
    </x-admin.elements.ul>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>

    
               
</x-app-layout>
