<div>
    
        <form 
        wire:submit="changeName()">
        
        <div class='mt-2'> 

            <select
                type="text"
                class="p-4 border rounded-md bg-gray-300"
                wire:model.fill="greeting"
            >
                <option value="Hello">Hello</option>
                <option value="Hi">Hi</option>
                <option value="Greetings" selected>Greetings</option>
                <option value="Salutations">Salutations</option>
            </select>


            <input 
                id="newName" 
                type="text" 
                class="p-4 border rounded-md bg-gray-300"
                wire:model.live="name"
                >
        
        </div>

        <div class="mt-2"> 
            <button 
                type="submit" 
                class="text-black font-medium rounded-md px-4 py-2 bg-green-300"> Greet
            </button> 

        </div>
    </form>

    @if ($name != '' )
        <div class="mt-5"> 
            {{ $greeting }}, {{ $name }} !
        </div>

    @endif

</div>

