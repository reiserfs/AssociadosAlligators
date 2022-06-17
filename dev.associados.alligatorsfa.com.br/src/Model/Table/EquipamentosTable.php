<?php
namespace App\Model\Table;

use App\Model\Entity\Equipamento;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Equipamentos Model
 *
 */
class EquipamentosTable extends Table
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

        $this->table('equipamentos');
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
            ->requirePresence('cor', 'false')
            ->allowEmpty('cor');

        $validator
            ->requirePresence('foto', 'false')
            ->allowEmpty('foto', 'true');

        return $validator;
    }
}
