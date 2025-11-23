<template>
  <button
    type="button"
    @click="toggleFavorite"
    :disabled="loading"
    :class="buttonClasses"
    class="inline-flex items-center justify-center focus:ring-4 shadow-xs rounded-base focus:outline-none transition-all relative"
    :title="isFavorited ? 'Remove from favorites' : 'Add to favorites'"
  >
    <svg 
      :class="{ 'animate-heart': justFavorited }"
      class="w-5 h-5"
      aria-hidden="true" 
      xmlns="http://www.w3.org/2000/svg" 
      width="24" 
      height="24" 
      :fill="isFavorited ? 'currentColor' : 'none'" 
      viewBox="0 0 24 24"
    >
      <path 
        stroke="currentColor" 
        stroke-linecap="round" 
        stroke-linejoin="round" 
        stroke-width="2" 
        d="M12.01 6.001C6.5 1 1 8 5.782 13.001L12.011 20l6.23-7C23 8 17.5 1 12.01 6.002Z"
      />
    </svg>
    
    <span class="sr-only">
      {{ isFavorited ? 'Remove from favorites' : 'Add to favorites' }}
    </span>
  </button>
</template>

<script>
import axios from 'axios';

export default {
  props: {
    artworkId: {
      type: Number,
      required: true
    },
    initialFavorited: {
      type: Boolean,
      default: false
    },
    initialCount: {
      type: Number,
      default: 0
    },
    size: {
      type: String,
      default: 'md',
      validator: (value) => ['sm', 'md', 'lg'].includes(value)
    }
  },
  data() {
    return {
      isFavorited: this.initialFavorited,
      favoritesCount: this.initialCount,
      loading: false,       //tracks API request status
      justFavorited: false  //trigger animation
    }
  },
  computed: {
    buttonClasses() {
      const sizeClasses = {
        'sm': 'w-8 h-8',
        'md': 'w-9 h-9',
        'lg': 'w-10 h-10'
      };

      const baseClasses = sizeClasses[this.size];
      const disabledClasses = this.loading ? 'opacity-50 cursor-not-allowed' : '';

      if (this.isFavorited) {
        // Filled style (when favorited)
        return `text-white bg-red-600 hover:bg-red-700 focus:ring-red-300 ${baseClasses} ${disabledClasses}`;
      } else {
        // Outlined style (when not favorited)
        return `text-red-600 bg-white border border-red-600 hover:bg-red-600 hover:text-white focus:ring-red-200 ${baseClasses} ${disabledClasses}`;
      }
    }
  },
  methods: {
    async toggleFavorite() {
      if (this.loading) return;

      this.loading = true;

      try {
        const response = await axios.post(`/api/artworks/${this.artworkId}/favorite`);
        
        this.isFavorited = response.data.is_favorited;
        this.favoritesCount = response.data.favorites_count;

        // Trigger animation when favorited
        if (this.isFavorited) {
          this.justFavorited = true;
          setTimeout(() => {
            this.justFavorited = false;
          }, 600);
        }

        this.$emit('favorited', {
          artworkId: this.artworkId,
          isFavorited: this.isFavorited
        });

      } catch (error) {
        console.error('Favorite toggle failed:', error);
        
        if (error.response && error.response.status === 401) {
          alert('Please login to add favorites');
          // Optional: redirect to login
          // window.location.href = '/login';
        } else {
          alert('Failed to update favorite. Please try again.');
        }
      } finally {
        this.loading = false;
      }
    }
  }
}
</script>

<style scoped>
@keyframes heartBeat {
  0%, 100% {
    transform: scale(1);
  }
  25% {
    transform: scale(1.3);
  }
  50% {
    transform: scale(1.1);
  }
}

.animate-heart {
  animation: heartBeat 0.6s ease;
}
</style>