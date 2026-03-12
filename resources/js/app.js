import './bootstrap';

import api from './api';    //imports ApiClient class
window.api = api;   

// Start Alpine
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Vue Setup
import { createApp } from 'vue'

//Import Vue components (Registration)
import HelloVue from './components/tests/HelloVue.vue';
import ArtistSearch from './components/artists/ArtistSearch.vue';
import ArtworkSearch from './components/artworks/ArtworkSearch.vue';

createApp(HelloVue).mount('#hello-vue');
createApp(ArtistSearch).mount('#search-artists');
createApp(ArtworkSearch).mount('#search-artworks');