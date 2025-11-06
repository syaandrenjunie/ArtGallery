@props([
    'image' => null, 
    'title', 
    'subtitle' => null, 
    'description' => null, 
    'footer' => null, 
    'link' => '#' // default if no link provided
])

<li class="flex justify-between gap-x-6 py-5 pl-4">
  <a href="{{ $link }}" class="flex min-w-0 gap-x-4 w-full hover:bg-gray-50 rounded-md transition">
    
    @if ($image)
      <img src="{{ $image }}" class="size-12 flex-none rounded-full bg-gray-100" />
    @endif

    <div class="min-w-0 flex-auto">
      <p class="text-sm/6 font-semibold text-gray-900">{{ $title }}</p>
      <p class="mt-1 truncate text-xs/5 text-gray-500">{{ $subtitle }}</p>
    </div>

    <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end pr-4">
      <p class="text-sm/6 text-gray-900">{{ $description }}</p>
      <p class="mt-1 text-xs/5 text-gray-500">{{ $footer }}</p>
    </div>
  </a>
</li>
