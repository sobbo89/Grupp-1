<?php

$pattern = "INSERT INTO livsstil VALUES (504,2006-06-14 18:08:03,christina.malmius@ericsson.com,'Christina Malmius','Kvinna','1965','christina.malmius@ericsson.com','08-50876772','40+','Stillasittande','Ibland','Mycket bra','Ganska bra','Ganska bra','Flera gŒnger per vecka','Promenad till jobbet','Aldrig',NULL,'Ganska viktigt','Bra','Ganska bra','Fšr hšg','FšrbŠttra konditionen,ViktminskningsŒtgŠrder,Personlig utveckling,€ndra min privata situation',NULL,'Nej','Nej','Ja','Nej','Nej','Nej',NULL,'Nej',NULL,'Nej',1992,NULL,'Nej',1989,NULL,NULL,NULL,NULL,NULL);";

$find = "',([^a-z,]{15-20}),([^,@]{1,80})@([^,@]{2,80}).([a-z]{2,5}),'";

$template  = preg_replace($find,$pattern,$template);

echo $template;

?>