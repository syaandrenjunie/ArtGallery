<template>
  <div class="space-y-4">
    <!-- Search Bar -->
    <div class="flex gap-3">
      <input v-model="searchTerm" @input="searchArtworks" type="text"
        placeholder="Search artworks by title or artist..."
        class="flex-1 px-4 py-2 border border-gray-500 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" />

      <button v-if="searchTerm" @click="clearSearch"
        class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">
        Clear
      </button>
    </div>

    <!-- Loading indicator -->
    <p v-if="loading" class="text-gray-500 text-sm">Searching...</p>

    <!-- Display Vue Artwork List -->
    <div v-if="isSearching">
      <div v-if="artworks.length > 0"
        class="mt-6 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-4">
        
        <div v-for="artwork in artworks" :key="artwork.id" class="group relative">
          <img :src="getImageUrl(artwork.picture)" :alt="artwork.title"
            class="aspect-square w-full rounded-md bg-gray-200 object-cover group-hover:opacity-75 lg:aspect-auto lg:h-80" />
          
            <div class="mt-4 flex justify-between">
            <div>
              <h3 class="text-sm text-gray-700">
                <a :href="`/artworks/${artwork.id}`">
                  <span aria-hidden="true" class="absolute inset-0"></span>
                  {{ artwork.title }}
                </a>
              </h3>
              <p class="mt-1 text-sm text-gray-500">
                {{ artwork.artist ? artwork.artist.name : 'Unknown Artist' }}
              </p>
            </div>
            <p class="text-sm font-medium text-gray-900">
              RM {{ formatPrice(artwork.price) }}
            </p>
          </div>

        </div>

      </div>

      <!-- No results message -->
      <p v-else-if="!loading" class="text-gray-500 text-center py-8">
        No artworks found for "{{ searchTerm }}"
      </p>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  data() {
    return {
      searchTerm: '',
      artworks: [],
      loading: false,
      debounceTimer: null,
      isSearching: false
    }
  },
  methods: {

    async searchArtworks() {
      clearTimeout(this.debounceTimer);

      if (!this.searchTerm.trim()) {
        this.artworks = [];
        this.isSearching = false;
        this.showBladeGrid();
        return;
      }

      this.isSearching = true;
      this.hideBladeGrid();

      this.debounceTimer = setTimeout(async () => {
        this.loading = true;

        try {
          const response = await axios.get('/api/artworks', {
            params: {
              search: this.searchTerm
            }
          });

          this.artworks = response.data.data;
        } catch (error) {
          console.error('Search failed:', error);
          this.artworks = [];
        } finally {
          this.loading = false;
        }
      }, 500);
    },

    clearSearch() {
      this.searchTerm = '';
      this.artworks = [];
      this.isSearching = false;
      this.showBladeGrid();
    },

    hideBladeGrid() {
      // Target the wrapper ID added in Blade
      const bladeGrid = document.getElementById('blade-artwork-grid');
      if (bladeGrid) {
        bladeGrid.style.display = 'none';
      }
    },

    showBladeGrid() {
      // Target the wrapper ID added in Blade
      const bladeGrid = document.getElementById('blade-artwork-grid');
      if (bladeGrid) {
        bladeGrid.style.display = 'block';
      }
    },

    getImageUrl(picture) {
      // Check if URL starts with http (external) or needs storage path
      if (picture && picture.startsWith('http')) {
        return picture;
      }
      return `/storage/${picture}`;
    },

    formatPrice(price) {
      // Format price to 2 decimal places with commas
      return parseFloat(price).toLocaleString('en-MY', {
        minimumFractionDigits: 2,
        maximumFractionDigals: 2
      });
    }
  }
}
</script>