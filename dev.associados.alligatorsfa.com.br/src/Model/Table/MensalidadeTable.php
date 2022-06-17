<?php
namespace App\Model\Table;

use App\Model\Entity\Mensalidade;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Mensalidade Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Associados
 * @property \Cake\ORM\Association\BelongsTo $Pagamentos
 */
class MensalidadeTable extends Table
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

        $this->table('mensalidade');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Associados', [
            'foreignKey' => 'associado_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Pagamentos', [
            'foreignKey' => 'pagamento_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Plano', [
            'foreignKey' => 'plano_id',
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
            ->date('vencimento')
            ->requirePresence('vencimento', 'create')
            ->notEmpty('vencimento');

        $validator
            ->integer('associado_id')
            ->requirePresence('associado_id', 'create')
            ->notEmpty('associado_id');

        $validator
            ->integer('plano_id')
            ->requirePresence('plano_id', 'create')
            ->notEmpty('plano_id');

        $validator
            ->date('pago')
            ->allowEmpty('pago', 'true');

        $validator
            ->decimal('valor_base')
            ->requirePresence('valor_base', 'create')
            ->notEmpty('valor_base');

        $validator
            ->decimal('desconto')
            ->allowEmpty('desconto');

        $validator
            ->decimal('acressimo')
            ->allowEmpty('acressimo');

        $validator
            ->decimal('valor_pago')
            ->allowEmpty('valor_pago');

        $validator
            ->allowEmpty('observacoes');

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
        $rules->add($rules->existsIn(['associado_id'], 'Associados'));
        $rules->add($rules->existsIn(['pagamento_id'], 'Pagamentos'));
        return $rules;
    }
}
