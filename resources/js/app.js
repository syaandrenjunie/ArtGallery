import './bootstrap';

//Alpine setup
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Vue Setup
import { createApp } from 'vue'


//Import Vue components - single root
import ArtistSearch from './components/artists/ArtistSearch.vue'
import ArtworkSearch from './components/artworks/ArtworkSearch.vue'




//Create new app instance
createApp(ArtistSearch).mount('#vue-search')
createApp(ArtworkSearch).mount('#vue-artwork-search')