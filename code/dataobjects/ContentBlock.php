<?php

namespace Twohill\Legacy\dataobjects;


class ContentBlock extends Block
{

    private static $singular_name = 'Content Block';
    private static $plural_name = 'Content Blocks';

    private static $table_name = 'ContentBlock';

    private static $db = array(
        'Content' => 'HTMLText'
    );
}

