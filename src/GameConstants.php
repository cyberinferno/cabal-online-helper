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

    public static function listItemDurations()
    {
        return [
            0 => 'No Duration',
            1 => '1 Hour',
            2 => '2 Hours',
            3 => '3 Hours',
            4 => '4 Hours',
            5 => '5 Hours',
            6 => '6 Hours',
            7 => '10 Hours',
            8 => '12 Hours',
            9 => '1 Day',
            10 => '3 Days',
            11 => '5 Days',
            12 => '7 Days',
            13 => '10 Days',
            14 => '14 Days',
            15 => '15 Days',
            16 => '20 Days',
            17 => '30 Days',
            18 => '45 Days',
            19 => '60 Days',
            20 => '90 Days',
            21 => '100 Days',
            22 => '120 Days',
            23 => '180 Days',
            24 => '270 Days',
            25 => '365 Days',
            31 => 'Permanent'
        ];
    }

    public static function listBindings()
    {
        return [
            0 => 'None',
            4096 => 'Account Binding',
            524288 => 'Character Binding',
            1572864 => 'Character Binding on Usage'
        ];
    }

    public static function listDungeons()
    {
        return [
            218 => 'Frozen Tower of Undead(B1F)',
            245 => 'Ruina Station',
            253 => 'Frozen Tower of Undead(B2F) Part1',
            4276 => 'Chaos Arena Eternity',
            4263 => 'Tower of Undead B3F',
            294 => 'Forgotten Temple B1F',
            293 => 'Volcanic Citadel',
            4096 => 'Forgotten Temple B2F',
            4097 => 'Forbidden Island',
            4098 => 'Altar of Siena B1F',
            4099 => 'Altar of Siena B2F',
            4100 => 'Panic Cave (Easy)',
            4101 => 'Panic Cave (Normal)',
            4102 => 'Panic Cave (Hard)',
            4103 => 'Steamer Crazy (Easy)',
            4104 => 'Steamer Crazy (Normal)',
            4105 => 'Steamer Crazy (Hard)',
            4106 => 'Illusion Castle Underworld',
            4107 => 'Catacomb Frost (Easy)',
            4108 => 'Catacomb Frost (Normal)',
            4109 => 'Catacomb Frost (Hard)',
            4110 => 'Illusion Castle Radiant Hall',
            4283 => 'Abandoned City',
            4265 => 'Forbidden Island (Awakened)',
            4336 => 'Tower of the Dead B3F (Part2)',
            4337 => 'Legend Arena',
            4111 => 'Chaos Arena Lv.1',
            4112 => 'Chaos Arena Lv.2',
            4113 => 'Chaos Arena Lv.3',
            4114 => 'Chaos Arena Lv.4',
            4115 => 'Chaos Arena Lv.5',
            4116 => 'Chaos Arena Lv.6',
            4117 => 'Panic Cave (Premium)',
            4118 => 'Steamer Crazy (Premium)',
            4119 => 'Catacomb Frost (Premium)',
            4338 => 'Glacies Inferna',
            4121 => 'Lava Hellfire (Easy)',
            4122 => 'Lava Hellfire (Medium)',
            4123 => 'Lava Hellfire (Hard)',
            4124 => 'Lava Hellfire (Premium)',
            4220 => 'Maquinas Outpost',
            4248 => 'Hazardous Valley (Easy)',
            4249 => 'Hazardous Valley (Normal)',
            4250 => 'Hazardous Valley (Hard)',
            4251 => 'Chaos Arena Infinity',
            4253 => 'Frozen Colosseum',
            4254 => 'Frozen Colosseum',
            4255 => 'Frozen Colosseum',
            4264 => 'Forgotten Temple B2F (Awakened)',
            4277 => 'Lava Hellfire (Awakened)',
            4278 => 'Panic Cave (Awakened)',
            4279 => 'Steamer Crazy (Awakened)',
            4280 => 'Catacomb Frost (Awakened)',
            4282 => 'Hazardous Valley (Awakened)',
            4339 => 'Illusion Castle Underworld(Apocrypha)',
            4340 => 'Illusion Castle Radiant Hall(Apocrypha)',
            4341 => 'Edge of Phantom',
            4342 => 'Forgotten Temple B3F',
            4343 => 'Acheron Arena',
            4344 => 'Devil\'s Tower',
            4345 => 'Devil\'s Tower (Part2)',
            4346 => 'Pandemonium',
            4347 => 'Mirage Island',
            4348 => 'Flame Nest',
            4349 => 'Holy Windmill'
        ];
    }
}