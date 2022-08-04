import { defineStore } from 'pinia';
import { computed, ref } from 'vue';
import { PLAYER_STATE_BENCH, PLAYER_STATE_PITCH } from "@/common/constants";

/**
 * @typedef {Object} position
 * @property {Number} id
 * @property {String} name
 * @property {String} shortcut
 */

/**
 * @typedef {Object} team
 * @property {Number} id
 * @property {String} name
 * @property {String} img
 */

/**
 * @typedef {Object} player
 * @property {Number} id
 * @property {String} name
 * @property {String} img
 * @property {String} state
 * @property {Number} state_num
 * @property {position} position
 * @property {team} team
 */

/**
 * @typedef {Object} lineUp
 * @property {Number} matchday
 * @property {Object} data
 * @property {Date} created_at
 * @property {Date} updated_at
 */

export const usePlayerStore = defineStore('player', () => {

    const players = ref([]);

    const loading = ref(false);

    const errors = ref(null);

    const markedPosition = ref(null);

    async function hydrate() {
        players.value = [];
        loading.value = true;
        try {
            players.value = await fetch('/api/players')
                .then((response) => response.json());
        } catch (err) {
            errors.value = err;
        } finally {
            loading.value = false;
        }
    }

    /**
     * @param {int} num
     */
    function markPosition(num) {
        markedPosition.value = num;
    }

    /**
     *
     * @param {int} num
     * @return {player|null}
     */
    function getPlayerOnPitchByPosition(num) {
        return (
            players.value.find(
                (player) =>
                    num === player.state_num &&
                    player.state === PLAYER_STATE_PITCH
            ) || null
        );
    }

    /**
     * @param {player} selectedPlayer
     */
    function movePlayerToPitch(selectedPlayer) {

        if (markedPosition.value === null) {
            alert('Bitte erst die Position für den Spieler markieren.');

            return;
        }

        let pitchPlayer = this.getPlayerOnPitchByPosition(markedPosition.value);

        if (null !== pitchPlayer) {
            pitchPlayer.state = PLAYER_STATE_BENCH;
            pitchPlayer.state_num = null;
        }

        let player = players.value.find((player) => selectedPlayer.id === player.id);

        player.state = PLAYER_STATE_PITCH;
        player.state_num = markedPosition.value;

        markedPosition.value = null;
    }

    function getPlayersOnPitchAsLineup () {
        const pitchPlayers = players.value.filter((player) => player.state === PLAYER_STATE_PITCH);

        let result = [];
        pitchPlayers.forEach(function(player) {
            result.push({"num": player.state_num, "id_player": player.id});
        })

        return result;
    }

    /**
     * @param {lineUp} lineup
     */
    function movePlayerToPitchFromLineup(lineup) {
        players.value.forEach((player) => {
            player.state = PLAYER_STATE_BENCH;
            player.state_num = null;

            if (lineup) {
                lineup.data.forEach((position) => {
                    if (player.id === position.id_player) {
                        player.state = PLAYER_STATE_PITCH;
                        player.state_num = position.num;
                    }
                });
            }
        });
    }

    /**
     * @return {boolean}
     */
    const isMarkedPosition = computed(() => {
        return (num) => markedPosition.value === num;
    });

    /**
     * @return {boolean}
     */
    const hasMarkedPosition = computed(() => {
        return markedPosition.value !== null;
    });

    /**
     * @return {int}
     */
    const getMarkedPosition = computed(() => {
        return markedPosition.value;
    });

    /**
     * @return {player[]}
     */
    const getPlayersOnPitch = computed(() => {
        return players.value.filter((player) => player.state === PLAYER_STATE_PITCH);
    });

    /**
     * @return {player[]}
     */
    const getPlayersOnBench = computed(() => {
        return players.value.filter((player) => player.state === PLAYER_STATE_BENCH);
    });

    /**
     * @return {player[]}
     */
    const getPlayersOnBenchByPosition = computed(() => {
        return (position) => players.value.filter((player) => player.state === "bench" && player.position.shortcut === position);
    });


    // [
    //     { "position" : 1, "id_player" : 234},
    //     { "position" : 1, "id_player" : 234},
    //     { "position" : 1, "id_player" : 234},
    //     { "position" : 1, "id_player" : 234},
    //     { "position" : 1, "id_player" : 234},
    //     ...
    // ]

    return {
        loading,
        errors,
        players,
        markedPosition,
        hydrate,
        markPosition,
        movePlayerToPitch,
        movePlayerToPitchFromLineup,
        getPlayerOnPitchByPosition,
        isMarkedPosition,
        hasMarkedPosition,
        getMarkedPosition,
        getPlayersOnPitch,
        getPlayersOnBench,
        getPlayersOnBenchByPosition,
        getPlayersOnPitchAsLineup,
    }
});
