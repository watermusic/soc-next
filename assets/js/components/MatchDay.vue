<template>
  <div class="w-32">
    <Listbox v-model="selectedMatchDay">
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
  </div>
</template>

<script setup>
  import { ref } from 'vue'
  import {
    Listbox,
    ListboxButton,
    ListboxOptions,
    ListboxOption,
  } from '@headlessui/vue'
  import { CheckIcon, SelectorIcon } from '@heroicons/vue/solid'

  const matchDays = [
    { id: 1, name: '1. Spieltag', unavailable: false },
    { id: 2, name: '2. Spieltag', unavailable: false },
    { id: 3, name: '3. Spieltag', unavailable: false },
    { id: 4, name: '4. Spieltag', unavailable: false },
    { id: 5, name: '5. Spieltag', unavailable: false },
  ]
  const selectedMatchDay = ref(matchDays[0])

</script>
