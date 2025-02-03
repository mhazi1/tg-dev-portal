@php
   $newtext = strtolower($text);
@endphp
<li class="flex items-center">
    <a href="{{ url('/' .$newtext) }}" class="flex items-center w-full p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-600 group">
      {{ $slot }}
       <span class="ms-3">{{ $text }}</span>
    </a>
 </li>