<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CandidatFixture
 *
 */
class CandidatFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'candidat';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'CodeCandidat' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'NomCandidat' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'PrenomCandidat' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'Age' => ['type' => 'integer', 'length' => 11, 'unsigned' => false, 'null' => false, 'default' => null, 'comment' => 'pas plustot anné de naissance', 'precision' => null, 'autoIncrement' => null],
        'GenreCandidat' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'LieuxEtude' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'NiveauEtude' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'DiplomePrep' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'EtatCivil' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'NombreEnfant' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'ID' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ID' => ['type' => 'index', 'columns' => ['ID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['CodeCandidat'], 'length' => []],
            'candidat_ibfk_1' => ['type' => 'foreign', 'columns' => ['ID'], 'references' => ['users', 'ID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
        ],
        '_options' => [
            'engine' => 'InnoDB',
            'collation' => 'utf8_general_ci'
        ],
    ];
    // @codingStandardsIgnoreEnd

    /**
     * Records
     *
     * @var array
     */
    public $records = [
        [
            'CodeCandidat' => 1,
            'NomCandidat' => 'Lorem ipsum dolor sit amet',
            'PrenomCandidat' => 'Lorem ipsum dolor sit amet',
            'Age' => 1,
            'GenreCandidat' => 'Lorem ipsum dolor sit amet',
            'LieuxEtude' => 'Lorem ipsum dolor sit amet',
            'NiveauEtude' => 'Lorem ipsum dolor sit amet',
            'DiplomePrep' => 'Lorem ipsum dolor sit amet',
            'EtatCivil' => 'Lorem ipsum dolor sit amet',
            'NombreEnfant' => 1,
            'ID' => 1
        ],
    ];
}
