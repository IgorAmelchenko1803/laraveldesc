<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Создать обьявление') }} 
        </h2>
        
    </x-slot>

    @if (Session::has('success'))
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif
    
   <x-admin.elements.form>
        <x-admin.elements.header>
            {{ __('Выберите категорию:') }} 
        </x-admin.elements.header>
        <x-admin.elements.select name="categoryId">
            @foreach($categories as $category)
                <x-admin.elements.option  value="{{$category->id}}">  
                        {{$category->name}}
                </x-admin.elements.option> 
            @endforeach
        </x-admin.elements.select>

        <x-admin.elements.header>
            {{ __('Выберите подкатегорию:') }} 
        </x-admin.elements.header>
        <x-admin.elements.select name="subcategoryId">
            @foreach($subcategories as $subcategory)
                <x-admin.elements.option  value="{{$subcategory->id}}">  
                        {{$subcategory->name}}
                </x-admin.elements.option> 
            @endforeach
        </x-admin.elements.select>

        <x-admin.elements.header>
            {{ __('Название обьявления:') }} 
        </x-admin.elements.header>
        <x-admin.elements.input name="name" />
        @error('name'){{-- Если поле менее 4 или более 255 символов - вывод ошибки --}}
        <div class="text-red-600">{{ $message }}</div>
     @enderror

        <x-admin.elements.header name="text">
            {{ __('Текст обьявления:') }} 
        </x-admin.elements.header>
        <x-admin.elements.textarea name="text" />
        @error('text'){{-- Если поле менее 4 или более 255 символов - вывод ошибки --}}
        <div class="text-red-600">{{ $message }}</div>
     @enderror

        <x-admin.elements.inputSubmit />
       
   </x-admin.elements.form>


    
               
</x-app-layout>
