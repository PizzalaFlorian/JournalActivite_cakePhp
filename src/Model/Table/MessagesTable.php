<?php
namespace App\Model\Table;

use App\Model\Entity\Message;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Messages Model
 *
 */
class MessagesTable extends Table
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

        $this->table('messages');
        $this->displayField('IDMessage');
        $this->primaryKey('IDMessage');
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
            ->integer('IDMessage')
            ->allowEmpty('IDMessage', 'create');

        $validator
            ->date('DateEnvoi')
            ->requirePresence('DateEnvoi', 'create')
            ->notEmpty('DateEnvoi');

        $validator
            ->requirePresence('Sujet', 'create')
            ->notEmpty('Sujet');

        $validator
            ->requirePresence('ContenuMessage', 'create')
            ->notEmpty('ContenuMessage');

        $validator
            ->boolean('recepteurLu')
            ->requirePresence('recepteurLu', 'create')
            ->notEmpty('recepteurLu');

        $validator
            ->boolean('expediteurLu')
            ->requirePresence('expediteurLu', 'create')
            ->notEmpty('expediteurLu');

        $validator
            ->integer('IDExpediteur')
            ->requirePresence('IDExpediteur', 'create')
            ->notEmpty('IDExpediteur');

        $validator
            ->integer('IDRecepteur')
            ->requirePresence('IDRecepteur', 'create')
            ->notEmpty('IDRecepteur');

        $validator
            ->integer('userExpediteur')
            ->requirePresence('userExpediteur', 'create')
            ->notEmpty('userExpediteur');

        $validator
            ->integer('userRecepteur')
            ->requirePresence('userRecepteur', 'create')
            ->notEmpty('userRecepteur');

        return $validator;
    }
}
