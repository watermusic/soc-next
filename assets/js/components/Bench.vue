<template>
  <div class="w-full">
    <p v-if="store.loading">Loading players...</p>
    <p v-if="store.error">{{ error.message }}</p>
    <TabGroup v-if="store.players">
      <TabPanels class="border-t border-gray-300 bg-gray-100">

        <TabPanel
            v-for="(category, idx) in categories"
            :key="idx"
            :class="[
            'bg-gray-100 p-2',
            'ring-white ring-opacity-60 ring-offset-2 ring-offset-blue-400 focus:outline-none focus:ring-2',
          ]"
        >
          <div class="flex flex-col w-full overflow-x-scroll">
            <div class="flex flex-row flex-grow-0 relative w-full">
              <div role="tablist" aria-orientation="horizontal" class="flex flex-row">
                <div
                    v-for="player in store.getPlayersOnBench"
                    :key="player.id"
                    :class="[
                        'relative group block w-20 h-28 relative flex-shrink-0 mx-2 rounded-lg overflow-hidden cursor-pointer',
                        getBgColorByShortcut(player.position.shortcut)
                    ]"
                    class=" "
                    @click="store.movePlayerToPitch(player)"
                >
                    <div class="w-full h-full opacity-25" :style="'background-image: url(' + player.team.img + '); opacity: 0.1; background-size: cover;'"></div>
                    <img :src="player.img" :alt="player.name" class="absolute bottom-0 w-full h-auto pointer-events-none group-hover:opacity-75">
                    <div class="flex flex-col m-1 absolute top-0">
                      <p class="block text-xs font-medium text-white truncate pointer-events-none">{{ player.name }}</p>
                    </div>
                </div>
              </div>
            </div>
          </div>
        </TabPanel>
      </TabPanels>
      <TabList class="flex space-x-0 bg-gray-200 py-0 px-4">
        <Tab
            v-for="(category, idx) in categories"
            as="template"
            :key="idx"
            v-slot="{ selected }"
        >
          <button
              :class="[
              'w-full py-3 text-sm font-medium leading-5',
              'ring-transparent ring-opacity-60 ring-offset-0 ring-offset-blue-400 focus:outline-none focus:ring-0',
              selected
                ? 'bg-gray-100 text-sky-500'
                : 'text-gray-800 hover:bg-white/[0.12] hover:text-cyan',
            ]"
          >
            {{ category.label }}
          </button>
        </Tab>
      </TabList>
    </TabGroup>
  </div>
</template>

<script setup>
import { ref } from 'vue'
import {
  TabGroup,
  TabList,
  Tab,
  TabPanels,
  TabPanel
} from '@headlessui/vue'

import { storeToRefs } from 'pinia'
import { usePlayerStore } from "@/stores/player";
import { getBgColorByShortcut } from "@/common/constants"

const store = usePlayerStore()

store.hydrate();

const categories = ref({
  'all': { getter: store.getPlayersOnBench, label: 'Bank (scroll rechts)' },
  // 'TW': { getter: store.getPlayersOnBench, label: 'Torwart' },
  // 'AB': { getter: store.getPlayersOnBench, label: 'Abwehr' },
  // 'MF': { getter: store.getPlayersOnBench, label: 'Mittelfeld' },
  // 'ST': { getter: store.getPlayersOnBench, label: 'Sturm' },
})
</script>
