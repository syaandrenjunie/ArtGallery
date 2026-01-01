<template>
  <div>
    <!-- Reusable Search Bar (Child) -->
    <SearchBar v-model="searchQuery" placeholder="Search by name, bio, or email..." @search="handleSearch"
      @clear="handleClear" />

    <!-- Show results only when searching -->
    <div v-if="isSearching">
      <ArtistList :artists="artists" :loading="loading" :search-term="searchQuery" />
    </div>
  </div>
</template>

<script>
import api from '../../api.js';
import SearchBar from '../shared/SearchBar.vue';
import ArtistList from './ArtistList.vue';

export default {
  name: 'ArtistSearch',
  components: { SearchBar, ArtistList },
  data() {
    return {
      searchQuery: '',
      artists: [],
      loading: false,
      debounceTimer: null,
      isSearching: false
    }
  },
  watch: {
    // Watch searchQuery to see v-model updates in real-time
    searchQuery(newVal) {
      console.log('[ArtistSearch] searchQuery updated:', newVal);
    }
  },
  methods: {
    handleSearch(searchTerm) {
      console.log('[ArtistSearch] handleSearch triggered with:', searchTerm);
      clearTimeout(this.debounceTimer);

      if (!searchTerm.trim()) {
        this.artists = [];
        this.isSearching = false;
        this.showBladeList();
        return;
      }

      this.isSearching = true;
      this.hideBladeList();

      this.debounceTimer = setTimeout(async () => {
        await this.searchArtists(searchTerm);
      }, 500);
    },

    async searchArtists(searchTerm) {
      this.loading = true;
      console.log('[ArtistSearch] Searching artists for:', searchTerm);

      try {
        const endpoint = `/artists/search?name=${encodeURIComponent(searchTerm)}`;
        const response = await api.get(endpoint);

        console.log('[ArtistSearch] API response:', response);

        this.artists = response.data || response;
      } catch (error) {
        console.error('[ArtistSearch] Search failed:', error);
        this.artists = [];
      } finally {
        this.loading = false;
      }
    },

    handleClear() {
      console.log('[ArtistSearch] handleClear triggered');
      this.searchQuery = '';
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
