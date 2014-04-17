
<link rel="stylesheet" type="text/css" href="templates/joomlaCMS/css/cpanel.css" />
<script type="text/javascript" src="templates/joomlaCMS/js/mootools/mootools.js"></script>
<script type="text/javascript" src="templates/joomlaCMS/js/accordion.js"></script>
<table class="adminform">
	<tr>
		<!-- cpanle left -->
		<td width="55%" valign="top">
			<div id="cpanel">
				<div class="float_left"><div class="icon"><a href="index.php?option=reading"><img alt="Add New Article" src="templates/joomlaCMS/images/header/icon-48-article-add.png" /><span>Reading</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=listening"><img alt="Article Manager" src="templates/joomlaCMS/images/header/icon-48-listening.png" /><span>Listening</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=vocabulary"><img alt="Menu Manager" src="templates/joomlaCMS/images/header/icon-48-vocabulary.png" /><span>Vocabulary</span></a></div></div>
                <div class="float_left"><div class="icon"><a href="index.php?option=lesson"><img alt="Section Manager" src="templates/joomlaCMS/images/header/icon-48-lesson.png" /><span>Lesson Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=testtype"><img alt="Category Manager" src="templates/joomlaCMS/images/header/icon-48-test.png" /><span>Test Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=kanji"><img alt="Module Manager" src="templates/joomlaCMS/images/header/icon-48-kanji.png" /><span>Kanji</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=grammar"><img alt="Template Manager" src="templates/joomlaCMS/images/header/icon-48-grammar.png" /><span>Grammar</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=question"><img alt="Product Manager" src="templates/joomlaCMS/images/header/icon-48-question.png" /><span>Question</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=users"><img alt="User Manager" src="templates/joomlaCMS/images/header/icon-48-user.png" /><span>User Manager</span></a></div></div>
			</div>
		</td>
		<!-- cpanle right-accordion -->
		<td width="45%" valign="top">
			<div id="content-pane" class="pane-sliders">
				<div class="panel">
					<h3 id="cpanel-panel-popular" class="title jpane-toggler"><span>The last reading</span></h3>
					<div class="jpane-slider content" style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;">
						<table class="adminlist">
							<tbody>
							<tr>
								<td class="title"><strong>Title</strong></td>
								<td class="title"><strong>Lesson</strong></td>
							</tr>
                            <?php 
                            $reading = getLastReading();
                            foreach($reading AS $r){ 
                                echo '<tr>';
                                echo '<td><font color="blue">'.$r->r_title.'</font></td>';
                                echo '<td><font color="gray">'.$r->le_title.'</font></td>';
                                echo '</tr>';
                            }
                            ?>
							</tbody>
						</table>
					</div>
				</div><!-- end panel -->
				
                <div class="panel">
					<h3 id="cpanel-panel-popular" class="title jpane-toggler"><span>The last Listening</span></h3>
					<div class="jpane-slider content" style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;">
						<table class="adminlist">
							<tbody>
							<tr>
								<td class="title"><strong>Title</strong></td>
								<td class="title"><strong>Lesson</strong></td>
							</tr>
                            <?php 
                            $listening = getLastListening();
                            foreach($listening AS $l){ 
                                echo '<tr>';
                                echo '<td><font color="blue">'.$l->li_title.'</font></td>';
                                echo '<td><font color="gray">'.$l->le_title.'</font></td>';
                                echo '</tr>';
                            }
                            ?>
							</tbody>
						</table>
					</div>
				</div><!-- end panel -->
				
				<div class="panel">
					<h3 id="cpanel-panel-popular" class="title jpane-toggler"><span>The last Kanji</span></h3>
					<div class="jpane-slider content" style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;">
						<table class="adminlist">
							<tbody>
							<tr>
								<td class="title"><strong>Kanji</strong></td>
								<td class="title"><strong>Mean Kanji</strong></td>
								<td class="title"><strong>Mean En</strong></td>
								<td class="title"><strong>Mean Vi</strong></td>
							</tr>
                            <?php 
                            $kanji = getLastKanji();
                            foreach($kanji AS $k){ 
                                echo '<tr>';
                                echo '<td><font color="blue">'.$k->k_kanji.'</font></td>';
                                echo '<td><font color="blue">'.$k->k_mean_kanji.'</font></td>';
                                echo '<td><font color="blue">'.$k->k_mean_en.'</font></td>';
                                echo '<td><font color="blue">'.$k->k_mean_vi.'</font></td>';
                                
                                echo '</tr>';
                            }
                            ?>
							</tbody>
						</table>
					</div>
				</div><!-- end panel -->
				
			</div><!-- end content-pane -->
		</td>
	</tr>
</table>

