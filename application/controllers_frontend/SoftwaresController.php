<?php
class SoftwaresController extends Controller {
    public function run() {
        $this->response->setAttribute("menu_top", array (
  0 => 
  array (
    'title' => 'CASINOS',
    'url' => '/casinos',
    'is_active' => false,
  ),
  1 => 
  array (
    'title' => 'SOFTWARES',
    'url' => '/softwares',
    'is_active' => true,
  ),
  2 => 
  array (
    'title' => 'BONUSES',
    'url' => '/bonus-list',
    'is_active' => false,
  ),
  3 => 
  array (
    'title' => 'COUNTRIES',
    'url' => '/countries',
    'is_active' => false,
  ),
  4 => 
  array (
    'title' => 'COMPATIBILITY',
    'url' => '/compatability',
    'is_active' => false,
  ),
  5 => 
  array (
    'title' => 'BANKING',
    'url' => '/banking',
    'is_active' => false,
  ),
  6 => 
  array (
    'title' => 'FEATURES',
    'url' => '/features',
    'is_active' => false,
  ),
  7 => 
  array (
    'title' => 'GAMES',
    'url' => '/games',
    'is_active' => false,
  ),
));
$this->response->setAttribute("results", array (
  'NetEnt' => '617',
  'MicroGaming' => '542',
  'BetSoft' => '284',
  'Evolution Gaming' => '250',
  'NextGen Gaming' => '237',
  'NYX Interactive' => '228',
  'Play n GO' => '171',
  'Quickspin' => '168',
  'Thunderkick' => '163',
  'ELK Studios' => '163',
  'IGT' => '148',
  'Blueprint Gaming' => '125',
  'iSoftBet' => '120',
  'Amaya Gaming' => '107',
  'Eyecon' => '106',
  'Playtech' => '105',
  'Pragmatic Play' => '105',
  '1X2 Gaming' => '102',
  'Aristocrat' => '102',
  'Lightning Box Games' => '96',
  'Scientific Games' => '94',
  'Rival' => '90',
  'RTG' => '87',
  'Yggdrasil Gaming' => '86',
  'Big Time Gaming' => '82',
  'Playson' => '82',
  'Pariplay' => '81',
  'Ezugi' => '79',
  'Cozy Games' => '73',
  'Genesis Gaming' => '73',
  'Realistic Games' => '65',
  'GameArt' => '64',
  'Endorphina' => '62',
  'Rabcat' => '61',
  'Cryptologic' => '58',
  'Leander Games' => '58',
  'Amatic Industries' => '53',
  'Nektan' => '50',
  '2By2 Gaming' => '48',
  'Bally' => '48',
  'Quickfire' => '45',
  'Booming Games' => '43',
  'MrSlotty Games' => '42',
  'Novomatic' => '41',
  'Gamevy' => '38',
  'GGP' => '37',
  'Williams Interactive' => '37',
  'Iron Dog Studio' => '36',
  'EGT' => '36',
  'Games OS' => '35',
  'Habanero' => '35',
  'SoftSwiss' => '34',
  '888 Software' => '34',
  'Merkur Gaming' => '32',
  'iGaming2Go' => '32',
  'Spinomenal' => '31',
  'Dragonfish' => '29',
  'Genii' => '29',
  'Felt Gaming' => '26',
  'GTS' => '26',
  'Skillzz Gaming' => '26',
  'Barcrest Games' => '25',
  'Saucify' => '25',
  'Igrosoft' => '25',
  'Vivo Gaming' => '25',
  'OMI Gaming' => '24',
  'BetConstruct' => '24',
  'OpenBet' => '24',
  'NeoGames' => '23',
  'Chance Interactive' => '23',
  'XPG' => '22',
  'Parlay' => '22',
  'WMS Gaming' => '21',
  'Multicommerce Game Studio' => '21',
  'Push Gaming' => '19',
  'GameScale' => '19',
  'World Match' => '18',
  'Betgames TV' => '17',
  'Betdigital' => '15',
  'Spigo' => '15',
  'Join Games' => '15',
  'GreenTube' => '14',
  'Skill On Net' => '13',
  'White Hat Gaming' => '13',
  'Oryx Gaming' => '13',
  'High 5 Games' => '13',
  'Ash Gaming' => '13',
  'Casino Technology' => '12',
  'Multislot' => '12',
  'Ainsworth' => '12',
  'Core Gaming' => '12',
  'Tom Horn' => '12',
  'Belatra Games' => '12',
  'Jadestone' => '11',
  'Wagermill' => '11',
  'Games Warehouse' => '11',
  'Mega Jack' => '11',
  'Visionary iGaming' => '11',
  'Zeus Services' => '11',
  'Edict eGaming' => '11',
  'Endemol Games' => '10',
  'Octopus Gaming' => '10',
  'Electracade' => '10',
  'Fremantle' => '9',
  'ProgressPlay' => '9',
  'WagerWorks' => '9',
  'Patagonia Entertainment' => '8',
  'Relax Gaming' => '8',
  'Virtue Fusion' => '8',
  'Intervision Gaming' => '8',
  'Booongo' => '8',
  'BetGames' => '8',
  'Portomaso Gaming' => '7',
  'Aberrant' => '7',
  'RCT Gaming' => '7',
  'TAIN' => '6',
  'Gamesys' => '6',
  'Wazdan' => '6',
  'Instant Win Gaming' => '6',
  'VistaGaming' => '5',
  'Gaminator' => '5',
  'Unicum' => '5',
  'PopCap' => '5',
  'AlteaGaming' => '5',
  'WGS' => '5',
  'Kiron Interactive' => '4',
  'Air Dice' => '4',
  'Evoplay' => '4',
  'Top Game' => '4',
  'Win Interactive' => '4',
  'NetoPlay' => '4',
  'GloboTech' => '3',
  'Ingenuity Gaming' => '3',
  'GGL live' => '3',
  'NuWorks' => '3',
  'Mazooma Interactive' => '3',
  'Habanero Systemss' => '3',
  'Intouch Games' => '3',
  'Fugaso' => '3',
  'Inteplay' => '3',
  'UC8 Slots' => '3',
  'GDI' => '3',
  'PlayPearls' => '3',
  'Arrows Edge' => '3',
  'GAMING1' => '3',
  'Inspired' => '3',
  'MGA' => '2',
  'Side City Studios' => '2',
  'LIONLINE' => '2',
  'Bluberi Gaming' => '2',
  'Playsoft' => '2',
  'Hybrino' => '2',
  'CasinoSkillGaming' => '2',
  'Takisto' => '2',
  'Wirex' => '2',
  'Geco Gaming' => '2',
  'Saber Interactive' => '2',
  'Cassava Enterprise' => '2',
  'Slotland Entertainment' => '2',
  'Tom Horn Gaming' => '2',
  'Amuzi Gaming' => '2',
  'SBTech' => '2',
  'Odobo Gaming' => '2',
  'Opus Gaming' => '2',
  'Gamomat' => '2',
  'JPM Interactive' => '2',
  'Zukido' => '1',
  'R Franco' => '1',
  'Megadice' => '1',
  'Spin3' => '1',
  'Global Gaming Labs' => '1',
  'Dr Vegas Games' => '1',
  'Alps Games' => '1',
  'Digital Gaming Solutions' => '1',
  'Xatronic Software' => '1',
  'eGaming' => '1',
  'GAN' => '1',
  'Ongame' => '1',
  'xGames' => '1',
  'Soft Magic Dice' => '1',
  'BetOnSoft' => '1',
  'Astra Games' => '1',
  'Infinity Gaming Solutions' => '1',
  'Capecod Gaming' => '1',
  'Holland Power Gaming' => '1',
  'Ace Gaming' => '1',
  'Cayetano Gaming' => '1',
  'Viaden' => '1',
  'Omega Gaming' => '1',
  'MediaLive' => '1',
  'Incredible Technologies' => '1',
  'Allwilds' => '1',
));

    }
}
        