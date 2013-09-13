<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr" dir="ltr">

<head>
<title>Calendrier</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <script src="../js/calendar.js" type="text/javascript" language="javascript"></script>  
<script language="JavaScript" type="text/javascript">
<!--
    /* added 2004-06-10 by Michael Keck
     *       we need this for Backwards-Compatibility and resolving problems
     *       with non DOM browsers, which may have problems with css 2 (like NC 4)
    */
    var isDOM      = (typeof(document.getElementsByTagName) != 'undefined'
                      && typeof(document.createElement) != 'undefined')
                   ? 1 : 0;
    var isIE4      = (typeof(document.all) != 'undefined'
                      && parseInt(navigator.appVersion) >= 4)
                   ? 1 : 0;
    var isNS4      = (typeof(document.layers) != 'undefined')
                   ? 1 : 0;
    var capable    = (isDOM || isIE4 || isNS4)
                   ? 1 : 0;
    // Uggly fix for Opera and Konqueror 2.2 that are half DOM compliant
    if (capable) {
        if (typeof(window.opera) != 'undefined') {
            var browserName = ' ' + navigator.userAgent.toLowerCase();
            if ((browserName.indexOf('konqueror 7') == 0)) {
                capable = 0;
            }
        } else if (typeof(navigator.userAgent) != 'undefined') {
            var browserName = ' ' + navigator.userAgent.toLowerCase();
            if ((browserName.indexOf('konqueror') > 0) && (browserName.indexOf('konqueror/3') == 0)) {
                capable = 0;
            }
        } // end if... else if...
    } // end if
    document.writeln('<link rel="stylesheet" type="text/css" href="./css/phpmyadmin.css.php?lang=fr-utf-8&amp;js_frame=right&amp;js_isDOM=' + isDOM + '" />');
//-->
</script>
<noscript>
    <link rel="stylesheet" type="text/css" href="./css/phpmyadmin.css.php?lang=fr-utf-8&amp;js_frame=right" />
</noscript>
<script type="text/javascript" src="./libraries/tbl_change.js"></script>
<script type="text/javascript">
<!--
var month_names = new Array("Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre");
var day_names = new Array("Dimanche","Lundi","Mardi","Mercredi","Jeudi","Vendredi","Samedi");
//-->
</script>
</head>

<body onload="initCalendar();">
<div id="calendar_data"></div>
<div id="clock_data"></div>
</body>
</html>
