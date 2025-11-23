<template>
  <div>
    <!-- Search Bar -->
    <div class="p-4 flex gap-3">
      <input 
        v-model="searchName"
        @input="searchArtists"
        type="text" 
        placeholder="Search by name..."
        class=" flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
      />
      
      <button 
        v-if="searchName"
        @click="clearSearch"
        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition"
      >
        Clear
      </button>
    </div>

    <!-- Show Vue results when searching -->
    <div v-if="isSearching">
      <p v-if="loading" class="text-gray-500 text-sm">Searching...</p>

      <ul v-if="artists.length > 0" class="divide-y divide-gray-100">
        <li 
          v-for="artist in artists" 
          :key="artist.id"
          class="flex justify-between gap-x-6 py-5 pl-4"
        >
          <a 
            :href="`/artists/${artist.id}`" 
            class="flex min-w-0 gap-x-4 w-full hover:bg-gray-50 rounded-md transition"
          >
            <img 
              v-if="artist.picture"
              :src="artist.picture" 
              :alt="artist.name"
              class="size-12 flex-none rounded-full bg-gray-100" 
            />
            <div class="min-w-0 flex-auto">
              <p class="text-sm/6 font-semibold text-gray-900">{{ artist.name }}</p>
              <p class="mt-1 truncate text-xs/5 text-gray-500">{{ artist.email }}</p>
            </div>
            <div class="hidden shrink-0 sm:flex sm:flex-col sm:items-end pr-4">
              <p class="text-sm/6 text-gray-900">{{ artist.bio }}</p>
              <p class="mt-1 text-xs/5 text-gray-500">{{ artist.contact }}</p>
            </div>
          </a>
        </li>
      </ul>

      <p v-else-if="!loading" class="text-gray-500 text-center py-8">
        No artists found for "{{ searchName }}"
      </p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      searchName: '',
      artists: [],
      loading: false,
      debounceTimer: null,
      isSearching: false // Track if user is searching
    }
  },
  methods: {
    async searchArtists() {
      clearTimeout(this.debounceTimer);  //stop previous typing timer

      if (!this.searchName.trim()) {
        this.artists = [];
        this.isSearching = false;
        this.showBladeList();   //blade list appears when user delete text
        return;
      }

      this.isSearching = true;
      this.hideBladeList();     //when user enter text, display vue list

      this.debounceTimer = setTimeout(async () => {       //when user finish typing, then call the API
        this.loading = true;  

        try {
          const response = await axios.get('/api/artists', {    //larvael receives name and filters results
            params: {
              name: this.searchName
            }
          });
          
          this.artists = response.data.data;    //vue updates search result list
        } catch (error) {
          console.error('Search failed:', error);
          this.artists = [];
        } finally {
          this.loading = false;
        }
      }, 500);
    },

    clearSearch() {
      this.searchName = '';
      this.artists = [];
      this.isSearching = false;
      this.showBladeList();
    },

    hideBladeList() {
      const bladeList = document.getElementById('blade-artist-list');
      if (bladeList) bladeList.style.display = 'none';
    },

    showBladeList() {
      const bladeList = document.getElementById('blade-artist-list');
      if (bladeList) bladeList.style.display = 'block';
    }
  }
}
</script>