<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CompagnieTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CompagnieTable Test Case
 */
class CompagnieTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CompagnieTable
     */
    public $Compagnie;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.compagnie'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Compagnie') ? [] : ['className' => 'App\Model\Table\CompagnieTable'];
        $this->Compagnie = TableRegistry::get('Compagnie', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Compagnie);

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
