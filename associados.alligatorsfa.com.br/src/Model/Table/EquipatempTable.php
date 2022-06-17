<?php
namespace App\Model\Table;

use App\Model\Entity\Equipatemp;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Equipatemp Model
 *
 */
class EquipatempTable extends Table
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

        $this->table('equipatemp');
        $this->displayField('id');
        $this->primaryKey('id');
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
            ->integer('id')
            ->allowEmpty('id', 'create');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->requirePresence('marca', 'create')
            ->notEmpty('marca');

        $validator
            ->requirePresence('modelo', 'create')
            ->notEmpty('modelo');

        $validator
            ->requirePresence('descricao', 'create')
            ->notEmpty('descricao');

        $validator
            ->requirePresence('cor', 'create')
            ->notEmpty('cor');

        $validator
            ->requirePresence('foto', 'create')
            ->notEmpty('foto');

        $validator
            ->integer('foto_size')
            ->requirePresence('foto_size', 'create')
            ->notEmpty('foto_size');

        $validator
            ->requirePresence('foto_type', 'create')
            ->notEmpty('foto_type');

        return $validator;
    }
}
