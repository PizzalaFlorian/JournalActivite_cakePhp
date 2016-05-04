<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ChercheurFixture
 *
 */
class ChercheurFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'chercheur';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'CodeChercheur' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'NomChercheur' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'PrenomChercheur' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'ID' => ['type' => 'integer', 'length' => 11, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ID' => ['type' => 'index', 'columns' => ['ID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['CodeChercheur'], 'length' => []],
            'chercheur_ibfk_1' => ['type' => 'foreign', 'columns' => ['ID'], 'references' => ['utilisateur', 'ID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'CodeChercheur' => 1,
            'NomChercheur' => 'Lorem ipsum dolor sit amet',
            'PrenomChercheur' => 'Lorem ipsum dolor sit amet',
            'ID' => 1
        ],
    ];
}
