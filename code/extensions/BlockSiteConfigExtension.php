<?php

namespace Twohill\Legacy\extensions;

use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\FieldList;
use Twohill\Legacy\dataobjects\Block;

/**
 * Legacy extension to aid with migrating from Blocks 0.x to 1.x
 * @package silverstipe blocks
 * @author Shea Dawson <shea@silverstripe.com.au>
 */
class BlockSiteConfigExtension extends DataExtension {
	private static $many_many = array(
		'Blocks' =>  Block::class,
	);

    /**
     *
     * @param FieldList $fields
     */
	public function updateCMSFields(FieldList $fields) {
		$fields->removeByName('Blocks');
	}
}
