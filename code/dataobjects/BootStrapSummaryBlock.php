<?php

namespace Twohill\Legacy\dataobjects;

use Sheadawson\Linkable\Forms\LinkField;
use Sheadawson\Linkable\Models\Link;
use SilverStripe\Assets\Image;


/**
 * A title, an image, and a short blurb that links to content elsewhere
 */
class BootStrapSummaryBlock extends BootStrapBlock {
	private static $singular_name = 'Summary Block';
	private static $plural_name = 'Summary Blocks';
	private static $table_name = 'BootStrapSummaryBlock';

	private static $has_one = array(
		'Link' => Link::class,
		'Image' => Image::class,
	);

	public function getCMSFields() {
		$fields = parent::getCMSFields();
		$fields->replaceField('LinkID', LinkField::create('LinkID', 'Link'));
		return $fields;
	}
}
