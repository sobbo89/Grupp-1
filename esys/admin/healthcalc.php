<?php
include "inc/init.inc";
include "datatables/astrand.inc";

/* lista på åstrand-tabeller och deras omfång:

Ålderskorrigering: 15 - 69 år

Syreupptagning män: 
watt (puls)
50w (110-140)
75w (110-170)
100w (110-170)
125w (110-170)
150w (110-170)
175w (117-170)
200w (120-170)
250w (140-170)

Syreupptagning kvinnor:
watt (puls)
50w (110-148)
75w (110-170)
100w (112-170)
125w (120-170)
150w (128-170)

*/

$id = 2041;
$individ[$id]['puls'] = 113;
$individ[$id]['watt'] = 50;
$individ[$id]['kon'] = 'M';
$individ[$id]['alder'] = 64;
$individ[$id]['vikt'] = 70;

$id = 1850;
$individ[$id]['puls'] = 145;
$individ[$id]['watt'] = 50;
$individ[$id]['kon'] = 'K';
$individ[$id]['alder'] = 56;
$individ[$id]['vikt'] = 70;

$id = 1851; // fusk, detta är tf 3 för 1850
$individ[$id]['puls'] = 123;
$individ[$id]['watt'] = 50;
$individ[$id]['kon'] = 'K';
$individ[$id]['alder'] = 56;
$individ[$id]['vikt'] = 70;

$id = 2186;
$individ[$id]['puls'] = 119;
$individ[$id]['watt'] = 100;
$individ[$id]['kon'] = 'M';
$individ[$id]['alder'] = 36;
$individ[$id]['vikt'] = 70;

$id = 2187; // fusk, detta är tf 2 för 2186
$individ[$id]['puls'] = 116;
$individ[$id]['watt'] = 100;
$individ[$id]['kon'] = 'M';
$individ[$id]['alder'] = 36;
$individ[$id]['vikt'] = 70;

echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><body>'; // head

echo '<table><tr><td>Kön</td><td>Ålder</td><td>Watt</td><td>Puls</td><td>Utan korr</td><td>Med ålderskorr</td></tr>';

foreach ($individ as $key => $val){
// weigh($arr,$par) * weigh($arr,$par)
$value = weigh($datatables[$individ[$key]['watt'].'w'][$individ[$key]['kon']],$individ[$key]['puls']);
$agecorr = weigh($datatables['agecor'],$individ[$key]['alder']);
$correctedval = $value * $agecorr;
echo '<tr><td>'.$individ[$key]['kon'].'</td><td>'.$individ[$key]['alder'].'</td><td>'.$individ[$key]['watt'].'</td><td>'.$individ[$key]['puls'].'</td><td>'.$value.'</td><td>'.$correctedval.'</td></tr>';
echo '<br/>';
}

echo '</table>';
echo '</body></html>'; // foot
?>