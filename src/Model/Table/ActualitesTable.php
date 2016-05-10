<?php
namespace App\Model\Table;

use App\Model\Entity\Actualite;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Actualites Model
 *
 */
class ActualitesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->table('actualites');
        $this->displayField('ID');
        $this->primaryKey('ID');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('ID')
            ->allowEmpty('ID', 'create');

        $validator
            ->requirePresence('Sujet', 'create')
            ->notEmpty('Sujet');

        $validator
            ->requirePresence('Contenue', 'create')
            ->notEmpty('Contenue');

        $validator
            ->date('Date')
            ->requirePresence('Date', 'create')
            ->notEmpty('Date');

        return $validator;
    }
}
