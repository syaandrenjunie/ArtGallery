import './bootstrap';

//Alpine setup
import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// Vue Setup
import { createApp } from 'vue'

//Import Vue components (Registration)
import ArtistSearch from './components/artists/ArtistSearch.vue'
import ArtworkSearch from './components/artworks/ArtworkSearch.vue'
import FavoriteButton from './components/artworks/FavoriteButton.vue'

// Wait for DOM to be ready
window.addEventListener('load', () => {
    // Mount Artist Search -  use if cause it is single element / Need if to check if exits
    const artistSearchEl = document.querySelector('#vue-search')
    if (artistSearchEl) {
        createApp(ArtistSearch).mount('#vue-search')
    }
    
    // Mount Artwork Search
    const artworkSearchEl = document.querySelector('#vue-artwork-search')
    if (artworkSearchEl) {
        createApp(ArtworkSearch).mount('#vue-artwork-search')
    }

    // Favorite button
    // use document cause we have many favorite button in one page / for sure exist
    document.querySelectorAll('.favorite-button-mount').forEach(el => {
        const artworkId = parseInt(el.dataset.artworkId)
        const isFavorited = el.dataset.isFavorited === 'true'
        const favoritesCount = parseInt(el.dataset.favoritesCount || 0)
        const size = el.dataset.size || 'md'
        
        const app = createApp(FavoriteButton, {
            artworkId,
            initialFavorited: isFavorited,
            initialCount: favoritesCount,
            size
        })
        app.mount(el)
    })
})