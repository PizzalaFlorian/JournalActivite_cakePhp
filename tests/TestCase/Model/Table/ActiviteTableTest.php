<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActiviteTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActiviteTable Test Case
 */
class ActiviteTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActiviteTable
     */
    public $Activite;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.activite'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Activite') ? [] : ['className' => 'App\Model\Table\ActiviteTable'];
        $this->Activite = TableRegistry::get('Activite', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Activite);

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
