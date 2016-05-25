<?php
namespace App\Model\Table;

use App\Model\Entity\Contact;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Contacts Model
 *
 */
class ContactsTable extends Table
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

        $this->table('contacts');
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
            ->requirePresence('expediteur', 'create')
            ->notEmpty('expediteur');

        $validator
            ->requirePresence('sujet', 'create')
            ->notEmpty('sujet');

        $validator
            ->requirePresence('contenue', 'create')
            ->notEmpty('contenue');

        $validator
            ->dateTime('dateEnvoie')
            ->requirePresence('dateEnvoie', 'create')
            ->notEmpty('dateEnvoie');

        $validator
            ->boolean('lu')
            ->requirePresence('lu', 'create')
            ->notEmpty('lu');

        return $validator;
    }
}
