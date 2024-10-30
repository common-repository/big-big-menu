<div id="BigBigMenu" class="container clearfix">
	<div id="BigBigMenuMessage">blah blah blah</div>

	<div id="BigBigMenuAssembled" class="column clearfix">
		<div class="BigBigMenuConfirmSave" id="BigBigMenuConfirmSaveMenu">saved</div>
		<h3>Your Menu</h3>
		<div id="BigBigMenuSave"><input type="submit" name="submit" value="Save" id="BigBigMenuSaveButton" /></div>
		<div id="item_home" class="<?=($home?'yes':'')?>"><small class="type">Always First&hellip;</small> Home <a class="control toggle" href=""><?=($home?'Del':'Add')?></a></div>
		<ol id="BigBigMenuList" class="list sortable">
			<?php foreach ($menu as $item) : ?>
			<li id="item_<?=$item['slug']?>"><div><small class="type"><?=ucfirst($item['type'])?></small><br/><?=$item['display']?> <a class="control del" href="">Del</a></div></li>
			<?php endforeach; ?>
		</ol>
	</div>

	<div id="BigBigMenuParts" class="column clearfix">
		<h3>Tab Library</h3>
        <ul class="tabs hnav">
            <li><a href="#BigBigPageList"><span>Pages</span></a></li>
            <li><a href="#BigBigCategoryList"><span>Categories</span></a></li>
            <li><a href="#BigBigAuthorList"><span>Authors</span></a></li>
            <li><a href="#BigBigLinkList"><span>Links</span></a></li>
        </ul>
		<div class="tab-content clear" id="BigBigPageList">
			<ul class="list parts">
				<?php foreach ($pages as $page) : ?>
				<li id="item_page-<?=$page->ID?>"><div><small class="type">Page</small><br/><?=$page->post_title?> <a class="control add" href="">Add</a></div></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="tab-content clear" id="BigBigCategoryList">
			<ul class="list parts">
				<?php foreach ($categories as $category) : ?>
				<li id="item_category-<?=$category->cat_ID?>"><div><small class="type">Category</small><br/><?=$category->name?> <a class="control add" href="">Add</a></div></li>
				<?php endforeach; ?>
			</ul>
		</div>

		<div class="tab-content clear" id="BigBigAuthorList">
			<ul class="list parts">
				<?php foreach ($authors as $author) : ?>
				<li id="item_author-<?=$author->ID?>"><div><small class="type">Author</small><br/><?=$author->display_name?> <a class="control add" href="">Add</a></div></li>
				<?php endforeach; ?>
			</ul>
		</div>
		
		<div class="tab-content clear" id="BigBigLinkList">
			<ul class="list parts">
				<?php foreach ($links as $link) : ?>
				<li id="item_link-<?=$link->link_id?>"><div><small class="type">Link</small><br/><?=$link->link_name?> <a class="control add" href="">Add</a></div></li>
				<?php endforeach; ?>
			</ul>
		</div>
		
	</div>
	
	<div id="BigBigMenuOptions" class="column clearfix last">
		<div class="BigBigMenuConfirmSave" id="BigBigMenuConfirmSaveOptions">saved</div>
		<h3>Options</h3>
		<hr/>
		<div class="controlHolder" id="BigBigMenuInsertMethod">
			<p>How do you want to include the menu?</p>
			<p><label><input type="radio" name="insertmethod" value="listpages" <?=($insertmethod=='listpages'?'checked="checked"':'')?>/> Use <code>wp_list_pages()</code><br/><em>(recommended)</em></label><br/>
				<label><input type="radio" name="insertmethod" value="templatetag" <?=($insertmethod=='templatetag'?'checked="checked"':'')?>/> Use the <code>bigbig_menu()</code> template tag</label></p>
		</div>
		<hr/>
		<div class="controlHolder" id="BigBigMenuWhichCSS">
			<p>Use built-in CSS for menu items?</p>
			<p><label><input type="radio" name="whichcss" value="none" <?=($whichcss=='none'?'checked="checked"':'')?>/> No <em>(use for most themes)</em></label><br/>
				<label><input type="radio" name="whichcss" value="plugin" <?=($whichcss=='plugin'?'checked="checked"':'')?>/> Yes</label></p>
		</div>
		<hr/>
		<div class="controlHolder" id="BigBigMenuOrientation">
			<p>How would you like your menu to be formatted?</p>
			<p><label><input type="radio" name="orientation" value="vert" <?=($orientation=='vert'?'checked="checked"':'')?>/> Vertically</label><br/>
				<label><input type="radio" name="orientation" value="horiz" <?=($orientation=='horiz'?'checked="checked"':'')?>/> Horizontally</label></p>
			</div>
		</div>
	</div>
</div>