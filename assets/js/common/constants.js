export const POSITION_TOR_SHORTCUT = 'TW';
export const POSITION_ABWEHR_SHORTCUT = 'AB';
export const POSITION_MITTELFELD_SHORTCUT = 'MF';
export const POSITION_STURM_SHORTCUT = 'ST';

export const PLAYER_STATE_BENCH = 'bench';
export const PLAYER_STATE_PITCH = 'pitch';

export const getBgColorByShortcut = (shortcut) => {
    let color = '';
    switch (shortcut) {
        case POSITION_TOR_SHORTCUT:
            color = 'bg-rose-500';
            break;
        case POSITION_ABWEHR_SHORTCUT:
            color = 'bg-blue-500';
            break;
        case POSITION_MITTELFELD_SHORTCUT:
            color = 'bg-yellow-500';
            break;
        case POSITION_STURM_SHORTCUT:
            color = 'bg-emerald-500';
            break;
        default:
            color = 'bg-rose-500';
    }

    return color;
}

export const PITCH_POSITIONS = [
    {
        x: 50,
        y: 5,
        num: 1,
    },
    {
        x: 25,
        y: 25,
        num: 2,
    },
    {
        x: 50,
        y: 20,
        num: 3,
    },
    {
        x: 75,
        y: 25,
        num: 4,
    },
    {
        x: 39,
        y: 41,
        num: 5,
    },
    {
        x: 61,
        y: 41,
        num: 6,
    },
    {
        x: 20,
        y: 59,
        num: 7,
    },
    {
        x: 50,
        y: 65,
        num: 8,
    },
    {
        x: 80,
        y: 59,
        num: 9,
    },
    {
        x: 28.5,
        y: 78,
        num: 10,
    },
    {
        x: 70.5,
        y: 78,
        num: 11,
    }
];
