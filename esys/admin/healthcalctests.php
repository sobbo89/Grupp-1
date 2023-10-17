<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);


// tableA: ålderskorrigering
$tableA[15] = 1.1;
$tableA[25] = 1;
$tableA[35] = 0.87;
$tableA[40] = 0.83;
$tableA[45] = 0.78;
$tableA[50] = 0.75;
$tableA[55] = 0.71;
$tableA[60] = 0.68;
$tableA[65] = 0.65;
$tableA[69] = 0.63;


function weigh($arr,$par){
ksort($arr);
foreach($arr as $key => $val){
	if($key == $par) return $val;
	if($key > $par){
		$botval = $preval + (($preval/$par)-($preval/$prekey));
		$topval = $val + (($val/$par)-($val/$key));
		for ($i = $prekey; $i <= $key; $i++) {
			if($par == $i){
				$steps_done_percent = ($i - $prekey) / ($key - $prekey);
				$steps_left_percent = ($key - $prekey - ($i - $prekey)) / ($key - $prekey);	
				$parval = ($steps_left_percent * $botval) + ($steps_done_percent * $topval);
				}
			}
		return round($parval,2);
		}
	$preval = $val;
	$prekey = $key;
	}
}

echo '<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head><body>'; // head

$output = '<h4>Ålderskorrigering:</h4><table><tr><td>Ålder</td><td>Interp</td><td>Tabellvärden</td><td>Differens</td></tr>';
for ($i = 15; $i <= 69; $i++) {
$interpolval = weigh($tableA,$i);
$tableval = $tableA[$i];
//$diff = round($interpolval-$tableval,2);
//if($diff >= 0.1) $diff = '<font color="red">'.$diff.'</font>';
//elseif($diff <= 0.05) $diff = '<font color="lightgreen">'.$diff.'</font>';
$output.= '<tr><td>'.$i.'</td><td>'.$interpolval.'</td><td>'.$tableval.'</td><td>'.$diff.'</td></tr>';
}
echo $output.'</table>';


// tableB: 300 kpm/min (50watt) Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Män 
$tableB[110] = 2.6;
$tableB[120] = 2.2;
$tableB[130] = 1.9;
$tableB[140] = 1.6;

// tableC: Korr, 300 kpm/min (50watt) Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Män 

$tableC[110] = 2.6;
$tableC[111] = 2.5;
$tableC[112] = 2.5;
$tableC[113] = 2.4;
$tableC[114] = 2.4;
$tableC[115] = 2.4;
$tableC[116] = 2.3;
$tableC[117] = 2.3;
$tableC[118] = 2.3;
$tableC[119] = 2.2;
$tableC[120] = 2.2;
$tableC[121] = 2.2;
$tableC[122] = 2.2;
$tableC[123] = 2.1;
$tableC[124] = 2.1;
$tableC[125] = 2;
$tableC[126] = 2;
$tableC[127] = 2;
$tableC[128] = 2;
$tableC[129] = 1.9;
$tableC[130] = 1.9;
$tableC[131] = 1.9;
$tableC[132] = 1.8;
$tableC[133] = 1.8;
$tableC[134] = 1.8;
$tableC[135] = 1.7;
$tableC[136] = 1.7;
$tableC[137] = 1.7;
$tableC[138] = 1.6;
$tableC[139] = 1.6;
$tableC[140] = 1.6;

$output = '<h4>300 kpm/min (50w), män:</h4><table><tr><td>Puls</td><td>Interp</td><td>Tabellvärden</td><td>Differens</td></tr>';
for ($i = 110; $i <= 140; $i++) {
$interpolval = weigh($tableB,$i);
$tableval = $tableC[$i];
$diff = round($interpolval-$tableval,2);
if($diff >= 0.1) $diff = '<font color="red">'.$diff.'</font>';
elseif($diff <= 0.05) $diff = '<font color="lightgreen">'.$diff.'</font>';
$output.= '<tr><td>'.$i.'</td><td>'.$interpolval.'</td><td>'.$tableval.'</td><td>'.$diff.'</td></tr>';
}
echo $output.'</table>';

// tableD: 600 kpm/min (100w) Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Män 
$tableD[110] = 4.4;
$tableD[118] = 3.6;
$tableD[130] = 3;
$tableD[140] = 2.6;
$tableD[150] = 2.3;
$tableD[160] = 2.1;
$tableD[170] = 1.8;

// tableE: Korr, 600 kpm/min (100w) Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Män
$tableE[110] = 4.4;
$tableE[111] = 4.3;
$tableE[112] = 4.2;
$tableE[113] = 4.1;
$tableE[114] = 4.0;
$tableE[115] = 3.9;
$tableE[116] = 3.9;
$tableE[117] = 3.8;
$tableE[118] = 3.7;
$tableE[119] = 3.6;
$tableE[120] = 3.5;
$tableE[121] = 3.4;
$tableE[122] = 3.4;
$tableE[123] = 3.4;
$tableE[124] = 3.3;
$tableE[125] = 3.2;
$tableE[126] = 3.2;
$tableE[127] = 3.1;
$tableE[128] = 3.1;
$tableE[129] = 3;
$tableE[130] = 3;
$tableE[131] = 2.9;
$tableE[132] = 2.9;
$tableE[133] = 2.8;
$tableE[134] = 2.8;
$tableE[135] = 2.8;
$tableE[136] = 2.7;
$tableE[137] = 2.7;
$tableE[138] = 2.7;
$tableE[139] = 2.6;
$tableE[140] = 2.6;
$tableE[141] = 2.6;
$tableE[142] = 2.5;
$tableE[143] = 2.5;
$tableE[144] = 2.5;
$tableE[145] = 2.4;
$tableE[146] = 2.4;
$tableE[147] = 2.4;
$tableE[148] = 2.4;
$tableE[149] = 2.3;
$tableE[150] = 2.3;
$tableE[151] = 2.3;
$tableE[152] = 2.3;
$tableE[153] = 2.2;
$tableE[154] = 2.2;
$tableE[155] = 2.2;
$tableE[156] = 2.2;
$tableE[157] = 2.1;
$tableE[158] = 2.1;
$tableE[159] = 2.1;
$tableE[160] = 2.1;
$tableE[161] = 2;
$tableE[162] = 2;
$tableE[163] = 2;
$tableE[164] = 2;
$tableE[165] = 2;
$tableE[166] = 1.9;
$tableE[167] = 1.9;
$tableE[168] = 1.9;
$tableE[169] = 1.9;
$tableE[170] = 1.8;


$output = '<h4>600 kpm/min (100w), män:</h4><table><tr><td>Puls</td><td>Interp</td><td>Tabellvärden</td><td>Differens</td></tr>';
for ($i = 110; $i <= 170; $i++) {
$interpolval = weigh($tableD,$i);
$tableval = $tableE[$i];
$diff = round($interpolval-$tableval,2);
if($diff >= 0.1) $diff = '<font color="red">'.$diff.'</font>';
elseif($diff <= 0.05) $diff = '<font color="lightgreen">'.$diff.'</font>';
$output.= '<tr><td>'.$i.'</td><td>'.$interpolval.'</td><td>'.$tableval.'</td><td>'.$diff.'</td></tr>';
}
echo $output.'</table>';


// tableN: Korr, 750 kpm/min (125w) Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Män
$tableN[110] = 5.2;
$tableN[118] = 4.3;
$tableN[124] = 3.9;
$tableN[130] = 3.6;
$tableN[140] = 3.1;
$tableN[150] = 2.7;
$tableN[160] = 2.5;
$tableN[170] = 2.2;

// tableO: Korr, 750 kpm/min (125w) Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Män
$tableO[110] = 5.2;
$tableO[111] = 5.1;
$tableO[112] = 5.0;
$tableO[113] = 4.9;
$tableO[114] = 4.8;
$tableO[115] = 4.7;
$tableO[116] = 4.6;
$tableO[117] = 4.5;
$tableO[118] = 4.3;
$tableO[119] = 4.2;
$tableO[120] = 4.2;
$tableO[121] = 4.1;
$tableO[122] = 4;
$tableO[123] = 4;
$tableO[124] = 3.9;
$tableO[125] = 3.8;
$tableO[126] = 3.8;
$tableO[127] = 3.7;
$tableO[128] = 3.7;
$tableO[129] = 3.6;
$tableO[130] = 3.6;
$tableO[131] = 3.5;
$tableO[132] = 3.5;
$tableO[133] = 3.4;
$tableO[134] = 3.4;
$tableO[135] = 3.3;
$tableO[136] = 3.3;
$tableO[137] = 3.2;
$tableO[138] = 3.2;
$tableO[139] = 3.1;
$tableO[140] = 3.1;
$tableO[141] = 3;
$tableO[142] = 3;
$tableO[143] = 3;
$tableO[144] = 2.9;
$tableO[145] = 2.9;
$tableO[146] = 2.8;
$tableO[147] = 2.8;
$tableO[148] = 2.8;
$tableO[149] = 2.8;
$tableO[150] = 2.7;
$tableO[151] = 2.7;
$tableO[152] = 2.7;
$tableO[153] = 2.6;
$tableO[154] = 2.6;
$tableO[155] = 2.6;
$tableO[156] = 2.6;
$tableO[157] = 2.5;
$tableO[158] = 2.5;
$tableO[159] = 2.5;
$tableO[160] = 2.5;
$tableO[161] = 2.4;
$tableO[162] = 2.4;
$tableO[163] = 2.4;
$tableO[164] = 2.4;
$tableO[165] = 2.3;
$tableO[166] = 2.3;
$tableO[167] = 2.3;
$tableO[168] = 2.3;
$tableO[169] = 2.2;
$tableO[170] = 2.2;

$output = '<h4>750 kpm/min (125w), män:</h4><table><tr><td>Puls</td><td>Interp</td><td>Tabellvärden</td><td>Differens</td></tr>';
for ($i = 110; $i <= 170; $i++) {
$interpolval = weigh($tableN,$i);
$tableval = $tableO[$i];
$diff = round($interpolval-$tableval,2);
if($diff >= 0.1) $diff = '<font color="red">'.$diff.'</font>';
elseif($diff <= 0.05) $diff = '<font color="lightgreen">'.$diff.'</font>';
$output.= '<tr><td>'.$i.'</td><td>'.$interpolval.'</td><td>'.$tableval.'</td><td>'.$diff.'</td></tr>';
}
echo $output.'</table>';


// tableF: 1200 kpm/min (200w) Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Män
$tableF[120] = 6.4;
$tableF[126] = 5.8;
$tableF[130] = 5.5;
$tableF[140] = 4.8;
$tableF[144] = 4.5;
$tableF[150] = 4.3;
$tableF[154] = 4;
$tableF[160] = 3.8;
$tableF[170] = 3.4;

// tableG: Korr, 1200 kpm/min (200w) Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Män
$tableG[120] = 6.4;
$tableG[121] = 6.3;
$tableG[122] = 6.2;
$tableG[123] = 6.1;
$tableG[124] = 6;
$tableG[125] = 5.9;
$tableG[126] = 5.8;
$tableG[127] = 5.7;
$tableG[128] = 5.6;
$tableG[129] = 5.6;
$tableG[130] = 5.5;
$tableG[131] = 5.4;
$tableG[132] = 5.3;
$tableG[133] = 5.3;
$tableG[134] = 5.2;
$tableG[135] = 5.1;
$tableG[136] = 5;
$tableG[137] = 5;
$tableG[138] = 4.9;
$tableG[139] = 4.8;
$tableG[140] = 4.8;
$tableG[141] = 4.7;
$tableG[142] = 4.6;
$tableG[143] = 4.6;
$tableG[144] = 4.5;
$tableG[145] = 4.5;
$tableG[146] = 4.4;
$tableG[147] = 4.4;
$tableG[148] = 4.3;
$tableG[149] = 4.3;
$tableG[150] = 4.3;
$tableG[151] = 4.2;
$tableG[152] = 4.1;
$tableG[153] = 4.1;
$tableG[154] = 4;
$tableG[155] = 4;
$tableG[156] = 4;
$tableG[157] = 3.9;
$tableG[158] = 3.9;
$tableG[159] = 3.8;
$tableG[160] = 3.8;
$tableG[161] = 3.7;
$tableG[162] = 3.7;
$tableG[163] = 3.7;
$tableG[164] = 3.6;
$tableG[165] = 3.6;
$tableG[166] = 3.6;
$tableG[167] = 3.5;
$tableG[168] = 3.5;
$tableG[169] = 3.5;
$tableG[170] = 3.4;

$output = '<h4>1200 kpm/min (200w), män:</h4><table><tr><td>Puls</td><td>Interp</td><td>Tabellvärden</td><td>Differens</td></tr>';
for ($i = 120; $i <= 170; $i++) {
$interpolval = weigh($tableF,$i);
$tableval = $tableG[$i];
$diff = round($interpolval-$tableval,2);
if($diff >= 0.1) $diff = '<font color="red">'.$diff.'</font>';
elseif($diff <= 0.05) $diff = '<font color="lightgreen">'.$diff.'</font>';
$output.= '<tr><td>'.$i.'</td><td>'.$interpolval.'</td><td>'.$tableval.'</td><td>'.$diff.'</td></tr>';
}
echo $output.'</table>';

// tableH: 300 kpm/min Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Kvinnor
$tableH[118] = 2.7;
$tableH[130] = 2.1;
$tableH[140] = 1.8;
$tableH[148] = 1.6;

// tableI: Korr, 300 kpm/min Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Kvinnor
$tableI[118] = 2.7;
$tableI[119] = 2.6;
$tableI[120] = 2.6;
$tableI[121] = 2.5;
$tableI[122] = 2.5;
$tableI[123] = 2.4;
$tableI[124] = 2.4;
$tableI[125] = 2.3;
$tableI[126] = 2.3;
$tableI[127] = 2.2;
$tableI[128] = 2.2;
$tableI[129] = 2.2;
$tableI[130] = 2.1;
$tableI[131] = 2.1;
$tableI[132] = 2;
$tableI[133] = 2;
$tableI[134] = 2;
$tableI[135] = 2;
$tableI[136] = 1.9;
$tableI[137] = 1.9;
$tableI[138] = 1.8;
$tableI[139] = 1.8;
$tableI[140] = 1.8;
$tableI[141] = 1.8;
$tableI[142] = 1.7;
$tableI[143] = 1.7;
$tableI[144] = 1.7;
$tableI[145] = 1.6;
$tableI[146] = 1.6;
$tableI[147] = 1.6;
$tableI[148] = 1.6;

$output = '<h4>300 kpm/min, kvinnor:</h4><table><tr><td>Puls</td><td>Interp</td><td>Tabellvärden</td><td>Differens</td></tr>';
for ($i = 118; $i <= 148; $i++) {
$interpolval = weigh($tableH,$i);
$tableval = $tableI[$i];
$diff = round($interpolval-$tableval,2);
if($diff >= 0.1) $diff = '<font color="red">'.$diff.'</font>';
elseif($diff <= 0.05) $diff = '<font color="lightgreen">'.$diff.'</font>';
$output.= '<tr><td>'.$i.'</td><td>'.$interpolval.'</td><td>'.$tableval.'</td><td>'.$diff.'</td></tr>';
}
echo $output.'</table>';

// tableJ: 600 kpm/min Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Kvinnor
$tableJ[120] = 4.1;
$tableJ[126] = 3.3;
$tableJ[130] = 3.4;
$tableJ[140] = 2.8;
$tableJ[150] = 2.5;
$tableJ[160] = 2.2;
$tableJ[170] = 2;

// tableK: Korr, 600 kpm/min Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Kvinnor
$tableK[120] = 4.1;
$tableK[121] = 4;
$tableK[122] = 3.9;
$tableK[123] = 3.9;
$tableK[124] = 3.8;
$tableK[125] = 3.7;
$tableK[126] = 3.3;
$tableK[127] = 3.5;
$tableK[128] = 3.5;
$tableK[129] = 3.4;
$tableK[130] = 3.4;
$tableK[131] = 3.4;
$tableK[132] = 3.3;
$tableK[133] = 3.2;
$tableK[134] = 3.2;
$tableK[135] = 3.1;
$tableK[136] = 3.1;
$tableK[137] = 3;
$tableK[138] = 3;
$tableK[139] = 2.9;
$tableK[140] = 2.8;
$tableK[141] = 2.8;
$tableK[142] = 2.8;
$tableK[143] = 2.7;
$tableK[144] = 2.7;
$tableK[145] = 2.7;
$tableK[146] = 2.6;
$tableK[147] = 2.6;
$tableK[148] = 2.6;
$tableK[149] = 2.6;
$tableK[150] = 2.5;
$tableK[151] = 2.5;
$tableK[152] = 2.5;
$tableK[153] = 2.4;
$tableK[154] = 2.4;
$tableK[155] = 2.4;
$tableK[156] = 2.3;
$tableK[157] = 2.3;
$tableK[158] = 2.3;
$tableK[159] = 2.2;
$tableK[160] = 2.2;
$tableK[161] = 2.2;
$tableK[162] = 2.2;
$tableK[163] = 2.2;
$tableK[164] = 2.1;
$tableK[165] = 2.1;
$tableK[166] = 2.1;
$tableK[167] = 2.1;
$tableK[168] = 2;
$tableK[169] = 2;
$tableK[170] = 2;

$output = '<h4>600 kpm/min, kvinnor:</h4><table><tr><td>Puls</td><td>Interp</td><td>Tabellvärden</td><td>Differens</td></tr>';
for ($i = 120; $i <= 170; $i++) {
$interpolval = weigh($tableJ,$i);
$tableval = $tableK[$i];
$diff = round($interpolval-$tableval,2);
if($diff >= 0.1) $diff = '<font color="red">'.$diff.' ('.$i.', '.$tableK[$i].')</font>';
elseif($diff <= 0.05) $diff = '<font color="lightgreen">'.$diff.'</font>';
$output.= '<tr><td>'.$i.'</td><td>'.$interpolval.'</td><td>'.$tableval.'</td><td>'.$diff.'</td></tr>';
}
echo $output.'</table>';


// tableL: 750 kpm/min Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Kvinnor
$tableL[120] = 4.8;
$tableL[130] = 4;
$tableL[140] = 3.4;
$tableL[150] = 3;
$tableL[160] = 2.6;
$tableL[170] = 2.4;

// tableM: Korr, 750 kpm/min Beräkning av maximal syreupptagningsförmåga från arbetspuls och belastning(kpm/min) - Kvinnor
$tableM[120] = 4.8;
$tableM[121] = 4.8;
$tableM[122] = 4.7;
$tableM[123] = 4.6;
$tableM[124] = 4.5;
$tableM[125] = 4.4;
$tableM[126] = 4.3;
$tableM[127] = 4.2;
$tableM[128] = 4.2;
$tableM[129] = 4.1;
$tableM[130] = 4;
$tableM[131] = 4;
$tableM[132] = 3.9;
$tableM[133] = 3.8;
$tableM[134] = 3.8;
$tableM[135] = 3.7;
$tableM[136] = 3.6;
$tableM[137] = 3.6;
$tableM[138] = 3.5;
$tableM[139] = 3.5;
$tableM[140] = 3.4;
$tableM[141] = 3.4;
$tableM[142] = 3.3;
$tableM[143] = 3.3;
$tableM[144] = 3.2;
$tableM[145] = 3.2;
$tableM[146] = 3.2;
$tableM[147] = 3.1;
$tableM[148] = 3.1;
$tableM[149] = 3;
$tableM[150] = 3;
$tableM[151] = 3;
$tableM[152] = 2.9;
$tableM[153] = 2.9;
$tableM[154] = 2.8;
$tableM[155] = 2.8;
$tableM[156] = 2.8;
$tableM[157] = 2.7;
$tableM[158] = 2.7;
$tableM[159] = 2.7;
$tableM[160] = 2.6;
$tableM[161] = 2.6;
$tableM[162] = 2.6;
$tableM[163] = 2.6;
$tableM[164] = 2.5;
$tableM[165] = 2.5;
$tableM[166] = 2.5;
$tableM[167] = 2.4;
$tableM[168] = 2.4;
$tableM[169] = 2.4;
$tableM[170] = 2.4;

$output = '<h4>750 kpm/min, kvinnor:</h4><table><tr><td>Puls</td><td>Interp</td><td>Tabellvärden</td><td>Differens</td></tr>';
for ($i = 120; $i <= 170; $i++) {
$interpolval = weigh($tableL,$i);
$tableval = $tableM[$i];
$diff = round($interpolval-$tableval,2);
if($diff >= 0.1) $diff = '<font color="red">'.$diff.'</font>';
elseif($diff <= 0.05) $diff = '<font color="lightgreen">'.$diff.'</font>'; 
$output.= '<tr><td>'.$i.'</td><td>'.$interpolval.'</td><td>'.$tableval.'</td><td>'.$diff.'</td></tr>';
}
echo $output.'</table>';



// KVOTER MELLAN OLIKA TABELLER

$output = '<h4>Kvoter mellan tabeller:</h4><table><tr>
<td>Män <br/> C (300 kpm/min)<br/> E (600 kpm/min)</td>
<td>Kvinnor <br/> I (300 kpm/min)<br/> K (600 kpm/min)</td>
<td>Män <br/> C (300 kpm/min)<br/>Kvinnor <br/> I (300 kpm/min)</td>
<td>Män <br/> E (600 kpm/min)<br/> O (750 kpm/min)</td>
<td>Kvinnor <br/> K (600 kpm/min)<br/> M (750 kpm/min)</td>
<td>Män <br/> E (600 kpm/min)<br/>Kvinnor <br/> K (600 kpm/min)</td>
<td>Män <br/> O (750 kpm/min)<br/> G (1200 kpm/min)</td>
</tr>';
for ($i = 120; $i <= 170; $i++) {
$CE = round($tableC[$i]/$tableE[$i],2);
$IK = round($tableI[$i]/$tableK[$i],2);
$CI = round($tableC[$i]/$tableI[$i],2);
$EO = round($tableE[$i]/$tableO[$i],2);
$KM = round($tableK[$i]/$tableM[$i],2);
$EK = round($tableE[$i]/$tableK[$i],2);
$OG = round($tableO[$i]/$tableG[$i],2);
$output.= '<tr><td>'.$CE.'</td><td>'.$IK.'</td><td>'.$CI.'</td><td>'.$EO.'</td><td>'.$KM.'</td><td>'.$EK.'</td><td>'.$OG.'</td></tr>';
}
echo $output.'</table>';

echo '</body></html>'; // foot
?>