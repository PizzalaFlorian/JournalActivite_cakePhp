<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CategorielieuTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CategorielieuTable Test Case
 */
class CategorielieuTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CategorielieuTable
     */
    public $Categorielieu;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.categorielieu'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Categorielieu') ? [] : ['className' => 'App\Model\Table\CategorielieuTable'];
        $this->Categorielieu = TableRegistry::get('Categorielieu', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Categorielieu);

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
