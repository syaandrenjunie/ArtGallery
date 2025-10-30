<x-layout>

  <x-slot:heading>
    Create Artists
  </x-slot:heading>

  <x-slot:resource>artists</x-slot:resource>


  <form action="{{ route('artists.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="space-y-12">
      <div class="border-b border-gray-900/10 pb-12">
        <h2 class="text-base/7 font-semibold text-gray-900">Profile</h2>
        <p class="mt-1 text-sm/6 text-gray-600">This information will be displayed publicly so be careful what you
          share.
        </p>

        <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6">
          <div class="sm:col-span-4">
            <label for="name" class="block text-sm/6 font-medium text-gray-900">Name</label>
            <div class="mt-2">
              <div
                class="flex items-center rounded-md bg-white pl-3 outline-1 -outline-offset-1 outline-gray-300 focus-within:outline-2 focus-within:-outline-offset-2 focus-within:outline-indigo-600">
                <input id="name" type="text" name="name" placeholder="janesmith"
                  class="block min-w-0 grow bg-white py-1.5 pr-3 pl-1 text-base text-gray-900 placeholder:text-gray-400 focus:outline-none sm:text-sm/6"
                  required />
              </div>

              @error('name')
                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
              @enderror

            </div>
          </div>

          <div class="col-span-full">
            <label for="bio" class="block text-sm/6 font-medium text-gray-900">Bio</label>
            <div class="mt-2">
              <textarea id="bio" name="bio" rows="3"
                class="block w-full rounded-  md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 
                  placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6"
                placeholder="Write a few sentences about yourself."></textarea>
            </div>

              @error('bio')
                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
              @enderror

          </div>

          <div class="sm:col-span-4">
            <label for="email" class="block text-sm/6 font-medium text-gray-900">Email address</label>
            <div class="mt-2">
              <input id="email" type="email" name="email" autocomplete="email" placeholder="xxx@example.com"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 
                  placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required />
            </div>

            @error('email')
              <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
            @enderror

          </div>

          <div class="sm:col-span-4">
            <label for="contact" class="block text-sm/6 font-medium text-gray-900">Phone number</label>
            <div class="mt-2">
              <input id="contact" type="text" name="contact" placeholder="0123456789"
                class="block w-full rounded-md bg-white px-3 py-1.5 text-base text-gray-900 outline-1 -outline-offset-1 outline-gray-300 
                  placeholder:text-gray-400 focus:outline-2 focus:-outline-offset-2 focus:outline-indigo-600 sm:text-sm/6" required />
            </div>

              @error('contact')
                <p class="text-xs text-red-500 font-semibold">{{ $message }}</p>
              @enderror
              
          </div>

          <div class="col-span-full">
            <label for="picture" class="block text-sm/6 font-medium text-gray-900">Photo</label>
            <div class="mt-2 flex items-center gap-x-3">
              <svg viewBox="0 0 24 24" fill="currentColor" data-slot="icon" aria-hidden="true"
                class="size-12 text-gray-300">
                <path
                  d="M18.685 19.097A9.723 9.723 0 0 0 21.75 12c0-5.385-4.365-9.75-9.75-9.75S2.25 6.615 2.25 12a9.723 9.723 0 0 0 3.065 7.097A9.716 9.716 0 0 0 12 21.75a9.716 9.716 0 0 0 6.685-2.653Zm-12.54-1.285A7.486 7.486 0 0 1 12 15a7.486 7.486 0 0 1 5.855 2.812A8.224 8.224 0 0 1 12 20.25a8.224 8.224 0 0 1-5.855-2.438ZM15.75 9a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0Z"
                  clip-rule="evenodd" fill-rule="evenodd" />
              </svg>
              <button type="button"
                class="rounded-md bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-xs inset-ring inset-ring-gray-300 hover:bg-gray-50">Change</button>
            </div>
          </div>

        </div>
      </div>



    </div>

    <div class="mt-6 flex items-center justify-end gap-x-6">
      <button type="button" class="text-sm/6 font-semibold text-gray-900">Cancel</button>
      <button type="submit"
        class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-xs hover:bg-indigo-500 focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600">Save</button>
    </div>
  </form>


</x-layout>