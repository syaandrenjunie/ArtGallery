<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Artists Listing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">

<x-text-input type="text" id="searchName" placeholder="Search artist" class="mr-2" />
                    <x-primary-button id="searchBtn">Search</x-primary-button>
                <!-- Artist List -->
                <ul id="artistList" class="space-y-2 p-4"></ul>

            </div>
        </div>
    </div>

    <script>
        // Function to fetch and update the artist list
        function loadArtists(url) {
            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const list = document.getElementById('artistList');
                    list.innerHTML = ''; // Clear previous list

                    data.data.forEach(artist => {
                        const li = document.createElement('li');
                        li.textContent = `${artist.name} - ${artist.email}`;
                        list.appendChild(li);
                    });
                })
                .catch(error => console.error('Error fetching artists:', error));
        }

        // Initial load: all artists
        loadArtists('{{ url("/api/artists") }}');

        //
        document.getElementById('searchBtn').addEventListener('click', function () {
            const name = document.getElementById('searchName').value;
            loadArtists(`{{ url('/api/artists') }}?name=${name}`);
        });


    </script>
</x-app-layout>