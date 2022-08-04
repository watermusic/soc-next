<template>
  <p v-if="lineupStore.loading">Loading lineups...</p>
  <p v-if="lineupStore.error">{{ error.message }}</p>
  <div v-if="! lineupStore.loading" class="flex items-center justify-between w-full px-3">
    <div class="flex-1 flex justify-start">
      <a
          :href="printUrl"
          target="_blank"
          class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-white hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z" />
        </svg>
      </a>
    </div>
    <Listbox class="w-32" v-model="selectedMatchDay">
      <div class="relative">
        <ListboxButton
            class="relative w-full cursor-default py-2 pl-3 pr-10 text-left focus:outline-none focus-visible:border-indigo-500 focus-visible:ring-2 focus-visible:ring-white focus-visible:ring-opacity-75 focus-visible:ring-offset-2 focus-visible:ring-offset-orange-300 sm:text-sm"
        >
          <span class="block truncate">{{ selectedMatchDay.name }}</span>
          <span
              class="pointer-events-none absolute inset-y-0 right-0 flex items-center pr-2"
          >
            <SelectorIcon class="h-5 w-5 text-gray-800" aria-hidden="true" />
          </span>
        </ListboxButton>

        <transition
            leave-active-class="transition duration-100 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
          <ListboxOptions
              class="absolute bg-gray-100 mt-1 max-h-60 w-full overflow-auto py-1 text-base shadow-lg ring-1 ring-black ring-opacity-5 focus:outline-none sm:text-sm"
          >
            <ListboxOption
                v-slot="{ active, selected }"
                v-for="matchDay in matchDays"
                :key="matchDay.name"
                :value="matchDay"
                :disabled="matchDay.unavailable"
                as="template"
            >
              <li
                  :class="[
                  active ? 'bg-amber-100 text-amber-900' : 'text-gray-900',
                  'relative cursor-default select-none py-2 pl-10 pr-4',
                ]"
              >
                <span
                    :class="[
                    selected ? 'font-medium' : 'font-normal',
                    'block truncate',
                  ]"
                >{{ matchDay.name }}</span
                >
                <span
                    v-if="selected"
                    class="absolute inset-y-0 left-0 flex items-center pl-3 text-amber-600"
                >
                  <CheckIcon class="h-5 w-5" aria-hidden="true" />
                </span>
              </li>
            </ListboxOption>
          </ListboxOptions>
        </transition>
      </div>
    </Listbox>
    <div class="flex-1 flex justify-end">
      <button
          @click="createLineup()"
          type="button"
          class="inline-flex items-center p-1 border border-transparent rounded-full shadow-sm text-white bg-white hover:bg-blue-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-300"
      >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
        </svg>
      </button>
    </div>
  </div>
</template>

<script setup>
  import { ref, watch, computed } from 'vue'
  import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
  } from '@headlessui/vue'
  import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'
  import { useLineupStore } from "@/stores/lineup";
  import { usePlayerStore } from "@/stores/player";
  import { useToast } from "vue-toastification";


  const toast = useToast();
  const lineupStore = useLineupStore()
  const playerStore = usePlayerStore()


  const matchDays = [
    { id: 1, name: '1. Spieltag', unavailable: false },
    { id: 2, name: '2. Spieltag', unavailable: false },
    { id: 3, name: '3. Spieltag', unavailable: false },
    { id: 4, name: '4. Spieltag', unavailable: false },
    { id: 5, name: '5. Spieltag', unavailable: false },
  ]

  const selectedMatchDay = ref(matchDays[0])

  const printUrl = computed(() => {
    return `/lineup/${selectedMatchDay.value.id}/print.pdf`;
  });

  const loadLineupByMatchday = (matchday) => {
    const lineUp = lineupStore.getLineUpByMatchday(matchday.id);

    playerStore.movePlayerToPitchFromLineup(lineUp);

    return lineUp;
  }

  const createLineup = () => {
    const lineup = {
      "matchday": selectedMatchDay.value.id,
      "data": playerStore.getPlayersOnPitchAsLineup()
    };

    if (lineup.data.length !== 11) {
      toast.warning('Du musst alle 11 Spieler aufstellen.');

      return;
    }

    lineupStore.createOrUpdateLineup(lineup);
  }

  setTimeout(() => {
    loadLineupByMatchday(selectedMatchDay.value);
  }, 2000)

  watch(selectedMatchDay, async(matchday) => {
    if(! loadLineupByMatchday(matchday)) {
      toast.warning('Für diesen Spieltag hast du noch keine Aufstellung abgegeben.');
    }
  })

  let isCalled = 0;

  // isSaved is triggered twice, so we have to count the calls
  lineupStore.$subscribe((mutation, state) => {

    if (state.isSaved === true) {
      ++isCalled;

      if (isCalled === 1) {
        toast.success('Die Aufstellung wurde erfolgreich gespeichert!.');
      }

      if (isCalled > 1) {
        isCalled = 0;
      }
    }
  })

</script>
