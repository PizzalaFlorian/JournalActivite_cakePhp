<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\AdministrateurTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\AdministrateurTable Test Case
 */
class AdministrateurTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\AdministrateurTable
     */
    public $Administrateur;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.administrateur'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Administrateur') ? [] : ['className' => 'App\Model\Table\AdministrateurTable'];
        $this->Administrateur = TableRegistry::get('Administrateur', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Administrateur);

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
