<?php

namespace cyberinferno\Cabal\Helpers;

/**
 * Class GameConstants
 *
 * Contains explanations for many constants used in Cabal Online server
 *
 * @package cyberinferno\Cabal\Helpers
 * @author Karthik P
 */
class GameConstants
{
    public static function listClasses()
    {
        return [
            1 => 'Warrior',
            2 => 'Blader',
            3 => 'Wizard',
            4 => 'Force Archer',
            5 => 'Force Shielder',
            6 => 'Force Blader'
        ];
    }

    public static function listNations()
    {
        return [
            0 => 'Neutral',
            1 => 'Capella',
            2 => 'Procyon',
            3 => 'GM'
        ];
    }

    public static function listRanks()
    {
        return [
            257 => 'Novice',
            514 => 'Apprentice',
            771 => 'Regular',
            1028 => 'Expert',
            1285 => 'A.Expert',
            1542 => 'Master',
            1799 => 'A.Master',
            2056 => 'G.Master',
            2313 => 'Completer',
            2570 => 'Transcender'
        ];
    }

    public static function listAuras()
    {
        return [
            0 => 'None',
            2 => 'Land Aura',
            4 => 'Aqua Aura',
            6 => 'Wind Aura',
            8 => 'Flame Aura',
            10 => 'Freezing Aura',
            12 => 'Lightning Aura'
        ];
    }
}