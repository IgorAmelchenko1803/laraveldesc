<x-admin.layout>
    <x-admin.elements.header>
        {{ __('Добавление подкатегории в категорию') }}
    </x-admin.elements.header>

    <x-admin.elements.form>

        <x-admin.elements.header>
         {{ __('Выберите категорию из списка:') }}
        </x-admin.elements.header>

        <x-admin.elements.select name="categoryId">
                <x-admin.elements.option  value="all">  
                    {{ __('Добавить подкатегорию во все категории') }}
                </x-admin.elements.option> 
            @foreach($categories as $category)
                <x-admin.elements.option  value="{{$category->id}}">  
                        {{$category->name}}
                </x-admin.elements.option> 
            @endforeach
        </x-admin.elements.select>

        <x-admin.elements.header>
         {{ __('Выерете подкатегорию из списка:') }}
        </x-admin.elements.header>

        <x-admin.elements.select name="subcategoryId">
                
            @foreach($subcategories as $subcategory)
                
                    <x-admin.elements.option value="{{$subcategory->id}}">  
                        {{$subcategory->name}}
                    </x-admin.elements.option> 
                
            @endforeach
        </x-admin.elements.select>

        <x-admin.elements.inputSubmit />


    </x-admin.elements.form>


    @error('name'){{-- Если поле менее 4 или более 255 символов - вывод ошибки --}}
        <div class="text-red-600">{{ $message }}</div>
    @enderror

    @if (Session::has('success')){{-- при успешном добавлении новой категории выводим флеш соощение --}}
        <div class="alert alert-success">{{ Session::get('success') }}</div>
    @endif

    
    <x-admin.elements.header>
         {{ __('Список категори и сабкатегорий:') }}
    </x-admin.elements.header>

    <x-admin.elements.ul>
        @foreach($categories as $category)
            <x-admin.elements.li> 
                {{$category->name}}
            </x-admin.elements.li> 
             
            @foreach($category->subcategories as $subcategory)
                <x-admin.elements.li> 
                    <x-admin.elements.a href="/{{$category->id}}/{{$subcategory->id}}"> 
                        {{$subcategory->name}}
                    </x-admin.elements.a>
                </x-admin.elements.li> 
            @endforeach
        @endforeach
    </x-admin.elements.ul>


 
</x-admin.layout>