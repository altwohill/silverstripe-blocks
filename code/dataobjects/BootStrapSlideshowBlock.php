<?php

/**
 * Displays images in a slideshow
 */
class BootStrapSlideshowBlock extends BootStrapBlock {
    private static $singular_name = 'Slideshow';
    private static $plural_name = 'Slideshows';

    private static $has_many = array(
        'Slides' => 'BootStrapSlide',
    );
}

class BootStrapSlide extends DataObject {
    private static $db = array(
        'SortID' => 'Int',
    );
    private static $has_one = array(
        'Link' => 'Link',
        'Image' => 'Image'
    );

    private static $summary_fields = array (
        'Link.URL' => 'Link',
        'Image.CMSThumbnail' => 'Image'
    );

    public static $default_sort = 'SortID';

    public function getCMSFields() {
        $fields = parent::getCMSFields();
        $fields->removeByName('SortID');
        return $fields;
    }
}