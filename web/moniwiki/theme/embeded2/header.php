<?php
# MoniWiki Theme by wkpark at kldp.org
# $Id: header.php,v 1.9 2007/11/20 09:02:58 wkpark Exp $
#
if ($this->_sidebar) {
  include_once("plugin/login.php");
  #include_once("plugin/RandomBanner.php");
  #include_once("plugin/Calendar.php");
  $login=macro_login($this);
}
if ($DBInfo->use_tagging) {
  include_once("plugin/Keywords.php");
}

# theme options
#$_theme['sidebar']=1;

if ($this->_width) {
  print <<<EOF
<style type='text/css'>
#mainBody { width:$this->_width;}
</style>
EOF;
}

global $group_id, $nforge_url_prefix;

site_project_header(array('nodoctype'=>true,'toptab'=>'Wiki', 'group'=>$group_id, 'url_prefix'=>$nforge_url_prefix, 'top_kind' => 'custom_css'));
if ($options['css_url'])
print '  <link rel="stylesheet" type="text/css" '.$media.' href="'.
  $options['css_url'].'" />';

?>
<div id='project_content'>
<!-- div class="sub_title mb">
	<h3><?php echo html_images("h3_wiki.gif", 34, 19, array("alt"=>"위키"),"위키"); ?></h3>
</div -->

<!--
<div id='topBanner'>
<img src="<?php echo $this->themeurl?>/imgs/kldpwikilogo.png"/>
</div>
-->
<?php if ($this->_topicon): ?>
<div id='topIcon'>
<a href='?action=edit'><img src='<?php echo $this->themeurl?>/imgs/record.png' alt='*' style='border:0' /></a>
<a href='?action=new'><img src='<?php echo $this->themeurl?>/imgs/add.png' alt='+' style='border:0' /></a>
<a href='?action=subscribe'><img src='<?php echo $this->themeurl?>/imgs/favorite.png' alt='#' style='border:0' /></a>
<a href='?action=rss_rc'><img src='<?php echo $this->themeurl?>/imgs/rss.png' alt='.)' style='border:0' /></a>
</div>
<?php endif;?>
<div class='pBodyRight'><div class='pBodyLeft'>
<div id='pTopRight'><div id='pTopLeft'>
</div></div>
</div></div>
<?php if ($this->_splash):?>
<div class='pBodyRight'><div class='pBodyLeft'>
 <div id='wikiSplash'>
 </div>
</div></div>
<?php endif; /* _splash */?>
<span class='clear' ><!-- for IE --></span>
<div class='pBodyRight'><div class='pBodyLeft'>
<div id='pBottomRight'><div id='pBottomLeft'>

<div id='wikiPage' style='text-align: left'>
<span class='clear'></span>
<?php if ($this->popup) :?>
&nbsp;<!-- oops!! firefox bug workaround :( -->
<?php else:?>
<div>
<ul class="wiki_menu">
<?php 
$menu_title = array('home'=>__t("Wiki"),
	'edit' => d__t('wiki',"Edit"),
	'diff' => d__t('wiki', "Diff"),
	'change' => d__t('wiki', "Changes"),
	'info' => d__t('wiki', "History"));
$this->icons['change']= array("RecentChanges","",$this->icon['show'],"accesskey='c'");
$count = count($menu_title);
$i = 1;
$class[] = 'first';
foreach ($menu_title as $key => $item) {
	if (array_key_exists($key, $this->icons)) {
		$item = $this->icons[$key];
		if ($key == 'home' and empty($options['action']) and $options['page'] != 'RecentChanges') {
			$class[] = 'on';
		} else if (isset($options['action'])) {
			if ($options['action'] == $key)
				$class[] = 'on';
			else if ($key == 'home' and $options['action'] == 'show')
				$class[] = 'on';
		} else if ($key == 'change' and isset($options['page']) and $options['page'] == 'RecentChanges') {
			$class[] = 'on';
		}
		$cls = '';
		if (!empty($class))
			$cls = ' class="'.join(' ',$class).'"';
		echo "<li$cls><span>".$item[2].$this->link_tag($item[0],$item[1],$menu_title[$key])."</span></li>\n";
		$class = array();
	}
	$i++;
}
global $Language;
?>
<li class='last'><span><a href='?action=rss_rc'><img src='<?php echo $this->themeurl?>/imgs/rss.png' alt='.)' style='border:0;opacity:1.0;filter:alpha(opacity=100)' /></a></span></li>
</ul>
</div>
<div id='wikiContainer'>
<div id='pTitle'>
<?php if (!$this->_topbanner and $this->_logo): ?>
<img src='<?php echo $DBInfo->logo_img?>' style='text-align:left;' alt='moniwiki' />
<?php endif; /* topbanner */?>
<?php echo $title?></div>
<span class='clear'></span>
<?php endif; /* popup */?>
<?php echo $msg?>
<?php
# enable/disable sidebar
if ($this->_sidebar==1) :
?> <div id='wikiSideMenu'> <?php
if ($this->_login) print macro_login($this);
#print '<div class="calendar">';
#if ($options['id']=='Anonymous')
#  print macro_calendar($this,"'Blog',blog,noweek,archive,center",'Blog');
#else
#  print macro_calendar($this,"'$options[id]',blog,noweek,archive,center",$options['id']);
#print '</div>';
#print '<div class="randomQuote">';
#print macro_RandomQuote($this);
#print '</div>';
print '<div class="randomPage">';
print macro_RandomPage($this,"4,simple");
print '</div>';
if ($DBInfo->use_tagging) {
  print "<div>";
  print macro_Keywords($this,"all,tour,limit=15");
  print "</div>";
}
?>
</div>
<?php
endif;

?>
<div id='mycontent'>
