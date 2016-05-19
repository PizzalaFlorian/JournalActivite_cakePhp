<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CarnetdebordTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CarnetdebordTable Test Case
 */
class CarnetdebordTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CarnetdebordTable
     */
    public $Carnetdebord;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.carnetdebord'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Carnetdebord') ? [] : ['className' => 'App\Model\Table\CarnetdebordTable'];
        $this->Carnetdebord = TableRegistry::get('Carnetdebord', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Carnetdebord);

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
