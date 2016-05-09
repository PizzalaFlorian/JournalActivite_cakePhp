<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 */
namespace App\View;

use Cake\View\View;

/**
 * Application View
 *
 * Your application’s default view class
 *
 * @link http://book.cakephp.org/3.0/en/views.html#the-app-view
 */
class AppView extends View
{

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading helpers.
     *
     * e.g. `$this->loadHelper('Html');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
        $this->loadHelper('Html');
        $this->loadHelper('Form');
        $this->loadHelper('Flash');
        

        //*************** CSS *************************
        // echo $this->Html->css('main');
        echo $this->Html->css('Demo_calendar_style');
        echo $this->Html->css('Demo_calendar_jquery');
        echo $this->Html->css('main_custom');
        echo $this->Html->css('ie8');
        echo $this->Html->css('modale');
        echo $this->Html->css('occupation');
        // echo $this->Html->css('font-awesome.min');
       

        //**************** JS *************************
        echo $this->Html->script('jquery-1.3.2.min');
        echo $this->Html->script('jquery-1.7.min');
        echo $this->Html->script('jquery-ui-1.7.2.custom.min');
        echo $this->Html->script('jquery.corner');
        echo $this->Html->script('jquery.mobile.custom.min');
        echo $this->Html->script('highcharts');
        echo $this->Html->script('main');
        echo $this->Html->script('modale');
        echo $this->Html->script('modernizr');
        echo $this->Html->script('timeline');
        echo $this->Html->script('candidat.activite');
        echo $this->Html->script('candidat_Renseignement.activite');
        echo $this->Html->script('chercheurTables');
        echo $this->Html->script('chercheurDonnees');
        echo $this->Html->script('chercheurMonCompte');
        echo $this->Html->script('Demo_calendar_script');



    }
}
