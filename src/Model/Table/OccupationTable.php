<?php
namespace App\Model\Table;

use App\Model\Entity\Occupation;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Occupation Model
 *
 */
class OccupationTable extends Table
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

        $this->table('occupation');
        $this->displayField('CodeOccupation');
        $this->primaryKey('CodeOccupation');
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
            ->allowEmpty('CodeOccupation', 'create');

        $validator
            ->dateTime('HeureDebut')
            ->requirePresence('HeureDebut', 'create')
            ->notEmpty('HeureDebut');

        $validator
            ->dateTime('HeureFin')
            ->requirePresence('HeureFin', 'create')
            ->notEmpty('HeureFin');

        $validator
            ->integer('CodeCandidat')
            ->requirePresence('CodeCandidat', 'create')
            ->notEmpty('CodeCandidat');

        $validator
            ->integer('CodeLieux')
            ->requirePresence('CodeLieux', 'create')
            ->notEmpty('CodeLieux');

        $validator
            ->integer('CodeActivite')
            ->requirePresence('CodeActivite', 'create')
            ->notEmpty('CodeActivite');

        $validator
            ->integer('CodeCompagnie')
            ->requirePresence('CodeCompagnie', 'create')
            ->notEmpty('CodeCompagnie');

        $validator
            ->integer('CodeDispositif')
            ->requirePresence('CodeDispositif', 'create')
            ->notEmpty('CodeDispositif');

        return $validator;
    }
}
