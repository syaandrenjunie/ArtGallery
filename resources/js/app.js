import './bootstrap';

import api from './api';    //imports ApiClient class
window.api = api;   

// Vue Setup
import { createApp } from 'vue'

//Import Vue components (Registration)
import HelloVue from './components/tests/HelloVue.vue';
import ArtistSearch from './components/artists/ArtistSearch.vue';

createApp(HelloVue).mount('#hello-vue');
createApp(ArtistSearch).mount('#search-artists');