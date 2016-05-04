<?php
namespace App\Model\Table;

use App\Model\Entity\Utilisateur;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Utilisateur Model
 *
 */
class UtilisateurTable extends Table
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

        $this->table('utilisateur');
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
            ->requirePresence('Login', 'create')
            ->notEmpty('Login');

        $validator
            ->requirePresence('TypeUser', 'create')
            ->notEmpty('TypeUser');

        $validator
            ->requirePresence('MotDePasse', 'create')
            ->notEmpty('MotDePasse');

        $validator
            ->requirePresence('MailCandidat', 'create')
            ->notEmpty('MailCandidat');

        return $validator;
    }
}
