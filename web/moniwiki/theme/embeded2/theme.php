<?php
$css_friendly=1;
$_sidebar=0;
$_topbanner=0;
$_topicon=0;
$_logo=0;
$imgdir=$themeurl."/imgs";
$icon['edit']="<img src='$imgdir/edit.png' alt='e' style='vertical-align:middle;border:0px' />";
$icon['info']="<img src='$imgdir/info.png' alt='i' style='vertical-align:middle;border:0px' />";
$icon['home']="<img src='$imgdir/home.png' alt='h' style='vertical-align:middle;border:0px' />";

$icons['edit']= array("","?action=edit",$icon['edit'],"accesskey='e'");
$icons['info']= array("","?action=info",$icon['info'],"accesskey='i'");
$icons['home']= array("FrontPage","?action=show",$icon['home'],"accesskey='h'");
/*
   'diff'=>array("","?action=diff",$icon['diff'],"accesskey='c'"),
   'show'=>array("","",$icon['show']),
   'find'=>array("FindPage","",$icon['find']),
   'info'=>array("","?action=info",$icon['info']),
   #'subscribe'=>array("","?action=subscribe",$icon['mailto']),
   #'scrap'=>array("","?action=scrap",$icon['bookmark']),
   'help'=>array("HelpContents","",$icon['help']),
   'print'=>array("","?action=print",$icon['print']),
*/
