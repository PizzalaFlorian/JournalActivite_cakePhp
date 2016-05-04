<?php

namespace App\View\Helper;

use Cake\View\Helper;
use Cake\View\StringTemplateTrait;

class HtmlHelper extends Helper
{

    use StringTemplateTrait;

    protected $_defaultConfig = [
        'errorClass' => 'error',
        'templates' => [
            'label' => '<label for="{{for}}">{{content}}</label>',
        ],
    ];

   	$charset = $this->Html->charset();
   // $this->Html->css('main');
    /*$this->Html->meta(
    'favicon.ico',
    '/favicon.ico',
    ['type' => 'icon']
	);*/
}