amStock chart v 1.0.1.0
***************************************************************************************
Check documentation for help on all topics:
http://www.amcharts.com/docs/

Incase you don't find something, post your questions to support forum:
http://www.amcharts.com/forum/
***************************************************************************************
1.0.2.3
Bug fix: the first <letter> from <number_format> was ignored. Fixed.

***************************************************************************************
1.0.2.2
Bug fix: Events became visible only after scrolling or change of interval. Fixed.

***************************************************************************************
1.0.2.1
Feature added:
When comparing the graphs, you could set that the graph's values must be recalculated
to percents. With a new setting, <recalculate_from_start>, you can set that the first 
value of a graph would be used as "base" value for the recalculation. Previously only
the first value of a selected period could be used.  

Improvement: Now, if the data source doesn't have column which should be used as 
graph's <close> data source, the graph will not have legend entry in the legend. The
same is with comparing graphs - if the selected for comparing data set doesn't have
the column which must be used for comparing graph, This data set will not have entry
in the legend.

Bug fix: <digits_after_decimal><data> setting only added required number of zeros, 
not rounded the numbers when the data was grouped to a longer periods. 

Bug fix: If the chart had graphs both on left and right axes and also had events,
the events were displayed for two times instead of one.

***************************************************************************************
1.0.2.0

Feature added:
Smoothed lines feature added. Set <smoothed>true</smoothed> in graph's settings to 
make lines smooth.

"%" is added to Y axis values when charts are compared.

Bug fix: when <equal_spacing> was set to "false" and there were multiple graphs with
type "column", the columns were displaced incorrectly.

***************************************************************************************
1.0.1.1

Bug fixes:
When the <equal_spacing> was set to false, amGetZoom returned wrong "to" value.

JS functions: amRolledOver, amClickedOn, amRolledOverEvent and amClickedOnEvent
Used not to return chart_id variable. This is fixed now. Note, if you were using these 
functions before, you should add chart_id variable in front of the others, otherwise your
script will not work. 

Features added:

New javascript function setSettings(settings, rebuild) allows you to set 
multiple settings at once.

You can get chart settings using getSettings() JavaScript function.

When the chart finishes exporting it to the image, amReturnImageData(chart_id, data)
function is called.

***************************************************************************************

1.0.1.0

features added:

* graphs, also comparing graphs can be dashed
* new legend key type - "line"
* names of weekdays can be displayed in the legend
* scrollers selected graph fill color can be defined separately from the graph color
* uncompareAll() JS function added - deselects all data sets selected for comparing

bugs fixed:

* if user rolled over the event bullet many times, the chart slowed down
* date input field width was not adjusting if the dates used longer format
* "to" in the custom period field now shows the last available date of the period

***************************************************************************************
1.0.0.3
* bug fix: period selector "from" field didn't accept text color
* bug fix: x axis values didn't accept text color and size
***************************************************************************************
1.0.0.2
* {average} and {sum} in the legend now displayes average and sum of a selected period
* Fixed bug with showAll() JavaScript function
* setZoom() JavaScript function now also deselects the period button
* if no data was found in the data file, "no_data" error message is displayed
***************************************************************************************
1.0.0.1
* Fixed a bug with events
***************************************************************************************