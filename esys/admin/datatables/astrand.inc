<?php
// Åstrand data tables

// ÅLDERSKORRIGERING

// agecor: ålderskorrigering (complete table)
$datatables['agecor'][15] = 1.1;
$datatables['agecor'][25] = 1;
$datatables['agecor'][35] = 0.87;
$datatables['agecor'][40] = 0.83;
$datatables['agecor'][45] = 0.78;
$datatables['agecor'][50] = 0.75;
$datatables['agecor'][55] = 0.71;
$datatables['agecor'][60] = 0.68;
$datatables['agecor'][65] = 0.65;
$datatables['agecor'][69] = 0.63;

// SYREUPPTAGNING - Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min)
/* lista på existerande astrand syreupptagningstabeller och deras omfång:
Män: 
watt (puls)
50w (110-140)
75w (110-170)
100w (110-170)
125w (110-170)
150w (110-170)
175w (117-170)
200w (120-170)
250w (140-170)

Kvinnor:
watt (puls)
50w (110-148)
75w (110-170)
100w (112-170)
125w (120-170)
150w (128-170)
*/

// SYREUPPTAGNING - MÄN

// 50watt (300 kpm/min) Män (subset table) 
$datatables['50w']['M'][110] = 2.6;
$datatables['50w']['M'][120] = 2.2;
$datatables['50w']['M'][130] = 1.9;
$datatables['50w']['M'][140] = 1.6;

// 75watt Män (subset table) 
$datatables['75w']['M'][110] = 3.5;
$datatables['75w']['M'][120] = 2.9;
$datatables['75w']['M'][130] = 2.4;
$datatables['75w']['M'][140] = 2.1;
$datatables['75w']['M'][150] = 1.9;
$datatables['75w']['M'][160] = 1.7;
$datatables['75w']['M'][170] = 1.4;

// 100w (600 kpm/min) Män (subset table) 
$datatables['100w']['M'][110] = 4.4;
$datatables['100w']['M'][118] = 3.6;
$datatables['100w']['M'][130] = 3;
$datatables['100w']['M'][140] = 2.6;
$datatables['100w']['M'][150] = 2.3;
$datatables['100w']['M'][160] = 2.1;
$datatables['100w']['M'][170] = 1.8;

// 125w (750 kpm/min) Män (subset table) 
$datatables['125w']['M'][110] = 5.2;
$datatables['125w']['M'][118] = 4.3;
$datatables['125w']['M'][124] = 3.9;
$datatables['125w']['M'][130] = 3.6;
$datatables['125w']['M'][140] = 3.1;
$datatables['125w']['M'][150] = 2.7;
$datatables['125w']['M'][160] = 2.5;
$datatables['125w']['M'][170] = 2.2;

// 150w Män (subset table) 
$datatables['150w']['M'][110] = 5.9;
$datatables['150w']['M'][120] = 4.8;
$datatables['150w']['M'][130] = 4.1;
$datatables['150w']['M'][140] = 3.6;
$datatables['150w']['M'][150] = 3.2;
$datatables['150w']['M'][160] = 2.8;
$datatables['150w']['M'][170] = 2.6;

// 175w Män (subset table) 
$datatables['175w']['M'][117] = 6.0;
$datatables['175w']['M'][130] = 4.8;
$datatables['175w']['M'][140] = 4.2;
$datatables['175w']['M'][150] = 3.7;
$datatables['175w']['M'][160] = 3.3;
$datatables['175w']['M'][170] = 3.0;

// 200w (1200 kpm/min) Män (subset table) 
$datatables['200w']['M'][120] = 6.4;
$datatables['200w']['M'][126] = 5.8;
$datatables['200w']['M'][130] = 5.5;
$datatables['200w']['M'][140] = 4.8;
$datatables['200w']['M'][144] = 4.5;
$datatables['200w']['M'][150] = 4.3;
$datatables['200w']['M'][154] = 4;
$datatables['200w']['M'][160] = 3.8;
$datatables['200w']['M'][170] = 3.4;

// 250w Män (subset table) 
$datatables['250w']['M'][140] = 6.0;
$datatables['250w']['M'][150] = 5.3;
$datatables['250w']['M'][160] = 4.8;
$datatables['250w']['M'][170] = 4.3;

// SYREUPPTAGNING - KVINNOR

// 50watt (300 kpm/min) Kvinnor (subset table)
$datatables['50w']['K'][110] = 3.1;
$datatables['50w']['K'][120] = 2.5;
$datatables['50w']['K'][130] = 2.1;
$datatables['50w']['K'][140] = 1.8;
$datatables['50w']['K'][148] = 1.6;

// 75watt Kvinnor (subset table)
$datatables['75w']['K'][110] = 4.1;
$datatables['75w']['K'][120] = 3.4;
$datatables['75w']['K'][130] = 2.7;
$datatables['75w']['K'][140] = 2.4;
$datatables['75w']['K'][150] = 2.0;
$datatables['75w']['K'][160] = 1.8;
$datatables['75w']['K'][170] = 1.6;

// 100w (600 kpm/min) Kvinnor (subset table) 
$datatables['100w']['K'][112] = 4.8;
$datatables['100w']['K'][120] = 4.1;
$datatables['100w']['K'][126] = 3.3;
$datatables['100w']['K'][130] = 3.4;
$datatables['100w']['K'][140] = 2.8;
$datatables['100w']['K'][150] = 2.5;
$datatables['100w']['K'][160] = 2.2;
$datatables['100w']['K'][170] = 2;

// 125w (750 kpm/min) Kvinnor (subset table) 
$datatables['125w']['K'][120] = 4.8;
$datatables['125w']['K'][130] = 4;
$datatables['125w']['K'][140] = 3.4;
$datatables['125w']['K'][150] = 3;
$datatables['125w']['K'][160] = 2.6;
$datatables['125w']['K'][170] = 2.4;

// 150w Kvinnor (subset table)
$datatables['150w']['K'][128] = 4.8;
$datatables['150w']['K'][140] = 4.0;
$datatables['150w']['K'][150] = 3.5;
$datatables['150w']['K'][160] = 3.0;
$datatables['150w']['K'][170] = 2.7;

?>