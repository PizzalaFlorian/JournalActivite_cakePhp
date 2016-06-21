<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = 'CakePHP: the rapid development php framework';

?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>
        LSE Times Management
    </title>
    <?= $this->Html->meta('icon') ?>

    <?= $this->Html->css('base2.css') ?>
    
    <?= $this->Html->css('cake2.css') ?>
    
    
    <?= $this->Html->script('jquery-1.7.min') ?>
    <?= $this->Html->script('jquery-ui-1.7.2.custom.min') ?>
    <?= $this->Html->script('menu.js') ?>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>

    
</head>
<body>
<nav class="top-bar expanded" data-topbar role="navigation">
        <ul class="title-area large-2 medium-3 columns">
            <li class="name">
                <!-- <h1><a href=""><?= $this->fetch('title') ?></a></h1> -->
                <h1><a id="layTitle" href="/candidat/accueil">Candidat</a></h1>
                <div id="menu_responsive"><?php echo $this->Html->image('menu.png', array('alt' => 'menu', 'class'=> 'img_menu'));?></div>    
            </li>
        </ul>
            <div class="top-bar-section">
                <ul class="right">
                    <!-- <li><a target="_blank" href="http://book.cakephp.org/3.0/">Documentation</a></li>
                    <li><a target="_blank" href="http://api.cakephp.org/3.0/">API</a></li> -->
                    <li>
                        <?= $this->Html->link(
                                'Déconnexion',
                                ['controller' => 'users', 'action' => 'logout', '_full' => true]) 
                        ?>
                    </li>
                </ul>
            </div>
    </nav>
    <?= $this->Flash->render() ?>
    <div class="container clearfix">
            <nav class="large-2 medium-3 columns"id="actions-sidebar">
                <ul class="side-nav">
                    <?= $this->fetch('sidebarCandidat') ?>
                </ul>
            </nav> 
        <div class="candidat large-10 medium-9 colums content " id="contentCandidat">
            <?= $this->fetch('content') ?>
        </div>
    </div>   
     
    
    
    
    <footer>
    </footer>
</body>
</html>
