<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ActualitesTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ActualitesTable Test Case
 */
class ActualitesTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ActualitesTable
     */
    public $Actualites;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.actualites'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Actualites') ? [] : ['className' => 'App\Model\Table\ActualitesTable'];
        $this->Actualites = TableRegistry::get('Actualites', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Actualites);

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
