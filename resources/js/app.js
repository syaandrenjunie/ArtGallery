import './bootstrap';

//Alpine setup
import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

// Vue Setup
import { createApp } from 'vue'


//Import Vue components - single root
import Example from './components/Example.vue'


//Create new app instance
createApp(Example).mount('#vue-app')


/* Global registration

import { createApp } from 'vue'
import Example from './components/Example.vue'
import Quotes from './components/Quotes.vue'
import Artist from './components/Artist.vue'

const app = createApp({})

app.component('example-component', Example)
app.component('quotes-component', Quotes)
app.component('artist-component', Artist)

app.mount('#vue-app') */
