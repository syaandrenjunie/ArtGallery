<x-app-layout>

  <x-slot name="header">

    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ __('Create Artist') }}
    </h2>

  </x-slot>

  <x-card-container>

    <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <div class="space-y-8">

        {{-- Name --}}
        <div>
          <x-input-label for="name" class="block text-sm font-medium text-gray-900">Name</x-input-label>
          <x-text-input id="name" name="name" type="text" placeholder="Jane Smith" class="mt-1 block w-full" required />
          @error('name')
            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
          @enderror
        </div>

        {{-- Bio --}}
        <div>
          <x-input-label for="bio" class="block text-sm font-medium text-gray-900">Bio</x-input-label>
          <x-text-area id="bio" name="bio" rows="3" class="mt-1 block w-full"
            placeholder="Write a few sentences about yourself."></x-text-area>
          @error('bio')
            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
          @enderror
        </div>

        {{-- Email --}}
        <div>
          <x-input-label for="email" class="block text-sm font-medium text-gray-900">Email address</x-input-label>
          <x-text-input id="email" name="email" type="email" placeholder="example@example.com" class="mt-1 block w-full"
            required />
          @error('email')
            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
          @enderror
        </div>

        {{-- Phone --}}
        <div>
          <x-input-label for="contact" class="block text-sm font-medium text-gray-900">Phone number</x-input-label>
          <x-text-input id="contact" name="contact" type="text" placeholder="0123456789" class="mt-1 block w-full"
            required />
          @error('contact')
            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
          @enderror
        </div>

        {{-- Picture --}}
        <div>
          <x-input-label for="picture" class="block text-sm font-medium text-gray-900">Photo</x-input-label>
          <input type="file" id="picture" name="picture" class="mt-1 block w-full text-sm text-gray-700" />
          @error('picture')
            <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
          @enderror
        </div>

      </div>

      {{-- Buttons --}}
      <div class="mt-8 flex justify-end gap-x-4">
        <a href="{{ route('artists.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Cancel</a>
        <x-primary-button>Save</x-primary-button>
      </div>

    </form>


  </x-card-container>
</x-app-layout>