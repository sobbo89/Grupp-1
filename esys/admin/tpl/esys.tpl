<?php
//////////////////////////////////////
// ESYS 2.0 TEMPLATES
// templates options

//////////////////////////////////////
// template 1 options
// template 1 (grupper)
$template1 = <<<HTML
<option value="{id}">{gruppnamn}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 2 options
// template 2 (grupper)
$template2 = <<<HTML
<option value="{id}" selected="selected">{gruppnamn}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 3 options
// template 3 (respondents)
$template3 = <<<HTML
<option value="{ID}">{f1}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 4 options
// template 4 (respondents)
$template4 = <<<HTML
<option value="{ID}" selected="selected">{f1}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 5 options
// template 5 (cstillfälle)
$template5 = <<<HTML
<option value="{ID}">{Tillfalle}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 6 options
// template 6 (cstillfälle)
$template6 = <<<HTML
<option value="{ID}" selected="selected">{Tillfalle}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 7 options
// template 7 (csanv)
$template7 = <<<HTML
<br/><br/>
<div class="rowAB">
<div class="colA2">
<strong>Tillfälle {Tillfalle}</strong> &nbsp; &nbsp; <a href="?action=formular_edit&GruppID={GruppID}&AnvID={AnvID}&cat_id={-qstr-}&CSID={ID}&Tillfalle={Tillfalle}#a_15">(ändra)</a></div>
<div class="colB2">{Kortdatum}</div>
</div>
<div class="rowAB">
<div class="colA2">Hur mår du fysiskt?</div>
<div class="colB2">{f1}</div>
</div>
<div class="rowAB">
<div class="colA2">Hur mår du socialt?</div>
<div class="colB2">{f2}</div>
</div>
<div class="rowAB">
<div class="colA2">Hur ofta är du stressad?</div>
<div class="colB2">{f3}</div>
</div>
<div class="rowAB">
<div class="colA2">Hur ofta tränar du?</div>
<div class="colB2">{f4}</div>
</div>
<div class="rowAB">
<div class="colA2">Hur är din sömn?</div>
<div class="colB2">{f5}</div>
</div>
<div class="rowAB">
<div class="colA2">Hur är dina matvanor?</div>
<div class="colB2">{f6}</div>
</div>
<div class="rowAB">
<div class="colA2">Kroppssammansättningstest</div>
<div class="colB2">{f7}</div>
</div>
<div class="rowAB">
<div class="colA2">Rörlighetstest</div>
<div class="colB2">{f8}</div>
</div>
<div class="rowAB">
<div class="colA2">Konditionstest</div>
<div class="colB2">{f9}</div>
</div>
<div class="rowAB">
<div class="colA2">Styrketest</div>
<div class="colB2">{f10}</div>
</div>
<div class="rowAB">
<div class="colA2">Watt</div>
<div class="colB2"><strong>{ft11}</strong></div>
</div>
<div class="rowAB">
<div class="colA2">Arbetspuls</div>
<div class="colB2"><strong>{ft12}</strong></div>
</div>
<div class="rowAB">
<div class="colA2">Kroppsvikt</div>
<div class="colB2"><strong>{ft13}</strong></div>
</div>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 8 options
// template 8 (coacher)
$template8 = <<<HTML
	<tr>
		<td><a href="?action=formular_edit&coacher_CoachID={id}&cat_id={-qstr-}#a_18">{coachnamn}</a></td>
		<td>{coachlogin}</td>
		<td>{coachlosen}</td>
		<td><a href="mailto:{coachemail}">{coachemail}</a></td>
		<td>{langs}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 9 options
// template 9 (grupper)
$template9 = <<<HTML
	<tr>
		<td>{Foretagsnamn}</td>
		<td><a href="?action=formular_edit&grupper_GruppID={id}&cat_id={-qstr-}">{gruppnamn}</a></td>
		<td>{grupplogin}</td>
		<td>{grupplosen}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 10 options
// template 10 (coacher)
$template10 = <<<HTML
<option value="{id}">{coachnamn}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 11 options
// template 11 (grupper)
$template11 = <<<HTML
<option value="{id}">{gruppnamn}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 12 options
// template 12 (visa cxg)
$template12 = <<<HTML
<tr>
<td>{coachnamn} @ {gruppnamn} ({-coachcounter-})</td>
<td><input type="button" class="submit" onclick="document.listcxg.cxgid.value={ID};document.listcxg.submit();" value="Ta bort koppling" title="Coachens ID är {coachID}"/></td>
</tr>
HTML;
/* maxantal code:
<td><input type="text" class="inputnum2" name="maxantal_{ID}" value="{Maxantal}"/></td>
<td><input type="button" class="submit" onclick="document.listcxg.cxgid.value={ID};document.listcxg.action.value='update';document.listcxg.maxantal.value=document.listcxg.maxantal_{ID}.value;document.listcxg.submit();" value="Sätt maxantal för coach>grupp" title="Sätt maxantal individer för coachen i denna grupp. Värdet 0 betyder ingen begränsning. Värdet -1 betyder stopp."/></td>
*/
//////////////////////////////////////

//////////////////////////////////////
// template 13 options
// template 13 (utv)
$template13 = <<<HTML
<br/><br/><strong>Utvärdering för {Anvnamn}</strong> &nbsp; &nbsp; <br/><br/>
<table id="table16">
<tr><td>1. Hälsocoachingen motsvarade mina förväntningar</td><td>{f1}</td></tr>
<tr><td>2. Hälsocoachingen har ändrat min inställning till hälsa</td><td>{f2}</td></tr>
<tr><td>3. Hälsocoachingen har gett mig inspiration och motivation</td><td>{f3}</td></tr>
<tr><td>4. Hälsocoachingen har har ändrat mina vanor</td><td>{f4}</td></tr>
<tr><td>5. Min hälsocoach gav mig uppmärksamhet och stöd</td><td>{f5}</td></tr>
<tr><td>6. Min fysiska välbefinnande har förbättrats</td><td>{f6}</td></tr>
<tr><td>7. Jag upplever att hela gruppen har påverkats positivt</td><td>{f7}</td></tr>
<tr><td>8. Hela upplägget har varit välorganiserat</td><td>{f8}</td></tr>
<tr><td>9. Jag kommer nu själv att forsätta med mina uppsatta mål</td><td>{f9}</td></tr>
<tr><td>10. Jag vill gärna försätta med ytterligare coachingstöd</td><td>{f10}</td></tr>
<tr><td>11. Kommentarer (fritext):</td><td><em>{f11}</em></td></tr>
</table>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 14 options
// template 14 (livsstil)
$template14 = <<<HTML
<table id="table17">
<br/><br/><strong>Livsstilsenkät för {f1}</strong> &nbsp; &nbsp; <br/><br/>
<tr><td>1. Namn</td><td>{f1}</td></tr>
<tr><td>2. Kön</td><td>{f2}</td></tr>
<tr><td>3. Födelseår</td><td>{f3}</td></tr>
<tr><td>4. Epost</td><td>{f4}</td></tr>
<tr><td>5. Telefonnummer</td><td>{f5}</td></tr>
<tr><td>6. Antal arbetstimmar per vecka</td><td>{f6}</td></tr>
<tr><td>7. Är Ditt arbete huvudsakligen</td><td>{f7}</td></tr>
<tr><td>8. Känner Du dig stressad/trött</td><td>{f8}</td></tr>
<tr><td>9. Hur trivs Du med Ditt arbete</td><td>{f9}</td></tr>
<tr><td>10. Hur trivs Du med Ditt sociala liv (familj och vänner)</td><td>{f10}</td></tr>
<tr><td>11. Hur upplever Du Din allmänna hälsa</td><td>{f11}</td></tr>
<tr><td>12. Hur ofta vardagsmotionerar Du t.ex. går ut med hunden, promenerar till jobbet eller annat</td><td>{f12}</td></tr>
<tr><td>13. Ange gärna på vilket sätt</td><td>{f13}</td></tr>
<tr><td>14. Hur ofta motionerar Du med syfte att förbättra Din hälsa, styrka och kondition</td><td>{f14}</td></tr>
<tr><td>15. Ange gärna på vilket sätt</td><td>{f15}</td></tr>
<tr><td>16. Anser Du att det är viktigt för Dig att förbättra Din kondition</td><td>{f16}</td></tr>
<tr><td>17. Vad anser Du om Dina kostvanor</td><td>{f17}</td></tr>
<tr><td>18. Hur sover Du</td><td>{f18}</td></tr>
<tr><td>19. Vad anser Du om Din vikt</td><td>{f19}</td></tr>
<tr><td>20. Vilka åtgärder tror Du skulle förbättra Din fysiska och psykiska hälsa</td><td>{f20}</td></tr>
<tr><td>21. Annan åtgärd</td><td>{f21}</td></tr>
<tr><td>22. Är det någon i familjen som haft hjärt-/kärlbesvär före 50 års ålder</td><td>{f22}</td></tr>
<tr><td>23. Har Du genomgått några operationer</td><td>{f23}</td></tr>
<tr><td>24. Har Du haft några allvarligare skador benbrott/fraktur etc.</td><td>{f24}</td></tr>
<tr><td>25. Har Du eller har Du någon gång haft rygg- och nackbesvär</td><td>{f25}</td></tr>
<tr><td>26. Har Du högt blodtryck eller högt kolesterolvärde</td><td>{f26}</td></tr>
<tr><td>27. Har Du besökt läkare för något hälsotillstånd de senaste fem åren</td><td>{f27}</td></tr>
<tr><td>28. Om ja, ange vilket</td><td>{f28}</td></tr>
<tr><td>29. Tar Du några mediciner</td><td>{f29}</td></tr>
<tr><td>30.Om ja, ange vilka</td><td>{f30}</td></tr>
<tr><td>31. Röker Du</td><td>{f31}</td></tr>
<tr><td>32. Jag har rökt men slutade år</td><td>{f32}</td></tr>
<tr><td>33. Om ja, hur många cigaretter per dag</td><td>{f33}</td></tr>
<tr><td>34. Snusar du</td><td>{f34}</td></tr>
<tr><td>35. Jag har snusat men slutade år</td><td>{f35}</td></tr>
<tr><td>36. Om ja, hur många prillor per dag</td><td>{f36}</td></tr>
<tr><td>37. Har Du någon gång fått behandling av</td><td>{f37}</td></tr>
<tr><td>38. Hur många gånger gick Du</td><td>{f38}</td></tr>
<tr><td>39. Gav det resultat</td><td>{f39}</td></tr>
<tr><td>40. Är det något mer Du vill tillägga som kan ha betydelse för vår behandling/träning så skriv gärna ned det här</td><td>{f40}</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><em>43. CoachID (special)</em></td><td><em>{f43}</em></td></tr>
</table>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 15 options
// template 15 (chefsutv)
$template15 = <<<HTML
<br/><br/><strong>Utvärdering för {Anvnamn}</strong> (chef för grupp nr {f0}) &nbsp; &nbsp; <br/><br/>
<table id="table23">
<tr><td>1. Hälsocoachingen motsvarade våra förväntningar</td><td>{f1}</td></tr>
<tr><td>2. Hälsocoachingen har ändrat mångas inställning till hälsa</td><td>{f2}</td></tr>
<tr><td>3. Hälsocoachingen har gett inspiration och motivation</td><td>{f3}</td></tr>
<tr><td>4. Hälsocoachingen har har påverkat motionsvanor</td><td>{f4}</td></tr>
<tr><td>5. Det fysiska välbefinnandet har förbättrats</td><td>{f5}</td></tr>
<tr><td>6. Hela gruppens arbetssituation har förbättrats</td><td>{f6}</td></tr>
<tr><td>7. Hela gruppen har påverkats positivt</td><td>{f7}</td></tr>
<tr><td>8. Hela upplägget har varit välorganiserat</td><td>{f8}</td></tr>
<tr><td>9. Vår hälsocoach uppträder professionellt</td><td>{f9}</td></tr>
<tr><td>10. Kommentarer (fritext):</td><td><em>{f10}</em></td></tr>
</table>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 16 options
// template 16 (chefer)
$template16 = <<<HTML
	<tr>
		<td><a href="?action=formular_edit&chefer_ChefID={id}&cat_id={-qstr-}">{chefnamn}</a></td>
		<td>{cheflogin}</td>
		<td>{cheflosen}</td>
		<td>{chefemail}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 17 options
// template 17 (chefer)
$template17 = <<<HTML
<option value="{id}">{chefnamn}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 18 options
// template 18 (visa chxg)
$template18 = <<<HTML
<tr>
<td>{chefnamn} @ {gruppnamn}</td>
<td><input type="button" class="submit" onclick="document.listcxg.cxgid.value={ID};document.listcxg.submit();" value="Ta bort koppling"/></td>
</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 19 options
// template 19 (ny utv)
$template19 = <<<HTML
<br/><br/><strong>Utvärdering för {Anvnamn}</strong> &nbsp; &nbsp; <br/><br/>
<table id="table19">
<tr><td>1. Hälsocoachingen motsvarade mina förväntningar</td><td>{f1}</td></tr>
<tr><td>2. Hälsocoachingen har förändrat min inställning till hälsa</td><td>{f2}</td></tr>
<tr><td>3. Hälsocoachingen har gett mig inspiration och motivation</td><td>{f3}</td></tr>
<tr><td>4. Hälsocoachingen har har påverkat mina levnadsvanor</td><td>{f4}</td></tr>
<tr><td>5. Min hälsocoach gav mig uppmärksamhet och stöd</td><td>{f5}</td></tr>
<tr><td>6. Min fysiska välbefinnande har förbättrats</td><td>{f6}</td></tr>
<tr><td>7. Min psysiska välbefinnande har förbättrats</td><td>{f7}</td></tr>
<tr><td>8. Jag upplever att deltagarna i vår grupp har påverkats positivt</td><td>{f8}</td></tr>
<tr><td>9. Hela upplägget har varit välorganiserat</td><td>{f9}</td></tr>
<tr><td>10. Jag kommer nu själv att forsätta mot mina uppsatta mål</td><td>{f10}</td></tr>
<tr><td>11. Jag skulle gärna vilja fortsätta med ytterligare coachingstöd</td><td>{f11}</td></tr>
<tr><td>12. Kommentarer (fritext):</td><td><em>{f12}</em></td></tr>
</table>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 20 options
// template 20 (catz)
$template20 = <<<HTML
<option value="{ID}">{title}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 21 options
// template 21 (visa uxcat)
$template21 = <<<HTML
<tr>
<td>nivå {ulvl}: {title} &nbsp; &nbsp; &nbsp; </td>
<td><input type="button" class="submit" onclick="document.listcxg.cxgid.value={ID};document.listcxg.submit();" value="Ta bort koppling"/></td>
</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 22 options
// template 22 (uppfolj)
$template22 = <<<HTML
<table id="table33">
<br/><br/><strong>Uppföljningsenkät för {f1}</strong> &nbsp; &nbsp; <br/><br/>
<tr><td>1. Namn</td><td>{f1}</td></tr>
<tr><td>2. Epost</td><td>{f2}</td></tr>
<tr><td>3. Antal arbetstimmar per vecka</td><td>{f3}</td></tr>
<tr><td>4. Har din stressnivå ändrats sedan du startade din hälsocoaching?</td><td>{f4}</td></tr>
<tr><td>5. Hur trivs Du med Ditt arbete</td><td>{f5}</td></tr>
<tr><td>6. Hur trivs Du med Ditt sociala liv (familj och vänner)</td><td>{f6}</td></tr>
<tr><td>7. Upplever du att din allmänna hälsa blivit bättre sedan din hälsocoaching?</td><td>{f7}</td></tr>
<tr><td>8. Vardagsmotionerar du mer nu än du gjort tidigare, innan din hälsocoaching?</td><td>{f8}</td></tr>
<tr><td>9. Hur ofta motionerar Du med syfte att förbättra Din hälsa, styrka och kondition?</td><td>{f9}</td></tr>
<tr><td>10. Ange gärna på vilket sätt</td><td>{f10}</td></tr>
<tr><td>11. Vad anser Du om Dina kostvanor?</td><td>{f11}</td></tr>
<tr><td>12. Har dina kostvanor förbättrats sen du startade din hälsocoaching?</td><td>{f12}</td></tr>
<tr><td>13. Hur sover Du jämfört med innan du startade hälsocoachingen?</td><td>{f13}</td></tr>
<tr><td>14. Vad anser Du om Din vikt?</td><td>{f14}</td></tr>
<tr><td>15. Vilka mål hade du med din hälsocoaching när du började?</td><td>{f15}</td></tr>
<tr><td>16. Anser du att du uppnått dessa mål?</td><td>{f16}</td></tr>
<tr><td>17. Har du lyckats vidmakthålla dina nya vanor?</td><td>{f17}</td></tr>
<tr><td>18. Vad skulle du vilja fokusera på vid kommande uppföljningsmöte?</td><td>{f18}</td></tr>
<tr><td>19. Är det något mer Du vill tillägga som kan ha betydelse för vår hälsocoaching så skriv gärna ned det här</td><td>{f19}</td></tr>
</table>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 23 options
// template 23 (grupper)
$template23 = <<<HTML
<option value="{ID}">{Foretagsnamn}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 24 options
// template 24 (visa chxg)
$template24 = <<<HTML
<tr>
<td>{chefnamn} @ {Foretagsnamn}</td>
<td><input type="button" class="submit" onclick="document.listcxf.cxfid.value={ID};document.listcxf.submit();" value="Ta bort koppling"/></td>
</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 25 options
// template 25 (roller)
$template25 = <<<HTML
	<tr>
		<td>{Foretagsnamn}</td>
		<td><a href="?action=formular_edit&roller_RollID={id}&cat_id={-qstr-}">{rollnamn}</a></td>
		<td>{rolllogin}</td>
		<td>{rolllosen}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 26 options
// template 26 (coachförval)
$template26 = <<<HTML
	<tr>
		<td>ok</td>
		<td><a href="?GruppID={GruppID}&AnvID={ID}&cat_id=17">{f1}</a></td>
		<td><a href="mailto:{f4}">{f4}</a></td>
		<td>{f5}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 27 options
// template 27 (grupper)
$template27 = <<<HTML
<option value="{id}">{gruppnamn} ({-coachcounter-})</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 28 options
// template 28 (grupper)
$template28 = <<<HTML
<option value="{id}" selected="selected">{gruppnamn} ({-coachcounter-})</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 29 options
// template 29 (coachförval - hightlighted)
$template29 = <<<HTML
	<tr>
		<td class="highlight"><a href="?GruppID={GruppID}&cat_id=36&LvID={LvID}&action=activate">Aktivera</a></td>
		<td class="highlight"><a href="?GruppID={GruppID}&AnvID={ID}&cat_id=17">{f1}</a></td>
		<td class="highlight"><a href="mailto:{f4}">{f4}</a></td>
		<td class="highlight">{f5}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 30 options
// template 30 (visa coxf)
$template30 = <<<HTML
<tr>
<td>{coachnamn} @ {Foretagsnamn}</td>
<td><input type="button" class="submit" onclick="document.listcoxf.coxfid.value={ID};document.listcoxf.submit();" value="Ta bort koppling" title=""/></td>
<td><input type="text" class="inputnum2" name="maxantal_{ID}" value="{Maxantal}"/></td>
<td><input type="button" class="submit" onclick="document.listcoxf.coxfid.value={ID};document.listcoxf.action.value='update';document.listcoxf.maxantal.value=document.listcoxf.maxantal_{ID}.value;document.listcoxf.submit();" value="Sätt maxantal för coach>företag" title="Sätt maxantal individer för coachen i detta företag. Värdet 0 betyder ingen begränsning. Värdet -1 betyder stopp."/></td>
</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 31 options
// template 31 (coachadministration - hightlighted)
$template31 = <<<HTML
	<tr>
		<!--<td class="highlight"><a href="?GruppID={GruppID}&cat_id=36&LvID={LvID}&action=activate">Aktivera</a></td>-->
		<td class="highlight">{coachnamn}</td>
		<td><a href="?action=CAbytcoach&coacher_CoachID={coachID}&AnvID={ID}&{-qstr-}">redigera</a></td>
		<td class="highlight"><a href="?GruppID={GruppID}&AnvID={ID}&cat_id=17">{f1}</a></td>
		<td class="highlight"><a href="mailto:{f4}">{f4}</a></td>
		<td class="highlight">{f5}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 32 options
// template 32 (coachadministration)
$template32 = <<<HTML
	<tr>
		<!--<td>ok</td>-->
		<td>{coachnamn}</td>
		<td><a href="?action=CAbytcoach&coacher_CoachID={coachID}&AnvID={ID}&{-qstr-}">redigera</a></td>
		<td><a href="?GruppID={GruppID}&AnvID={ID}&cat_id=17">{f1}</a></td>
		<td><a href="mailto:{f4}">{f4}</a></td>
		<td>{f5}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 33 options
// template 33 (grupper)
$template33 = <<<HTML
<option value="{id}">{gruppnamn} ({-livsstilcounter-})</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 34 options
// template 34 (grupper)
$template34 = <<<HTML
<option value="{id}" selected="selected">{gruppnamn} ({-livsstilcounter-})</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 35 options
// template 35 (foretag)
$template35 = <<<HTML
<option value="{ID}">{Foretagsnamn}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 36 options
// template 36 (foretag)
$template36 = <<<HTML
<option value="{ID}" selected="selected">{Foretagsnamn}</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 37 options
// template 37 (coachadministration)
$template37 = <<<HTML
	<tr>
		<!--<td>ok</td>-->
		<td class="kursiv">ingen</td>
		<td class="highlight"><a href="?action=CAbytcoach&coacher_CoachID={coachID}&AnvID={ID}&{-qstr-}">redigera</a></td>
		<td class="kursiv"><a href="?GruppID={GruppID}&AnvID={ID}&cat_id=17">{f1}</a></td>
		<td class="kursiv"><a href="mailto:{f4}">{f4}</a></td>
		<td class="kursiv">{f5}</td>
	</tr>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 38 options
// template 38 (grupper)
$template38 = <<<HTML
<option value="{id}">{gruppnamn} ({-uppfoljcounter-})</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 39 options
// template 39 (grupper)
$template39 = <<<HTML
<option value="{id}" selected="selected">{gruppnamn} ({-uppfoljcounter-})</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 40 options
// template 40 (grupper)
$template40 = <<<HTML
<option value="{id}">{gruppnamn} ({-utvcounter-})</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 41 options
// template 41 (grupper)
$template41 = <<<HTML
<option value="{id}" selected="selected">{gruppnamn} ({-utvcounter-})</option>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 42 options
// template 42 (livsstil 2 intern)
$template42 = <<<HTML
<table id="table17">
<br/><br/><strong>Livsstilsenkät för {f1}</strong> &nbsp; &nbsp; <br/><br/>
<tr><td>1. Namn</td><td>{f1}</td></tr>
<tr><td>2. Kön</td><td>{f2}</td></tr>
<tr><td>3. Födelseår</td><td>{f3}</td></tr>
<tr><td>4. Epost</td><td>{f4}</td></tr>
<tr><td>5. Telefonnummer</td><td>{f5}</td></tr>
<tr><td>6. Antal arbetstimmar per vecka</td><td>{f6}</td></tr>
<tr><td>7. Är Ditt arbete huvudsakligen</td><td>{f7}</td></tr>
<tr><td>8. Känner Du dig stressad/trött</td><td>{f8}</td></tr>
<tr><td>9. Hur trivs Du med Ditt arbete</td><td>{f9}</td></tr>
<tr><td>10. Hur trivs Du med Ditt sociala liv (familj och vänner)</td><td>{f10}</td></tr>
<tr><td>11. Hur upplever Du Din allmänna hälsa</td><td>{f11}</td></tr>
<tr><td>12. Hur ofta vardagsmotionerar Du t.ex. går ut med hunden, promenerar till jobbet eller annat</td><td>{f12}</td></tr>
<tr><td>13. Ange gärna på vilket sätt</td><td>{f13}</td></tr>
<tr><td>14. Hur ofta motionerar Du med syfte att förbättra Din hälsa, styrka och kondition</td><td>{f14}</td></tr>
<tr><td>15. Ange gärna på vilket sätt</td><td>{f15}</td></tr>
<tr><td>16. Anser Du att det är viktigt för Dig att förbättra Din kondition</td><td>{f16}</td></tr>
<tr><td>17. Vad anser Du om Dina kostvanor</td><td>{f17}</td></tr>
<tr><td>18. Hur sover Du</td><td>{f18}</td></tr>
<tr><td>44. Om du svarat "Dåligt" eller "Mycket dåligt" på frågan ovan, vad är då främsta orsaken?</td><td>{f44}</td></tr>
<tr><td>19. Vad anser Du om Din vikt</td><td>{f19}</td></tr>
<tr><td>20. Vilka åtgärder tror Du skulle förbättra Din fysiska och psykiska hälsa</td><td>{f20}</td></tr>
<tr><td>21. Annan åtgärd</td><td>{f21}</td></tr>
<tr><td>22. Är det någon i familjen som haft hjärt-/kärlbesvär före 50 års ålder</td><td>{f22}</td></tr>
<tr><td>23. Har Du genomgått några operationer</td><td>{f23}</td></tr>
<tr><td>45. Om ja, specificera</td><td>{f45}</td></tr>
<tr><td>24. Har Du haft några allvarligare skador benbrott/fraktur etc.</td><td>{f24}</td></tr>
<tr><td>46. Om ja, specificera</td><td>{f46}</td></tr>
<tr><td>25. Har Du eller har Du någon gång haft rygg- och nackbesvär</td><td>{f25}</td></tr>
<tr><td>47. Om ja, vilken behandling fick du (om någon)?</td><td>{f47}</td></tr>
<tr><td>26. Har Du högt blodtryck eller högt kolesterolvärde</td><td>{f26}</td></tr>
<tr><td>27. Har Du besökt läkare för något hälsotillstånd de senaste fem åren</td><td>{f27}</td></tr>
<tr><td>28. Om ja, ange vilket</td><td>{f28}</td></tr>
<tr><td>29. Tar Du några mediciner</td><td>{f29}</td></tr>
<tr><td>30.Om ja, ange vilka</td><td>{f30}</td></tr>
<tr><td>31. Röker Du</td><td>{f31}</td></tr>
<tr><td>33. Om ja, hur många cigaretter per dag</td><td>{f33}</td></tr>
<tr><td>32. Jag har rökt men slutade år</td><td>{f32}</td></tr>
<tr><td>34. Snusar du</td><td>{f34}</td></tr>
<tr><td>36. Om ja, hur många prillor per dag</td><td>{f36}</td></tr>
<tr><td>35. Jag har snusat men slutade år</td><td>{f35}</td></tr>
<tr><td>37. Har Du någon gång fått behandling av</td><td>{f37}</td></tr>
<tr><td>38. Hur många gånger gick Du</td><td>{f38}</td></tr>
<tr><td>39. Gav det resultat</td><td>{f39}</td></tr>
<tr><td>40. Är det något mer Du vill tillägga som kan ha betydelse för vår behandling/träning så skriv gärna ned det här</td><td>{f40}</td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><em>41. GruppID (special)</em></td><td><em>{f41}</em></td></tr>
<tr><td><em>42. RollID (special)</em></td><td><em>{f42}</em></td></tr>
<tr><td><em>43. CoachID (special)</em></td><td><em>{f43}</em></td></tr>
<tr><td>&nbsp;</td><td>&nbsp;</td></tr>
<tr><td><em>48. Fysisk aktivitetsbedömning (special)</em></td><td><em>{f48}</em></td></tr>
<tr><td><em>49. Fysisk uthållighet (special)</em></td><td><em>{f49}</em></td></tr>
<tr><td><em>50. Vikt (special)</em></td><td><em>{f50}</em></td></tr>
<tr><td><em>51. Längd (special)</em></td><td><em>{f51}</em></td></tr>
</table>
HTML;
//////////////////////////////////////
?>