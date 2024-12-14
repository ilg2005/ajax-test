<script setup>
import { computed } from 'vue';

const props = defineProps({
  currentPage: {
    type: Number,
    required: true,
  },
  lastPage: {
    type: Number,
    required: true,
  },
});

const pages = computed(() => {
  const showAround = 2;
  const pages = [];

  for (let i = 1; i <= props.lastPage; i++) {
    if (
      i === 1 ||
      i === props.lastPage ||
      (i >= props.currentPage - showAround && i <= props.currentPage + showAround)
    ) {
      pages.push({ number: i, isPage: true });
    } else if (pages.length > 0 && pages[pages.length - 1].isPage) {
      pages.push({ number: '...', isPage: false });
    }
  }

  return pages;
});
</script>

<template>
  <div class="flex justify-center mt-4">
    <nav class="flex items-center space-x-2" aria-label="Pagination">
      <button
        :disabled="currentPage === 1"
        @click="$emit('page-changed', currentPage - 1)"
        class="px-3 py-1 border rounded disabled:opacity-50"
      >
        <span class="hidden md:inline">Назад</span>
        <span class="md:hidden">&larr;</span>
      </button>

      <button
        v-for="page in pages"
        :key="page.number"
        @click="page.isPage && $emit('page-changed', page.number)"
        :class="[
          'px-3 py-1 border rounded',
          page.isPage
            ? page.number === currentPage
              ? 'bg-blue-500 text-white'
              : 'bg-white text-blue-500'
            : 'bg-white text-gray-400 cursor-default'
        ]"
        :disabled="!page.isPage"
      >
        {{ page.number }}
      </button>

      <button
        :disabled="currentPage === lastPage"
        @click="$emit('page-changed', currentPage + 1)"
        class="px-3 py-1 border rounded disabled:opacity-50"
      >
        <span class="hidden md:inline">Вперед</span>
        <span class="md:hidden">&rarr;</span>
      </button>
    </nav>
  </div>
</template>

