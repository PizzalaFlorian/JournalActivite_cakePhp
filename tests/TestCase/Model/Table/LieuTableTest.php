<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\LieuTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\LieuTable Test Case
 */
class LieuTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\LieuTable
     */
    public $Lieu;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.lieu'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Lieu') ? [] : ['className' => 'App\Model\Table\LieuTable'];
        $this->Lieu = TableRegistry::get('Lieu', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Lieu);

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
