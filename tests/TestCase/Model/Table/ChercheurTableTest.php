<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\ChercheurTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\ChercheurTable Test Case
 */
class ChercheurTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\ChercheurTable
     */
    public $Chercheur;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.chercheur'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Chercheur') ? [] : ['className' => 'App\Model\Table\ChercheurTable'];
        $this->Chercheur = TableRegistry::get('Chercheur', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Chercheur);

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
