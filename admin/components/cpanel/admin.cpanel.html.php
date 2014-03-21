
<link rel="stylesheet" type="text/css" href="templates/joomlaCMS/css/cpanel.css" />
<script type="text/javascript" src="templates/joomlaCMS/js/mootools/mootools.js"></script>
<script type="text/javascript" src="templates/joomlaCMS/js/accordion.js"></script>
<table class="adminform">
	<tr>
		<!-- cpanle left -->
		<td width="55%" valign="top">
			<div id="cpanel">
				<div class="float_left"><div class="icon"><a href="index.php?option=articles&task=add"><img alt="Add New Article" src="templates/joomlaCMS/images/header/icon-48-article-add.png" /><span>Add New Article</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=articles"><img alt="Article Manager" src="templates/joomlaCMS/images/header/icon-48-article.png" /><span>Article Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=menutypes"><img alt="Menu Manager" src="templates/joomlaCMS/images/header/icon-48-menumgr.png" /><span>Menu Manager</span></a></div></div>
                <div class="float_left"><div class="icon"><a href="index.php?option=sections"><img alt="Section Manager" src="templates/joomlaCMS/images/header/icon-48-sections.png" /><span>Section Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=categories"><img alt="Category Manager" src="templates/joomlaCMS/images/header/icon-48-category.png" /><span>Category Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=modules"><img alt="Module Manager" src="templates/joomlaCMS/images/header/icon-48-module.png" /><span>Module Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=templates"><img alt="Template Manager" src="templates/joomlaCMS/images/header/icon-48-template.png" /><span>Template Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=products"><img alt="Product Manager" src="templates/joomlaCMS/images/header/icon-48-product.png" /><span>Product Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=users"><img alt="User Manager" src="templates/joomlaCMS/images/header/icon-48-user.png" /><span>User Manager</span></a></div></div>
				<div class="float_left"><div class="icon"><a href="index.php?option=config"><img alt="Global Cofiguration" src="templates/joomlaCMS/images/header/icon-48-config.png" /><span>Global Configuration</span></a></div></div>
			</div>
		</td>
		<!-- cpanle right-accordion -->
		<td width="45%" valign="top">
			<div id="content-pane" class="pane-sliders">
				<div class="panel">
					<h3 id="cpanel-panel-popular" class="title jpane-toggler"><span>Product Published</span></h3>
					<div class="jpane-slider content" style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;">
						<table class="adminlist">
							<tbody>
							<tr>
								<td class="title"><strong>Title</strong></td>
								<td class="title"><strong>Price</strong></td>
								<td class="title"><strong>Manufacturer</strong>
                                <td class="title"><strong>Quantity</strong>
							</tr>
                            <?php 
                            $products = getPopularProduct();
                            foreach($products AS $product){ 
                                echo '<tr>';
                                echo '<td><font color="blue">'.$product->title.'</font></td>';
                                echo '<td><font color="gray">'.$product->price.'</font></td>';
                                echo '<td><font color="gray">'.$product->name.'</font></td>';
                                echo '<td><font color="gray">'.$product->quantity.'</font></td>';
                                echo '</tr>';
                            }
                            ?>
							</tbody>
						</table>
					</div>
				</div><!-- end panel -->
                <div class="panel">
					<h3 id="cpanel-panel-popular" class="title jpane-toggler"><span>Popular Article</span></h3>
					<div class="jpane-slider content" style="padding-top: 0px; border-top: medium none; padding-bottom: 0px; border-bottom: medium none; overflow: hidden; height: 0px;">
						<table class="adminlist">
							<tbody>
							<tr>
								<td class="title"><strong>Most Popular Articles</strong></td>
                                <td class="title"><strong>Category</strong></td>
								<td class="title"><strong>Created</strong></td>
								<td class="title"><strong>Hits</strong>
							</tr>
								
                            <?php 
                            $articles = getPopularArticle();
                            foreach($articles AS $article){ 
                                echo '<tr>';
                                echo '<td><font color="blue">'.$article->atitle.'</font></td>';
                                echo '<td><font color="gray">'.$article->ctitle.'</font></td>';
                                echo '<td><font color="gray">'.$article->created.'</font></td>';
                                echo '<td><font color="gray">'.$article->hits.'</font></td>';
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

