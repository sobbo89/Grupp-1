amxy version 1.6.0.0
********************************************************************************
Check documentation for help on all topics:
http://www.amcharts.com/docs/

Incase you don't find something, post your questions to support forum:
http://www.amcharts.com/forum/


*** CHANGE LOG *****************************************************************
*** 1.6.0.1 ********************************************************************

BUG FIX: problem with reversed axes fixed

*** 1.6.0.0 ********************************************************************

FEATURE ADDED: ZOOMING and SCROLLING

The chart has zoom and scroll (on both axes) now!
The scroller is controlled in the <zoom> section. Settings for this section:

  <zoom>
    <enabled></enabled>                         
    <max_factor></max_factor>                   
    <border_color></border_color>               
    <border_alpha></border_alpha>               
    <bg_color></bg_color>                       
    <bg_alpha></bg_alpha>
    <target></target>  
  </zoom>
  
Scrollers, which appear when the chart is zoomed, are controlled here:

  <scroller>
    <enabled></enabled>  
    <color></color>      
    <alpha></alpha>      
    <bg_color></bg_color>
    <bg_alpha></bg_alpha>
    <height></height>    
  </scroller>  

Atention! It is strongly not recommended to use dashed gridlines if the zoom is
turned on. This might cause your script run slowly or even stop the script.  

  
FEATURE ADDED: HELP
You can display help icon and text, like in line chart (you can explain for the
users how zooming works). Help settings:

  <help>                                   
    <button>                             
      <x></x>                            
      <y></y>                            
      <color></color>                    
      <alpha></alpha>                    
      <text_color></text_color>          
      <text_color_hover></text_color_hover>    
      <text_size></text_size>              
      <text></text>                                                         
    </button>    
    <balloon>                              
      <color></color>                      
      <alpha></alpha>                      
      <width></width>               
      <text_color></text_color>     
      <text_size></text_size>       
      <text><![CDATA[]]></text>
    </balloon>    
  </help>   
  
FEATURE ADDED: MORE SETTINGS FOR THE BALLOON

New balloon settings allows you to have balloon border and rounded corners:

   <balloon>
     <corner_radius></corner_radius>
     <border_width></border_width>  
     <border_alpha></border_alpha>  
     <border_color></border_color>      
   </balloon> 

FEATURE ADDED: ANIMATED BULLETS (BUBBLES)

You can animate bubbles using 3 different effects. Animation can be sequenced. 
This is controlled in a new group of settings:

  <bullets>
    <hover_brightness></hover_brightness>                  
    <grow_time></grow_time>                                
    <sequenced_grow></sequenced_grow>                        
    <grow_effect></grow_effect>                               
  </bullets>  

FEATURE ADDED: AUTO-FITTING OF THE LEGEND and X AXIS VALUES

The legend now automatically adjusts bottom margin to fit to the flash object's 
area. If your X axis values are rotated, the legend position is adjusted not to
overlap the values. In order this to work, you have to leave <legend><y> setting
empty.


FEATURE ADDED: NEW BULLET TYPES

New bullet types are: bubble (3D circle), square_outline, round_outline, x, 
romb, triangle_up, triangle_down


FEATURE ADDED: POSSIBILITY TO SET ARRAY OF COLORS

Using <colors></colors> setting, you can set an array fo colors, which will
be used if the graph's color is not set.


FEATURE ADDED: CHANGE MULTIPLE SETTINGS WITH JAVASCRIPT

Using new function, flashMovie.setSettings(settings, rebuild) You can control
multiple settings.  It is recommended to use this new function even for one 
setting, instead of setParam() function. The "rebuild" option might be "true" 
or "false" (the default is "true"). If you set it to "false", then the settings
will not be applied until you call another new JS function: flashMovie.rebuild()
or pass another set of settings with the "rebuild" set to "true". 

A new function flashMovie.getSettings() will return the full settings 
XML by calling amReturnSettings(chart_id, settings) function. 


FEATURE ADDED: IMAGE DATA IS PASSED TO JAVASCRIPT

When exporting chart as an image, the chart passes image data to JavaScript 
function: amReturnImageData(chart_id, data) 


FEATURE ADDED: FONT COLOR AND SIZE OF A LABEL TEXT

<labels> Can accept  font color and font size HTML tags now, for example:
<text><![CDATA[Source: <font color="#CC0000" size="14">amCharts</font>]]></text>

CHANGE OF THE DEFAULT SETTINGS:
<context_menu><default_items><zoom> default value was changed to "false"


FIXES:

When adding some settings using additional_chart_settings variable, you don't 
need to set all the <graph> or <label> settings anymore. When 
changing some <label> property using additional_chart_settings, in order to
identify <label>, the labels id (lid) must be added, for example: <label lid="0">



********************************************************************************
1.5.2.0

New features:

JavaScript function amError(error_message) is called when one of the known
errors occurs.



********************************************************************************
1.5.1.0

New feature: the area between every second axis grid can be filled with
color. The color is defined at: <grid><y><fill_color>. Fill alpha can be
defined at <grid><y><fill_alpha>

Bug fix: When reloading settings with reloadSettings() function, if settings
file contained data, the data wasn't refreshed. This is fixed in this version.



********************************************************************************