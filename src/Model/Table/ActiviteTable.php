<?php
namespace App\Model\Table;

use App\Model\Entity\Activite;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Activite Model
 *
 */
class ActiviteTable extends Table
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

        $this->table('activite');
        $this->displayField('CodeActivite');
        $this->primaryKey('CodeActivite');
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
            ->integer('CodeActivite')
            ->allowEmpty('CodeActivite', 'create');

        $validator
            ->requirePresence('NomActivite', 'create')
            ->notEmpty('NomActivite');

        $validator
            ->requirePresence('DescriptifActivite', 'create')
            ->notEmpty('DescriptifActivite');

        $validator
            ->integer('CodeCategorie')
            ->requirePresence('CodeCategorie', 'create')
            ->notEmpty('CodeCategorie');

        return $validator;
    }
}
