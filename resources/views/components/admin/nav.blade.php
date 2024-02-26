<div class="flex bg-white">
  <!-- Vertical navigation menu -->
  <aside class="bg-gray-50 w-1/3">
    <ul class="space-y-2">
      <li class="space-y-1">
        <div class="px-2 py-1 text-black">{{ __('Управление категориями') }}</div>
        <ul class="bg-gray-100 ml-4">
          <li><a href="{{ route('admin.create.category') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Создать</a></li>
          <li><a href="{{ route('admin.edit.category') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Редактировать</a></li>
          <li><a href="{{ route('admin.delete.category') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Удалить</a></li>
        </ul>
      </li>
      <li class="space-y-1">
        <div class="px-2 py-1 text-black">{{ __('Управление подкатегориями') }}</div>
        <ul class="bg-gray-100 ml-4">
          <li><a href="{{ route('admin.create.subcategory') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Создать</a></li>
          <li><a href="{{ route('admin.edit.subcategory') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Редактировать</a></li>
          <li><a href="{{ route('admin.delete.subcategory') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Удалить</a></li>
          <li><a href="{{ route('admin.insert.subcategory') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Добавить подкатегорию в категорию</a></li>
        </ul>
      </li>
      <li class="space-y-1">
        <div class="px-2 py-1 text-black">{{ __('Управление объявлениями') }}</div>
        <ul class="bg-gray-100 ml-4">
          <li><a href="{{ route('admin.create.message') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Создать</a></li>
          <li><a href="{{ route('admin.edit.message') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Редактировать</a></li>
          <li><a href="{{ route('admin.delete.message') }}" class="block px-2 py-1 text-sm hover:bg-gray-200">Удалить</a></li>
        </ul>
      </li>
    </ul>
  </aside>

  <!-- Vertical separator line -->
  <div class="border border-gray-200 w-px"></div>

  <!-- Content area -->
  <main class="w-2/3">
    {{$slot}}
  </main>
</div>
