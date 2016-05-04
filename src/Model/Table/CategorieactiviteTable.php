<?php
namespace App\Model\Table;

use App\Model\Entity\Categorieactivite;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Categorieactivite Model
 *
 */
class CategorieactiviteTable extends Table
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

        $this->table('categorieactivite');
        $this->displayField('CodeCategorieActivite');
        $this->primaryKey('CodeCategorieActivite');
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
            ->integer('CodeCategorieActivite')
            ->allowEmpty('CodeCategorieActivite', 'create');

        $validator
            ->requirePresence('NomCategorie', 'create')
            ->notEmpty('NomCategorie');

        return $validator;
    }
}
