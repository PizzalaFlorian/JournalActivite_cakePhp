<?php
namespace App\Model\Table;

use App\Model\Entity\Lieu;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Lieu Model
 *
 */
class LieuTable extends Table
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

        $this->table('lieu');
        $this->displayField('CodeLieux');
        $this->primaryKey('CodeLieux');
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
            ->requirePresence('CodeLieux', 'create')
            ->notEmpty('CodeLieux');

        $validator
            ->requirePresence('NomLieux', 'create')
            ->notEmpty('NomLieux');

        $validator
            ->integer('CodeCategorieLieux')
            ->requirePresence('CodeCategorieLieux', 'create')
            ->notEmpty('CodeCategorieLieux');

        return $validator;
    }
}
