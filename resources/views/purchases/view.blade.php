<x-app-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
      {{ $purchase->artwork->title}}
    </h2>
  </x-slot>

  <x-slot:resource>purchases</x-slot:resource>

</x-app-layout>