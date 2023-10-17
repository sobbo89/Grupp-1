<?php
//////////////////////////////////////
// ZEDIT 3.0 EDITORS TEMPLATES
// templates options

//////////////////////////////////////
// template 1 options
// template 1 (addlist)
$template1 = <<<HTML
<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<em>Created {DATECREATED} by {Author}. Modified {DATECHANGED}</em></span></div>

<form method=post name=update action="index.php">

<div class="rowAB"><span class="colA">Options</span><span class="colB">
<input type=checkbox name="FEATURE" value="{FEATURE}"/> feature &nbsp;&nbsp;&nbsp; 
<input title="Sort order" type=text size="5" name="SORT" value="{SORT}"/> sort &nbsp;&nbsp;&nbsp; 
<input title="Category" type=text size="2" name="CATEGORY" value="{CATEGORY}"/> category &nbsp;&nbsp;&nbsp; 
<input title="Parent" type=text size="2" name="PARENT" value="{PARENT}"/> parent &nbsp;&nbsp;&nbsp; 
</span></div>

<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<input type=checkbox name="INVISIBLE" value="{INVISIBLE}"/> archive &nbsp;&nbsp;&nbsp; 
<input title="Relation" type=text size="2" name="REL_1" value="{REL_1}"/> relation
</span></div>

<div class="rowAB"><span class="colA">Title</span><span class="colB">
<input title="Headline" type=text size="44" name="title" class="titlefield" value="{title}"/></span></div>

<div class="rowAB"><span class="colA">Text 1</span><span class="colB">
<textarea name="text_1" cols="49" rows="10">{text_1}</textarea>
</span></div>

<div class="rowAB"><span class="colA">Text 2</span><span class="colB">
<textarea name="text_2" cols="49" rows="10">{text_2}</textarea>
</span></div>

<div class="rowAB"><span class="colA">Text 3</span><span class="colB">
<textarea title="Infotext" name="text_3" cols="49" rows="3">{text_3}</textarea>
</span></div>

<div class="rowAB"><span class="colA">ISBN</span><span class="colB">
<input title="Article number" type=text size="44" name="ARTNR" value="{ARTNR}"/></span></div>

<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<div title="Add an image (optional)" class="buttinleft" href="#" onclick="window.open('images.php?action=quick&area=image_1&editor=info&pre_cell=image_1_cell', '_Addimage', 'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390');MM_showHideLayers('captinstr','','show','captfield','','show');return false;">Insert Image</div>
<a title="Publish changes" class="buttinright" href="#" onclick="document.update.submit();">Save changes</a>
<input type="hidden" name="action" value="update"/>
<input type="hidden" name="art_id" value="{ID}"/>
<input type="hidden" name="key" value="42"/>
</span></div>

<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<div title="Remove the image" class="buttinleft" href="#" onclick="document.addnews.image_1.value='';document.image_1_cell.src='skins/images/blank.gif'">Remove Image</div>
<div title="If you DELETE this article it can NOT be recovered!" class="buttinright" href="javascript:confirmDelete('index.php?mod=editnews&action=doeditnews&source=&ifdelete=yes&id=1102899981')">Delete article</div>
</span></div>

<div class="rowAB"><span class="colA">File 1</span><span class="colB">
<input title="File 1" type=text size="44" name="file_1" value="{file_1}"/></div>

<div class="rowAB"><span class="colA">File 2</span><span class="colB">
<input title="File 2" type=text size="44" name="file_2" value="{file_2}"/></div>

<div class="rowAB"><span class="colA">File 3</span><span class="colB">
<input title="File 3" type=text size="44" name="file_3" value="{file_3}"/></div>

</form>
HTML;
//////////////////////////////////////

//////////////////////////////////////
// template 2 options
// template 3 (addlist)
$template2 = <<<HTML
<div class="rowAB"><span class="colA">Options</span><span class="colB">
<input type=checkbox name="FEATURE" value=""/> feature &nbsp;&nbsp;&nbsp; 
<input title="Sort order" type=text size="5" name="SORT" value=""/> sort &nbsp;&nbsp;&nbsp; 
<input title="Parent" type=text size="2" name="PARENT" value=""/> parent &nbsp;&nbsp;&nbsp; 
</span></div>

<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<input type=checkbox name="INVISIBLE" value=""/> archive &nbsp;&nbsp;&nbsp; 
<input title="Relation" type=text size="2" name="REL_1" value=""/> relation
</span></div>

<div class="rowAB"><span class="colA">Title</span><span class="colB">
<input title="Headline" type=text size="44" name="title" class="titlefield" value=""/></span></div>

<div class="rowAB"><span class="colA">Text 1</span><span class="colB">
<textarea name="text_1" cols="49" rows="10"></textarea>
</span></div>

<div class="rowAB"><span class="colA">Text 2</span><span class="colB">
<textarea name="text_2" cols="49" rows="10"></textarea>
</span></div>

<div class="rowAB"><span class="colA">Text 3</span><span class="colB">
<textarea title="Infotext" name="text_3" cols="49" rows="3"></textarea>
</span></div>

<div class="rowAB"><span class="colA">ISBN</span><span class="colB">
<input title="Article number" type=text size="44" name="ARTNR" value=""/></span></div>

<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<div title="Add an image (optional)" class="buttinleft" href="#" onclick="window.open('images.php?action=quick&area=image_1&editor=info&pre_cell=image_1_cell', '_Addimage', 'HEIGHT=500,resizable=yes,scrollbars=yes,WIDTH=390');MM_showHideLayers('captinstr','','show','captfield','','show');return false;">Insert Image</div>
<a title="Publish changes" class="buttinright" href="#" onclick="document.insert.submit();">Save changes</a>
<input type="hidden" name="action" value="insert"/>
<input type="hidden" name="key" value="42"/>
</span></div>

<div class="rowAB"><span class="colA">&nbsp;</span><span class="colB">
<div title="Remove the image" class="buttinleft" href="#" onclick="document.addnews.image_1.value='';document.image_1_cell.src='skins/images/blank.gif'">Remove Image</div>
<div title="If you DELETE this article it can NOT be recovered!" class="buttinright" href="javascript:confirmDelete('index.php?mod=editnews&action=doeditnews&source=&ifdelete=yes&id=1102899981')">Delete article</div>
</span></div>

<div class="rowAB"><span class="colA">File 1</span><span class="colB">
<input title="File 1" type=text size="44" name="file_1" value=""/></div>

<div class="rowAB"><span class="colA">File 2</span><span class="colB">
<input title="File 2" type=text size="44" name="file_2" value=""/></div>

<div class="rowAB"><span class="colA">File 3</span><span class="colB">
<input title="File 3" type=text size="44" name="file_3" value=""/></div>
HTML;
//////////////////////////////////////

$template3 = $template1;
$template4 = $template1;
$template5 = $template1;
$template6 = $template1;
$template7 = $template1;
$template8 = $template1;
$template9 = $template1;
$template10 = $template1;
$template11 = $template1;
$template12 = $template1;
$template13 = $template1;
$template14 = $template1;
$template15 = $template1;
?>