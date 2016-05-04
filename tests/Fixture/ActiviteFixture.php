<?php
namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ActiviteFixture
 *
 */
class ActiviteFixture extends TestFixture
{

    /**
     * Table name
     *
     * @var string
     */
    public $table = 'activite';

    /**
     * Fields
     *
     * @var array
     */
    // @codingStandardsIgnoreStart
    public $fields = [
        'CodeActivite' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        'NomActivite' => ['type' => 'string', 'length' => 250, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'fixed' => null],
        'DescriptifActivite' => ['type' => 'text', 'length' => null, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null],
        'CodeCategorie' => ['type' => 'integer', 'length' => 10, 'unsigned' => true, 'null' => false, 'default' => null, 'comment' => '', 'precision' => null, 'autoIncrement' => null],
        '_indexes' => [
            'CodeCategorie' => ['type' => 'index', 'columns' => ['CodeCategorie'], 'length' => []],
        ],
        '_constraints' => [
            'primary' => ['type' => 'primary', 'columns' => ['CodeActivite'], 'length' => []],
            'activite_ibfk_1' => ['type' => 'foreign', 'columns' => ['CodeCategorie'], 'references' => ['categorieactivite', 'CodeCategorieActivite'], 'update' => 'restrict', 'delete' => 'restrict', 'length' => []],
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
            'CodeActivite' => 1,
            'NomActivite' => 'Lorem ipsum dolor sit amet',
            'DescriptifActivite' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
            'CodeCategorie' => 1
        ],
    ];
}
