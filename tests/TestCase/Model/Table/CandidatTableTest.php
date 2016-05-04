<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CandidatTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CandidatTable Test Case
 */
class CandidatTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\CandidatTable
     */
    public $Candidat;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.candidat'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Candidat') ? [] : ['className' => 'App\Model\Table\CandidatTable'];
        $this->Candidat = TableRegistry::get('Candidat', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Candidat);

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
