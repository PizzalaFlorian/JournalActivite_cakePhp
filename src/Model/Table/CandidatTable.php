<?php
namespace App\Model\Table;

use App\Model\Entity\Candidat;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Candidat Model
 *
 */
class CandidatTable extends Table
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

        $this->table('candidat');
        $this->displayField('CodeCandidat');
        $this->primaryKey('CodeCandidat');
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
            ->integer('CodeCandidat')
            ->allowEmpty('CodeCandidat', 'create');

        $validator
            ->requirePresence('NomCandidat', 'create')
            ->notEmpty('NomCandidat');

        $validator
            ->requirePresence('PrenomCandidat', 'create')
            ->notEmpty('PrenomCandidat');

        $validator
            ->integer('Age')
            ->requirePresence('Age', 'create')
            ->notEmpty('Age');

        $validator
            ->requirePresence('GenreCandidat', 'create')
            ->notEmpty('GenreCandidat');

        $validator
            ->requirePresence('LieuxEtude', 'create')
            ->notEmpty('LieuxEtude');

        $validator
            ->requirePresence('NiveauEtude', 'create')
            ->notEmpty('NiveauEtude');

        $validator
            ->requirePresence('DiplomePrep', 'create')
            ->notEmpty('DiplomePrep');

        $validator
            ->requirePresence('EtatCivil', 'create')
            ->notEmpty('EtatCivil');

        $validator
            ->integer('NombreEnfant')
            ->requirePresence('NombreEnfant', 'create')
            ->notEmpty('NombreEnfant');

        $validator
            ->integer('ID')
            ->requirePresence('ID', 'create')
            ->notEmpty('ID');

        return $validator;
    }
}
