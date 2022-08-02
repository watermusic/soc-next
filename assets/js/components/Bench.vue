<template>
  <div class="w-full">
    <TabGroup>
      <TabPanels class="border-t border-gray-300 bg-gray-100">

        <TabPanel
            v-for="(posts, idx) in Object.values(categories)"
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
                    v-for="post in posts"
                    :key="post.id"
                    class="relative w-20 h-28 relative flex-shrink-0 p-1 mx-2 bg-blue-300"
                >
                  <div class="">
                    <button role="tab"  class="m-1 rounded-1 absolute">
                      <span class="m-auto cursor-pointer">
                        <div class="relative flex flex-col justify-center items-center w-full h-full">
                          <span>Neuer</span>
                        </div>
                      </span>
                    </button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </TabPanel>
      </TabPanels>
      <TabList class="flex space-x-0 bg-gray-200 py-0 px-4">
        <Tab
            v-for="category in Object.keys(categories)"
            as="template"
            :key="category"
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
            {{ category }}
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

const categories = ref({
  Alle: [
    {
      id: 1,
      title: 'Does drinking coffee make you smarter?',
      date: '5h ago',
      commentCount: 5,
      shareCount: 2,
    },
    {
      id: 2,
      title: "So you've bought coffee... now what?",
      date: '2h ago',
      commentCount: 3,
      shareCount: 2,
    },
    {
      id: 3,
      title: "So you've bought coffee... now what?",
      date: '2h ago',
      commentCount: 3,
      shareCount: 2,
    },
    {
      id: 4,
      title: "So you've bought coffee... now what?",
      date: '2h ago',
      commentCount: 3,
      shareCount: 2,
    },
    {
      id: 5,
      title: "So you've bought coffee... now what?",
      date: '2h ago',
      commentCount: 3,
      shareCount: 2,
    },
    {
      id: 6,
      title: "So you've bought coffee... now what?",
      date: '2h ago',
      commentCount: 3,
      shareCount: 2,
    },
    {
      id: 7,
      title: "So you've bought coffee... now what?",
      date: '2h ago',
      commentCount: 3,
      shareCount: 2,
    },
    {
      id: 8,
      title: "So you've bought coffee... now what?",
      date: '2h ago',
      commentCount: 3,
      shareCount: 2,
    },
  ],
  Torwart: [
    {
      id: 1,
      title: 'Is tech making coffee better or worse?',
      date: 'Jan 7',
      commentCount: 29,
      shareCount: 16,
    },
    {
      id: 2,
      title: 'The most innovative things happening in coffee',
      date: 'Mar 19',
      commentCount: 24,
      shareCount: 12,
    },
  ],
  Abwehr: [
    {
      id: 1,
      title: 'Ask Me Anything: 10 answers to your questions about coffee',
      date: '2d ago',
      commentCount: 9,
      shareCount: 5,
    },
    {
      id: 2,
      title: "The worst advice we've ever heard about coffee",
      date: '4d ago',
      commentCount: 1,
      shareCount: 2,
    },
  ],
  Mittelfeld: [
    {
      id: 1,
      title: 'Ask Me Anything: 10 answers to your questions about coffee',
      date: '2d ago',
      commentCount: 9,
      shareCount: 5,
    },
    {
      id: 2,
      title: "The worst advice we've ever heard about coffee",
      date: '4d ago',
      commentCount: 1,
      shareCount: 2,
    },
  ],
  Sturm: [
    {
      id: 1,
      title: 'Ask Me Anything: 10 answers to your questions about coffee',
      date: '2d ago',
      commentCount: 9,
      shareCount: 5,
    },
    {
      id: 2,
      title: "The worst advice we've ever heard about coffee",
      date: '4d ago',
      commentCount: 1,
      shareCount: 2,
    },
  ],
})
</script>
