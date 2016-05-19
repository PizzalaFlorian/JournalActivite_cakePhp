<?php
namespace App\Model\Table;

use App\Model\Entity\Carnetdebord;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Carnetdebord Model
 *
 */
class CarnetdebordTable extends Table
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

        $this->table('carnetdebord');
        $this->displayField('CodeEntree');
        $this->primaryKey('CodeEntree');
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
            ->integer('CodeEntree')
            ->allowEmpty('CodeEntree', 'create');

        $validator
            ->dateTime('Date')
            ->requirePresence('Date', 'create')
            ->notEmpty('Date');

        $validator
            ->requirePresence('Sujet', 'create')
            ->notEmpty('Sujet');

        $validator
            ->requirePresence('Commentaire', 'create')
            ->notEmpty('Commentaire');

        $validator
            ->integer('CodeChercheur')
            ->requirePresence('CodeChercheur', 'create')
            ->notEmpty('CodeChercheur');

        return $validator;
    }
}
