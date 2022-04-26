<?php

namespace APP\Services\Parser;

abstract class TagObject
{
    public $openTag;
    public $closeTag;
    public $data;
    public $position;    
}