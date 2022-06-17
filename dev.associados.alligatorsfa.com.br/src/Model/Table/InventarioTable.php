<?php
namespace App\Model\Table;

use App\Model\Entity\Inventario;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Inventario Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Equipamentos
 * @property \Cake\ORM\Association\BelongsTo $Associados
 */
class InventarioTable extends Table
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

        $this->table('inventario');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Equipamentos', [
            'foreignKey' => 'equipamento_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Associados', [
            'foreignKey' => 'associado_id',
            'joinType' => 'INNER'
        ]);
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
            ->requirePresence('tamanho', 'create')
            ->notEmpty('tamanho');

        $validator
            ->allowEmpty('sobrecor');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['equipamento_id'], 'Equipamentos'));
        $rules->add($rules->existsIn(['associado_id'], 'Associados'));
        return $rules;
    }
}
