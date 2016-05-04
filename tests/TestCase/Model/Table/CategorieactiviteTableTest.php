<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategorieactiviteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategorieactiviteTable Test Case
 */
class CategorieactiviteTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CategorieactiviteTable
     */
    public $Categorieactivite;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.categorieactivite'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Categorieactivite') ? [] : ['className' => 'App\Model\Table\CategorieactiviteTable'];
        $this->Categorieactivite = TableRegistry::get('Categorieactivite', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Categorieactivite);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
