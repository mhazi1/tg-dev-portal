@props(['text', 'number'])
<div class="p-4 pb-10 mt-10 bg-white/90 rounded-xl dark:bg-gray-700 dark:shadow-md">
    <p class="text-sm text-slate-500 dark:text-white/50">{{ $text }}</p>
    <p {{$attributes(["class" => "mt-2 text-2xl font-bold dark:text-white/90"])}}>{{ $number }}</p>
</div>