<?php
namespace App\Model\Table;

use App\Model\Entity\Categorielieu;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categorielieu Model
 *
 */
class CategorielieuTable extends Table
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

        $this->table('categorielieu');
        $this->displayField('CodeCategorieLieux');
        $this->primaryKey('CodeCategorieLieux');
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
            ->integer('CodeCategorieLieux')
            ->allowEmpty('CodeCategorieLieux', 'create');

        $validator
            ->requirePresence('NomCategorie', 'create')
            ->notEmpty('NomCategorie');

        return $validator;
    }
}
