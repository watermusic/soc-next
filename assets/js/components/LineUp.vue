<template>
  <div class="lineup flex flex-col justify-between h-full max-w-lg m-auto">

    <div class="sub-header z-50 h-12 flex items-center justify-center w-full">
      <MatchDay />
    </div>

    <div class="pitch flex flex-grow bg-gray-50">
      <Pitch/>
    </div>

    <div class="bench flex h-44">
      <Bench/>
    </div>

  </div>
</template>

<script setup>
  import MatchDay from "@/components/MatchDay";
  import Bench from "@/components/Bench";
  import Pitch from "@/components/Pitch";

  import { useLineupStore } from "@/stores/lineup";
  import { usePlayerStore } from "@/stores/player";

  const lineupStore = useLineupStore()
  const playerStore = usePlayerStore()

  playerStore.hydrate();
  lineupStore.hydrate();

</script>

