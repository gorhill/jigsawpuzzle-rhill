<?php
include_once 'dbconfig.php';
$dbAvailable = (mysql_connect($DB_HOST, $DB_USER, $DB_PASSWORD) && mysql_select_db($DB_NAME));
?><!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en"><head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"/>
<title>Jigsaw Puzzle by Raymond Hill: An HTML5 &lt;canvas&gt;-based jigsaw puzzle</title>
<meta name="Keywords" lang="en" content="HTML5, &lt;canvas&gt;, jigsaw, puzzle, javascript, raymond hill"/>
<?php
// Parse gadget URL and emit <script src=...</script> statements into the HTML output. 
// The <script src=...</script> statements will load the libraries passed in via the URL.
if ( isset($_REQUEST["libs"]) ) {
	$libraries = split(",", $_GET["libs"]);
	foreach ($libraries as $script) {
		if (preg_match('@^[a-z0-9/._-]+$@i', $script) && !preg_match('@([.][.])|([.]/)|(//)@', $script)) {
		    print "<script src='http://www.google.com/ig/f/{$script}'></script>\n";
			}
		} 
	}
?>
<script type="text/javascript" src="jigsawpuzzle-rhill.js"></script>
<script type="text/javascript">
<!--
function initAll(){
	var tabs=["Solve","Presets","Create","Share","OpenSocial","About"];
	self.puzzleGadgetTabs=new self.gadgets.TabSet("Solve");
	for (var i in tabs) {
		var id=tabs[i];
		self.puzzleGadgetTabs.addTab(id,{contentContainer:self.document.getElementById("puzzleTab"+id)});
		}
<?php
	$view = '"full"';
	$source = 'null';
	$bedWidth = 'null';
	$bedHeight = 'null';
	if ( isset($_REQUEST['view']) && $_REQUEST['view'] != 'canvas' ) {
		$view = '"mini"';
		$bedWidth = 'w';
		$bedHeight = 'h';
		if ( $dbAvailable &&
		     ($result = mysql_query("select * from jigsawpuzzles order by date_added desc limit 1")) &&
		     ($row = mysql_fetch_assoc($result)) ) {
			$source = '"/puzzle-rhill/' . $row['url_image'] . '"';
			}
?>
		var w=200; var h=150;
		var o=self.document.getElementById('puzzleRoot');
		if (o && o.offsetWidth) {
			w=o.offsetWidth;
			h=self.Math.round(w*0.75);
			w=self.Math.min(w,640);
			h=self.Math.min(h,427);
			gadgets.window.adjustHeight(h);
			}
<?php
		}
?>
	var options = {
		<?php if ( !empty($_REQUEST['puzzleKey']) ) { echo 'key:"', str_replace(' ','+',$_REQUEST['puzzleKey']), '",'; } ?>
		view:<?= $view ?>,
		src:<?= $source ?>,
		bedWidth:<?= $bedWidth ?>,
		bedHeight:<?= $bedHeight ?>
		};
	new Puzzle("puzzleParent",options);
	}
self.gadgets.util.registerOnLoadHandler(initAll);
// -->
</script>
<style type="text/css">
a {text-decoration:none;}
a:hover {text-decoration:underline;}
body {font-family:tahoma,verdana,arial;font-size:13px;margin:4px;padding:0;border:0}
table {margin:0;padding:0;border:0;}
tr {padding:0;border:0;}
td {padding:0;border:0;vertical-align:top;}
.divinfo {width:800px;margin-top:0;margin-bottom:1em;padding:0.5em;border:1px solid #ccc;}
div.tabHeaderOff,div.tabHeaderOn {display:inline;padding:6px;margin:0;border-left:1px solid #888;border-top:1px solid #aaa;border-right:1px solid #aaa;cursor:pointer;}
div.tabHeaderOff {border-bottom:1px solid #888;background-color:#ccc;color:#666;}
div.tabHeaderOn {border-bottom:1px solid #fff;background-color:#fff;color:#000;}
td.preset {padding:2px 4px 2px 4px;}
img:hover {border:1px solid #ccc;border-right-color:#888;border-bottom-color:#888;}
</style>
</head>
<body id="puzzleRoot">
<div id="tabHeaderContainer" style="border:0;padding:0.5em;"><div id="puzzleTabHeaderSolve" class="tabHeaderOn">Solve</div><div id="puzzleTabHeaderPresets" class="tabHeaderOff">Presets</div><div id="puzzleTabHeaderCreate" class="tabHeaderOff">Create</div><div id="puzzleTabHeaderShare" class="tabHeaderOff">Share</div><div id="puzzleTabHeaderOpenSocial" class="tabHeaderOff">OpenSocial</div><div id="puzzleTabHeaderAbout" class="tabHeaderOff">About</div>
</div>

<div id="tabContentContainer" style="border:1px solid #888;padding:4px">

<div id="puzzleTabSolve" style="display:block;font-family:tahoma,sans-serif;font-size:12px">
<div style="padding:0.5em;">
<div id="puzzleParent" style="background-color:#fcc;color:black;">
<noscript>
<h3 style="margin-top:0.5em">Jigsaw Puzzle by <a href="/">Raymond Hill</a>: Using HTML5 &lt;canvas&gt;</h3>
<p>This page requires Javascript to display properly, however Javascript is disabled or your browser doesn't support Javascript.</p></noscript>
<canvas id="puzzleCanvas">
<p style="margin-bottom:0">This Jigsaw Puzzle game requires that your browser supports the <a target="_blank" href="http://en.wikipedia.org/wiki/Canvas_(HTML_element)">HTML5 &lt;canvas&gt; element</a>. See <a target="_blank" href="http://en.wikipedia.org/wiki/Canvas_(HTML_element)">Wikipedia</a> for information on which browsers support the <u>HTML5 &lt;canvas&gt;</u> technology. Google code offers <a href="http://code.google.com/p/explorercanvas/">ExplorerCanvas</a> to bring the functionality of the &lt;canvas&gt; tag to Internet Explorer, unfortunately, complex clipping regions are not supported, a requirement for this software.</p>
<p><img src="http://www.raymondhill.net/puzzle-rhill/jigsawpuzzle-rhill-gadget-snapshot.png" alt="Snapshot"/> <br/><small>Thumbnail preview</small></p>
</canvas>
</div>
<audio id="puzzleSnap1" autobuffer><source src="12842__schluppipuppie__klick_01.ogg" /><source src="12842__schluppipuppie__klick_01.wav" /></audio>
<audio id="puzzleSnap2" autobuffer><source src="12843__schluppipuppie__klick_02.ogg" /><source src="12843__schluppipuppie__klick_02.wav" /></audio>
<audio id="puzzleClap1"><source src="35102_m1rk0_applause_5sec.ogg" /><source src="35102_m1rk0_applause_5sec.mp3" /></audio>
<audio id="puzzleClap2"><source src="35104_m1rk0_applause_8sec.ogg" /><source src="35104_m1rk0_applause_8sec.mp3" /></audio>
<audio id="puzzleClap3"><source src="60789_J.Zazvurek_Applause_9s.ogg" /><source src="60789_J.Zazvurek_Applause_9s.mp3" /></audio>
<div style="margin-top:1em;">
<input id="puzzleShowEdges" style="width:12em;padding:3px;border:solid 1px #333;" type="button" value="Show edge pieces only" onclick="javascript:this.toggleEdges();"/>
<input id="puzzleShowPreview" style="width:12em;padding:3px;border:solid 1px #333;" type="button" value="Show preview" onclick="javascript:this.togglePreview();"/>
</div>
<div style="margin-top:1em;font-size:11px;color:#777">
How to play:
<ul style="margin-top:0;">
<li>Click on a piece to move it, click again to release it</li>
<li><b>Left</b> and <b>right</b> arrows (or alternatively <b>'A'</b> or <b>'D'</b>, or <b>mousewheel</b>) to rotate a piece</li>
<li><b>Up</b> and <b>down</b> arrows (or alternatively <b>'W'</b> or <b>'S'</b>) to send a piece behind or on top of other pieces</li>
<li><b>'E'</b> to toggle on/off visibility of non-edge pieces</li>
<li><b>'Q'</b> to show/hide preview tile</li>
<li><b>Space bar</b> to show/hide non-composite pieces (pieces made up of two or more atomic pieces)</li>
</ul>
</div>
</div>
</div>

<div id="puzzleTabPresets" style="display:none">
<?php
if ( isset($_COOKIE['jigsawpuzzle_rhill_prefs']) ) {
	$_COOKIE['jigsawpuzzle_rhill_prefs'] = str_replace('\"','"',$_COOKIE['jigsawpuzzle_rhill_prefs']);
	if ( $prefs = json_decode($_COOKIE['jigsawpuzzle_rhill_prefs'],true) ) {
		if ( !isset($prefs['size']) || !in_array($prefs['size'],array('h600','h768','h1024','h1050','h1200','h1600')) ||
		     !isset($prefs['numPieces']) || !in_array($prefs['numPieces'],array(500,300,200,100,50,25)) ) {
			unset($prefs);
			}
		}
	}
if ( empty($prefs) ) {
	$prefs = array('size'=>'h600','numPieces'=>25);
	}
?>Preferred screen size:&nbsp;<select id="puzzlePreferredSize">
<option value="h600"<?php echo $prefs['size'] == 'h600' ? ' selected="selected"' : ''; ?>>800&times;600</option>
<option value="h768"<?php echo $prefs['size'] == 'h768' ? ' selected="selected"' : ''; ?>>1024&times;768</option>
<option value="h1024"<?php echo $prefs['size'] == 'h1024' ? ' selected="selected"' : ''; ?>>1280&times;1024</option>
<option value="h1050"<?php echo $prefs['size'] == 'h1050' ? ' selected="selected"' : ''; ?>>1680&times;1050</option>
<option value="h1200"<?php echo $prefs['size'] == 'h1200' ? ' selected="selected"' : ''; ?>>1920&times;1200</option>
<option value="h1600"<?php echo $prefs['size'] == 'h1600' ? ' selected="selected"' : ''; ?>>2560&times;1600</option>
</select><br/>
Preferred number of pieces:&nbsp;<select id="puzzlePreferredNumPieces">
<option value="25"<?php echo $prefs['numPieces'] == 25 ? ' selected="selected"' : ''; ?>>25</option>
<option value="50"<?php echo $prefs['numPieces'] == 50 ? ' selected="selected"' : ''; ?>>50</option>
<option value="100"<?php echo $prefs['numPieces'] == 100 ? ' selected="selected"' : ''; ?>>100</option>
<option value="200"<?php echo $prefs['numPieces'] == 200 ? ' selected="selected"' : ''; ?>>200</option>
<option value="300"<?php echo $prefs['numPieces'] == 300 ? ' selected="selected"' : ''; ?>>300</option>
<option value="500"<?php echo $prefs['numPieces'] == 500 ? ' selected="selected"' : ''; ?>>500</option>
</select> <span style="color:#aaa;font-size:10px">A high number of pieces can cause a delay at creation time.</span><br/><br/>
Click on a thumbnail below to create a jigsaw puzzle with the above settings.
<hr style="background-color:#ccc;height:1px;border:0"/>
<?php
function generateKey($urlImage,$numPieces,$screenSize) {
	return str_replace(array('=','+','/'),array('','-','_'),base64_encode("{\"view\":\"full\",\"src\":\"{$urlImage}\",\"cut\":\"classic\",\"screenSize\":\"{$screenSize}\",\"numPieces\":$numPieces,\"complexity\":1,\"numRotateSteps\":24,\"showPreview\":false}"));
	}
if ( $dbAvailable ) {
	if ( $result = mysql_query("select * from jigsawpuzzles order by date_added desc") ) {
		while ( $row = mysql_fetch_assoc($result) ) {
?><span style="display:inline-block;width:250px;height:125px;vertical-align:top;margin:4px;padding:8px;font-size:11px;background-color:#eee">
<img style="border:1px solid #fff;cursor:pointer;" src="<?php echo '/puzzle-rhill/'.$row['url_thumbnail']; ?>" title="Solve this one..." alt="Solve this one..." /><br/>
<span style="color:gray">Title:</span> <span style="font-weight:bold">&ldquo;<?php echo htmlentities($row['title']); ?>&rdquo;</span> <a style="font-size:9px" href="<?php echo htmlentities($row['url_source']); ?>">(Source...)</a><br/>
<span style="color:gray">Author:</span> <a href="<?php echo htmlentities($row['url_author']); ?>"><?php echo htmlentities($row['author']); ?></a><br/>
<span style="color:gray">Source:</span> <a href="<?php echo htmlentities($row['url_site']); ?>"><?php echo htmlentities($row['site']); ?></a><br/>
<span style="color:gray">Added on:</span> <?php echo date('l, F j, Y',strtotime($row['date_added'])); ?></span><?php
			}
		}
	}
?>
</div>

<div id="puzzleTabCreate" style="display:none">
<table style="margin-top:1em;font-family:tahoma,sans-serif;font-size:12px">
<tr><td style="vertical-align:top">Cut&nbsp;</td><td style="vertical-align:top"><select id="puzzleCut"><option value="classic" selected="selected">Classic</option><option value="straight">Straight</option><option value="tenon">Tenon</option><option value="wave">Wave</option></select></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td style="white-space:nowrap;vertical-align:top">Screen size&nbsp;</td><td style="vertical-align:top"><select id="puzzleScreenSize"><option value="h600">800&times;600</option><option value="h768">1024&times;768</option><option value="h1024" selected="selected">1280&times;1024</option><option value="h1050">1680&times;1050</option><option value="h1200">1920&times;1200</option></select>
<span style="color:#888">(Screen size determine work area size, which determine puzzle size, which influence the size of individual pieces)</span></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td style="white-space:nowrap;vertical-align:top">Suggested number of pieces&nbsp;</td><td style="vertical-align:top"><input id="puzzlePieces" type="text" size="2" maxlength="3" value="16"/>
<span style="color:#888">(This number is used as a guide only, restrictions may apply. More pieces = smaller pieces)</span></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td style="white-space:nowrap;vertical-align:top">Complexity of puzzle pieces&nbsp;</td><td style="vertical-align:top"><select id="puzzleComplexity"><option value="0">Regular</option><option value="1" selected="selected">Slightly irregular</option><option value="3">Moderatly irregular</option><option value="8">Very irregular</option></select></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td style="white-space:nowrap;vertical-align:top">Whether pieces can be rotated&nbsp;</td><td style="vertical-align:top"><select id="puzzleRotate"><option value="1">No rotation</option><option value="4">Rotate 90&deg;</option><option value="24" selected="selected">Rotate fully</option></select></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td style="white-space:nowrap;vertical-align:top">URL of picture to use&nbsp;</td><td style="vertical-align:top"><input id="puzzleURL" type="text" size="80" maxlength="256" value=""/>
<span style="color:#888">(Of interest: <a target="_blank" href="http://en.wikipedia.org/wiki/Public_domain_image_resources#General_collections">general collections of public domain images</a>)</span></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td style="color:#f77;" colspan="2">Beware: Clicking on the &ldquo;Create&rdquo; button will cause the current jigsaw puzzle in the &ldquo;Solve&rdquo; tab to be replaced. Also, note that the more pieces there are, the longer it will take to generate the jigsaw puzzle, so you might experience a delay.</td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr><td style="white-space:nowrap;vertical-align:top"><input id="puzzleCreate" style="width:9em;padding:3px;border:solid 1px #333;" type="button" value="Create" onclick="javascript:this.createPuzzle();self.location.hash='#';"/></td></tr>
</table>
</div>

<div id="puzzleTabShare" style="display:none">
<div style="margin-top:1em;font-family:tahoma,sans-serif;font-size:12px">
<p>You can generate a <b>permalink</b> of the current state of your puzzle (progress included!):<br/>
<input id="puzzleGeneratePermalink" style="width:9em;padding:3px;border:solid 1px #333;" type="button" value="Create permalink" onclick="javascript:this.generatePuzzlePermalink();"/>&nbsp;<input id="puzzlePermalink" style="padding:3px;" type="text" size="100" readonly="readonly" value="" onclick="javascript:this.focus();this.select();"/></p>
<p style="display:none"><a id="puzzleEmailTo" href="mailto:?subject=Have%20fun%20with%20this%20jigsaw%20puzzle!&amp;body=<?php echo urlencode("http://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}"); ?>">Email this permalink to...</a></p>
<p>Alternatively, you can generate a <b>Jigsaw Puzzle Key</b> identifying uniquely the current state of your puzzle (progress included!):<br/>
<input id="puzzleGenerateKey" style="width:9em;padding:3px;border:solid 1px #333;" type="button" value="Generate key" onclick="javascript:this.generatePuzzleKey();"/>&nbsp;<input id="puzzleKeyOut" style="padding:3px;" type="text" size="100" readonly="readonly" value="" onclick="javascript:this.focus();this.select();"/><br/><span style="font-size:11px;color:#999">(Be sure to copy <b>all</b> the characters!)</span></p>
<p>You can save this key for later use, or you can send this key to a friend, who can then use it to generate the same puzzle on his side.</p>
<p>A friend sent you a <b>Jigsaw Puzzle Key</b>? Enter it here to generate his/her custom-made jigsaw puzzle in your &ldquo;Solve&rdquo; tab:<br/>
<input id="puzzleKeyInCreate" style="width:9em;padding:3px;border:solid 1px #333;" type="button" value="Create" onclick="javascript:this.createPuzzleFromKey();"/>&nbsp;<input id="puzzleKeyIn" style="padding:3px;" type="text" size="100" value=""/><br/><span style="font-size:11px;color:#999">(Be sure to paste <b>all</b> the characters!)</span></p>
<p style="white-space:nowrap;color:#f77;">Beware: Clicking on the &ldquo;Create&rdquo; button will cause the current jigsaw puzzle to be replaced (Your selected &ldquo;Screen size&rdquo; setting will be preserved though.)</p>
</div>
</div>

<div id="puzzleTabOpenSocial" style="display:none;">
<div style="margin-top:1em;font-family:tahoma,sans-serif;font-size:12px">
<p>This page has been made compatible with <a href="http://www.opensocial.org/">Open Social</a>, so that you can include it as a &ldquo;gadget&rdquo; (&ldquo;app&rdquo;, &ldquo;module&rdquo;) on your home page for the following web sites (so far):
<ul>
<li><a href="http://www.google.com/ig/adde?moduleurl=http://www.raymondhill.net/puzzle-rhill/jigsawpuzzle-rhill-gadget.xml"><img src="http://buttons.googlesyndication.com/fusion/add.gif" style="width:104px; height:17px;border:0px;" alt="Add to Google" /></a></li>
<li><a href="http://www.orkut.com/Main#Application.aspx?appId=988931191477" class="lf" title="ORKUT" target="blank">ORKUT</a></li>
</ul>
<p>I would like to implement a seemless way for people to share their custom-made jigsaw puzzle with their friend. I am looking into this, I am at the start of the learning curve for <a href="http://www.opensocial.org/">OpenSocial</a> stuff.</p>
</div>
</div>

<div id="puzzleTabAbout" style="display:none;">
<div style="margin-top:1em;font-family:tahoma,sans-serif;font-size:12px">
<p>Jigsaw Puzzle by <a href="/">Raymond Hill</a>: <a target="_top" href="http://www.raymondhill.net/puzzle-rhill/">Project's Home page</a></p>
<p>I started this project as an experiment with the <a href="http://en.wikipedia.org/wiki/Canvas_(HTML_element)">HTML5 canvas</a> element.
It grew a bit bigger than what I had imagined, as I kept adding features, just for the fun and challenge of dealing with geometrical concepts.
Also, for jigsaw puzzle fans out there, I am just happy to enable you to create your own puzzle, small or big, easy or hard, and with no strings attached (no ads, no questions asked, etc.)</p>
<p>I am currently working on the next release in which I would like to allow fancy tiling.</p>
<p>Portions of this software use the work of...</p>
<ul>
 <li style="margin-top:0.25em;">Images:<ul>
  <li><a target="_blank" href="http://www.publicdomainpictures.net/view-image.php?image=376">&ldquo;Autumn Fruits&rdquo;, by Petr Kratochvil</a>: The default picture used in preview mode.</li>
  <li><a target="_blank" href="http://www.publicdomainpictures.net/view-image.php?image=2876">&ldquo;Melbourne Australia&rdquo;, by Michael Stirling</a>: The default picture used in full mode.</li>
  </ul></li>
 <li style="margin-top:0.25em;">Sound effects:<ul style="margin-bottom:0.5em;">
  <li><a target="_blank" href="http://www.freesound.org/">The Freesound Project</a>'s <a target="_blank" href="http://www.freesound.org/samplesViewSingle.php?id=12842">&ldquo;klick - 01.wav&rdquo;</a>, by <a target="_blank" href="http://www.freesound.org/usersViewSingle.php?id=4942">Marcus Horndt</a></li>
  <li><a target="_blank" href="http://www.freesound.org/">The Freesound Project</a>'s <a target="_blank" href="http://www.freesound.org/samplesViewSingle.php?id=12843">&ldquo;klick - 02.wav&rdquo;</a>, by <a target="_blank" href="http://www.freesound.org/usersViewSingle.php?id=4942">Marcus Horndt</a></li>
  <li><a target="_blank" href="http://www.freesound.org/">The Freesound Project</a>'s <a target="_blank" href="http://www.freesound.org/samplesViewSingle.php?id=35102">&ldquo;applause_5sec.wav&rdquo;</a>, by <a target="_blank" href="http://www.freesound.org/usersViewSingle.php?id=140756">Mirko Horstmann</a></li>
  <li><a target="_blank" href="http://www.freesound.org/">The Freesound Project</a>'s <a target="_blank" href="http://www.freesound.org/samplesViewSingle.php?id=35104">&ldquo;applause_5sec.wav&rdquo;</a>, by <a target="_blank" href="http://www.freesound.org/usersViewSingle.php?id=140756">Mirko Horstmann</a></li>
  <li><a target="_blank" href="http://www.freesound.org/">The Freesound Project</a>'s <a target="_blank" href="http://www.freesound.org/samplesViewSingle.php?id=60789">&ldquo;Applause 9s.mp3&rdquo;</a>, by <a target="_blank" href="http://www.freesound.org/usersViewSingle.php?id=199526">J.Zazvurek</a></li>
  </ul></li>
 <li style="margin-top:0.25em;">Software:<ul>
  <li><a target="_blank" href="http://www.schillmania.com/projects/soundmanager2/">&ldquo;SoundManager 2&rdquo;, by Scott Schiller</a>: An excellent library that brings audio functionality to Javascript. <span style="color:#f77">No longer used in the latest version, HTML5 &lt;audio&gt; tag is now used.</span></li>
  <li><a target="_blank" href="http://local.wasp.uwa.edu.au/~pbourke/geometry/polyarea/">&ldquo;Calculating the area and centroid of a polygon&rdquo;, by Paul Bourke</a>: For his code snippets on how to calculate the centroid of a polygon (necessary to be able to rotate pieces properly.)</li>
  <li><a target="_blank" href="http://www.webtoolkit.info/javascript-base64.html">&ldquo;Javascript base64&rdquo;</a>: For the code snippet on how to encode/decode <a href="http://en.wikipedia.org/wiki/Base64">Base 64</a> (I used Base 64 to encode/decode Jigsaw Puzzle Keys, the current mechanism to share custom-made puzzles.</li>
  <li><a target="_blank" href="http://www.quirksmode.org/js/events_properties.html#position">&ldquo;Event properties / Mouse position&rdquo;, by Peter-Paul Koch</a>: For his code snippet on how to correctly detect mouse coordinates.</li>
  </ul></li>
 </ul>
<p><a href="http://www.raymondhill.net/" rel="cc:attributionURL">Jigsaw Puzzle by Raymond Hill</a> is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/ca/">Creative Commons Attribution-Noncommercial-Share Alike 2.5 Canada License</a>.
You are free to use or reuse all or portion of this work for non-commercial purpose as long as you link back to the <a href="http://www.raymondhill.net/">author's page</a>.
If you're planning to derive revenue from all or significant portion of this software (e.g., by running any advertisements on the page, selling anything, etc.), you'll need to ask the express permission of <a id="email" href="#">the author</a>.
<script type="text/javascript">
<!--
self.document.getElementById('email').href=('llihr-elzzuP wasgiJ=tcejbus?ten.llihdnomyar@llihr:otliam'.split('').reverse().join(''));
// -->
</script>
</p>
<p><a target="_blank" rel="license" href="http://creativecommons.org/licenses/by-nc-sa/2.5/ca/"><img alt="Creative Commons License" style="border-width:0" src="creativecommons-88x31.png" /></a></p>
</div>
</div>

</div>

</body>
</html>
