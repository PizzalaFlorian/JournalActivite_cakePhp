<?php
namespace App\Model\Table;

use App\Model\Entity\Administrateur;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Administrateur Model
 *
 */
class AdministrateurTable extends Table
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

        $this->table('administrateur');
        $this->displayField('CodeAdmin');
        $this->primaryKey('CodeAdmin');
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
            ->integer('CodeAdmin')
            ->allowEmpty('CodeAdmin', 'create');

        $validator
            ->integer('ID')
            ->requirePresence('ID', 'create')
            ->notEmpty('ID');

        return $validator;
    }
}
