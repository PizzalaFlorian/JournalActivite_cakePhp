<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DispositifTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DispositifTable Test Case
 */
class DispositifTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DispositifTable
     */
    public $Dispositif;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.dispositif'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Dispositif') ? [] : ['className' => 'App\Model\Table\DispositifTable'];
        $this->Dispositif = TableRegistry::get('Dispositif', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Dispositif);

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
