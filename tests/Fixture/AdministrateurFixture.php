<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AdministrateurFixture
 *
 */
class AdministrateurFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'administrateur';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'CodeAdmin' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'autoIncrement' => true, 'precision' => null],
        'ID' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'ID' => ['type' => 'index', 'columns' => ['ID'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['CodeAdmin'], 'length' => []],
            'administrateur_ibfk_1' => ['type' => 'foreign', 'columns' => ['ID'], 'references' => ['utilisateur', 'ID'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'CodeAdmin' => 1,
            'ID' => 1
        ],
    ];
}
