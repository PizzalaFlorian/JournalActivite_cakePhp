<?php
namespace App\Model\Table;

use App\Model\Entity\Compagnie;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Compagnie Model
 *
 */
class CompagnieTable extends Table
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

        $this->table('compagnie');
        $this->displayField('CodeCompagnie');
        $this->primaryKey('CodeCompagnie');
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
            ->requirePresence('NomCompagnie', 'create')
            ->notEmpty('NomCompagnie');

        $validator
            ->integer('CodeCompagnie')
            ->allowEmpty('CodeCompagnie', 'create');

        return $validator;
    }
}
