<?php
namespace App\Model\Table;

use App\Model\Entity\Plano;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Plano Model
 *
 * @property \Cake\ORM\Association\HasMany $Associados
 */
class PlanoTable extends Table
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

        $this->table('plano');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Associados', [
            'foreignKey' => 'plano_id'
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
            ->requirePresence('nome_plano', 'create')
            ->notEmpty('nome_plano');

        $validator
            ->integer('meses')
            ->requirePresence('meses', 'create')
            ->notEmpty('meses');

        $validator
            ->decimal('valor_base')
            ->requirePresence('valor_base', 'create')
            ->notEmpty('valor_base');

        return $validator;
    }
}
