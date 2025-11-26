<div>

    <form wire:submit="changeGreeting()">

        <div class='mt-2'>

            <select type="text" class="p-4 border rounded-md bg-gray-300" wire:model.fill="greeting">

                @foreach ($greetings as $item)
                    <option value="{{ $item->greeting_text }}">
                        {{ $item->greeting_text }}
                    </option>

                @endforeach
            </select>

            <input id="newName" type="text" class="p-4 border rounded-md bg-gray-300" wire:model.fill="name">

        </div>

        <div>
            @error('name')
                {{ $message }}
            @enderror

        </div>

        <div class="mt-2">
            <button type="submit" class="text-black font-medium rounded-md px-4 py-2 bg-green-300"> Greet
            </button>

        </div>
    </form>

    @if ($greetingMessage != '')
        <div class="mt-5">
            {{ $greetingMessage }}
        </div>

    @endif

</div>