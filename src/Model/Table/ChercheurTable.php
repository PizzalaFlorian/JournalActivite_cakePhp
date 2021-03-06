<?php
namespace App\Model\Table;

use App\Model\Entity\Chercheur;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Chercheur Model
 *
 */
class ChercheurTable extends Table
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

        $this->table('chercheur');
        $this->displayField('CodeChercheur');
        $this->primaryKey('CodeChercheur');
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
            ->integer('CodeChercheur')
            ->allowEmpty('CodeChercheur', 'create');

        $validator
            ->requirePresence('NomChercheur', 'create')
            ->notEmpty('NomChercheur');

        $validator
            ->requirePresence('PrenomChercheur', 'create')
            ->notEmpty('PrenomChercheur');

        $validator
            ->integer('ID')
            ->requirePresence('ID', 'create')
            ->notEmpty('ID');

        return $validator;
    }
}
