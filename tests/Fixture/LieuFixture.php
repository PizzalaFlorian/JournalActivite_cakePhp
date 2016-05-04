<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * LieuFixture
 *
 */
class LieuFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'lieu';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'CodeLieux' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'NomLieux' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'CodeCategorieLieux' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'CodeCategorieLieux' => ['type' => 'index', 'columns' => ['CodeCategorieLieux'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['CodeLieux'], 'length' => []],
            'lieu_ibfk_1' => ['type' => 'foreign', 'columns' => ['CodeCategorieLieux'], 'references' => ['categorielieu', 'CodeCategorieLieux'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'CodeLieux' => 1,
            'NomLieux' => 'Lorem ipsum dolor sit amet',
            'CodeCategorieLieux' => 1
        ],
    ];
}
