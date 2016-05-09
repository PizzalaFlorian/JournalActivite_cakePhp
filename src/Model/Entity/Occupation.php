<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Occupation Entity.
 *
 * @property int $CodeOccupation
 * @property \Cake\I18n\Time $HeureDebut
 * @property \Cake\I18n\Time $HeureFin
 * @property int $CodeCandidat
 * @property int $CodeLieux
 * @property int $CodeActivite
 * @property int $CodeCompagnie
 * @property int $CodeDispositif
 */
class Occupation extends Entity
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
        'CodeOccupation' => false,
    ];
}
