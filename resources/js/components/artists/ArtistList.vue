<template>
    <div>
        <p v-if="loading" class="text-gray-500 text-sm px-4">Searching...</p>

        <ul v-else-if="artists.length > 0" class="divide-y divide-gray-100">
            <li v-for="artist in artists" :key="artist.id" class="flex justify-between gap-x-6 py-5 pl-4">
                <a :href="`/artists/${artist.id}`"
                    class="flex min-w-0 gap-x-4 w-full hover:bg-gray-50 rounded-md transition">
                    <img v-if="artist.picture" :src="artist.picture" :alt="artist.name"
                        class="size-12 flex-none rounded-full bg-gray-100" />
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

        <p v-else-if="!loading && searchTerm" class="text-gray-500 text-center py-8">
            No artists found for "{{ searchTerm }}"
        </p>
    </div>
</template>

<script>
export default {
    name: 'ArtistList',
    props: {
        artists: { type: Array, default: () => [] },
        loading: { type: Boolean, default: false },
        searchTerm: { type: String, default: '' }
    },
    watch: {
        // Watch artists and searchTerm for debugging
        artists(newVal) {
            console.log('[ArtistList] artists updated:', newVal);
        },
        searchTerm(newVal) {
            console.log('[ArtistList] searchTerm updated:', newVal);
        }
    }
}
</script>
