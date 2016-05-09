<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * OccupationFixture
 *
 */
class OccupationFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'occupation';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'CodeOccupation' => ['type' => 'biginteger', 'length' => 20, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'HeureDebut' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'HeureFin' => ['type' => 'datetime', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'CodeCandidat' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CodeLieux' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CodeActivite' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CodeCompagnie' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'CodeDispositif' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'CodeCandidat' => ['type' => 'index', 'columns' => ['CodeCandidat'], 'length' => []],
            'CodeLieux' => ['type' => 'index', 'columns' => ['CodeLieux'], 'length' => []],
            'CodeCompagnie' => ['type' => 'index', 'columns' => ['CodeCompagnie'], 'length' => []],
            'CodeDispositif' => ['type' => 'index', 'columns' => ['CodeDispositif'], 'length' => []],
            'CodeActivite' => ['type' => 'index', 'columns' => ['CodeActivite'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['CodeOccupation'], 'length' => []],
            'occupation_ibfk_1' => ['type' => 'foreign', 'columns' => ['CodeCandidat'], 'references' => ['candidat', 'CodeCandidat'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'occupation_ibfk_2' => ['type' => 'foreign', 'columns' => ['CodeLieux'], 'references' => ['lieu', 'CodeLieux'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'occupation_ibfk_3' => ['type' => 'foreign', 'columns' => ['CodeCompagnie'], 'references' => ['compagnie', 'CodeCompagnie'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'occupation_ibfk_4' => ['type' => 'foreign', 'columns' => ['CodeDispositif'], 'references' => ['dispositif', 'CodeDispositif'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
            'occupation_ibfk_5' => ['type' => 'foreign', 'columns' => ['CodeActivite'], 'references' => ['activite', 'CodeActivite'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'CodeOccupation' => 1,
            'HeureDebut' => '2016-05-09 09:54:13',
            'HeureFin' => '2016-05-09 09:54:13',
            'CodeCandidat' => 1,
            'CodeLieux' => 1,
            'CodeActivite' => 1,
            'CodeCompagnie' => 1,
            'CodeDispositif' => 1
        ],
    ];
}
