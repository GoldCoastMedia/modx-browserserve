BrowserServe Snippet for MODx Revolution
=========================================
*Authors: Dan Gibbs, Gold Coast Media Ltd*

BrowserServe is a MODx snippet that allows you to add CSS, JavaScript or run a
snippet for different browsers. It loosely matches User Agent strings  allowing
it to be flexible and match any web browser.

It was originally made to serve separate stylesheets to certain versions of
Internet Explorer but it can be used for anything.

Installation
-----------
Please download and install via the MODx Revolution Package Manager.

Examples
-------
**Insert a stylesheet for IE7**

```	[[!BrowserServe? &userAgent=`MSIE 7` &insertCSS=`ie7.css`]]```

**Display a message (chunk) for IE6 users**

```	[[!BrowserServe? &userAgent=`MSIE 6` &tpl=`noie6-chunk`]]```

**Insert JavaScript file for all non-Opera browsers**

```	[[!BrowserServe? &userAgent=`Opera` &matchType=`0` &insertJS=`non-opera-script.js`]]```

Documentation
------------
Full detailed documentation available at:
http://www.goldcoastmedia.co.uk/tools/browser-serve/
