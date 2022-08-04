import { defineStore } from 'pinia';
import { computed, ref } from 'vue';

/**
 * @typedef {Object} lineUp
 * @property {Number} matchday
 * @property {Object} data
 * @property {Date} created_at
 * @property {Date} updated_at
 */

export const useLineupStore = defineStore('lineup', () => {

    const initialized = ref(false);

    const loading = ref(false);

    const saving = ref(false);

    const errors = ref(null);

    /**
     * @type {lineUp[]}
     */
    const lineups = ref([]);

    async function hydrate() {
        lineups.value = [];
        loading.value = true;
        try {
            const response = await fetch('/api/lineups');
            lineups.value = await response.json();
            initialized.value = true;
        } catch (err) {
            errors.value = err;
        } finally {
            loading.value = false;
        }
    }

    /**
     * @param {lineUp} lineUp
     */
    async function createOrUpdateLineup(lineUp) {
        saving.value = true;
        try {
            const persistedLineup = await fetch('/api/lineups', {
                method: 'POST',
                cache: 'no-cache',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(lineUp)
            })
                .then((response) => response.json());
        } catch (err) {
            errors.value = err;
        } finally {
            this.hydrate();
            saving.value = false;
        }
    }

    /**
     * @return {lineUp}
     */
    const getLineUpByMatchday = computed(() => {
        return (matchday) => lineups.value.find((lineup) => lineup.matchday === matchday);
    });

    return {
        initialized,
        loading,
        saving,
        errors,
        lineups,
        hydrate,
        getLineUpByMatchday,
        createOrUpdateLineup,
    }
});
