@if(Gate::allows('show-my-message', $message) or Gate::allows('delete-admin-message'))
@error('error')
    <div class="alert alert-danger">{{ $message }}</div>
@enderror

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Редактировать обьявление') }} 
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
                @if($categoryId === $categoryId)
                    <x-admin.elements.option  value="{{$category->id}}" selected>  
                                {{$category->name}}
                    </x-admin.elements.option> 
                @else
                    <x-admin.elements.option  value="{{$category->id}}">  
                            {{$category->name}}
                    </x-admin.elements.option> 
                @endif
            @endforeach
        </x-admin.elements.select>

        <x-admin.elements.header>
            {{ __('Выберите подкатегорию:') }} 
        </x-admin.elements.header>
        <x-admin.elements.select name="subcategoryId">
            @foreach($subcategories as $subcategory)
                @if($subcategoryId === $subcategory->id)
                    <x-admin.elements.option  value="{{$subcategory->id}}" selected>  
                            {{$subcategory->name}}
                    </x-admin.elements.option> 
                @else
                    <x-admin.elements.option  value="{{$subcategory->id}}">  
                            {{$subcategory->name}}
                    </x-admin.elements.option> 
                @endif
            @endforeach
        </x-admin.elements.select>

        <x-admin.elements.header>
            {{ __('Название обьявления:') }} 
        </x-admin.elements.header>
        <x-admin.elements.input name="name" value="{{$message->name}}" />
            @error('name')
    <div class="text-red-600">{{ $errors->first('name') }}</div>
    @enderror

        <x-admin.elements.header >
            {{ __('Текст обьявления:') }} 
        </x-admin.elements.header>
        <x-admin.elements.textarea name="text"  />{{-- Почему не могу тут вставить :text="{{$message-text}}"? --}}
        
        @error('text')
<div class="text-red-600">{{ $errors->first('text') }}</div>
@enderror

        <x-admin.elements.inputSubmit />
       
   </x-admin.elements.form>


    
               
</x-app-layout>
@endif