<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Message Entity.
 *
 * @property int $IDMessage
 * @property \Cake\I18n\Time $DateEnvoi
 * @property string $Sujet
 * @property string $ContenuMessage
 * @property bool $recepteurLu
 * @property bool $expediteurLu
 * @property int $IDExpediteur
 * @property int $IDRecepteur
 * @property int $userExpediteur
 * @property int $userRecepteur
 */
class Message extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        '*' => true,
        'IDMessage' => false,
    ];
}
