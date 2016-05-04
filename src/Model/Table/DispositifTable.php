<?php
namespace App\Model\Table;

use App\Model\Entity\Dispositif;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Dispositif Model
 *
 */
class DispositifTable extends Table
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

        $this->table('dispositif');
        $this->displayField('CodeDispositif');
        $this->primaryKey('CodeDispositif');
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
            ->integer('CodeDispositif')
            ->allowEmpty('CodeDispositif', 'create');

        $validator
            ->requirePresence('NomDispositif', 'create')
            ->notEmpty('NomDispositif');

        return $validator;
    }
}
