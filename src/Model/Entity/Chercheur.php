<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Chercheur Entity.
 *
 * @property int $CodeChercheur
 * @property string $NomChercheur
 * @property string $PrenomChercheur
 * @property int $ID
 */
class Chercheur extends Entity
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
        'CodeChercheur' => false,
    ];
}
