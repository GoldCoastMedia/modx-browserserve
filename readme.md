BrowserServe for MODX Revolution
=================================

BrowserServe is a MODX extension that allows you to add CSS or JavaScript
to MODX documents depending on the users web browser. You provide a string
to match and it will compare it to the visitors user agent making it very
flexible.

It was originally made to serve separate stylesheets to certain versions of
Internet Explorer but it can be used for any browsers / platforms.

## Installation

Please download and install via the MODX Revolution Package Manager under 
```System > Package Manager```.

## Examples

Insert a stylesheet for IE7

```
[[!BrowserServe? &useragent=`MSIE 7` &css=`ie7.css`]]
```

Display a message (chunk) for IE6 users

```
[[!BrowserServe? &useragent=`MSIE 6` &tpl=`noie6-chunk`]]
```

Insert JavaScript file for all non-Opera browsers

```
[[!BrowserServe? &useragent=`Opera` &matchtype=`0` &js=`non-opera-script.js`]]
```

## Documentation

Full detailed documentation available at:
http://www.goldcoastmedia.co.uk/tools/browser-serve/
