<?php

namespace Twohill\Legacy\dataobjects;




use SilverStripe\Blog\Model\Blog;

/**
 * Displays the content of a blog in a bootstrap block
 */
class BootStrapBlogWidget extends BootStrapBlock {
	private static $singular_name = 'Blog Widget';
	private static $plural_name = 'Blog Widgets';

	private static $table_name = "BootStrapBlogWidget";

	private static $has_one = array(
		'Blog' => Blog::class,
	);
}
