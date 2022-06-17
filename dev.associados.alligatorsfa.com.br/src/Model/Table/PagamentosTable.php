<?php
namespace App\Model\Table;

use App\Model\Entity\Pagamento;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Pagamentos Model
 *
 * @property \Cake\ORM\Association\HasMany $Mensalidade
 */
class PagamentosTable extends Table
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

        $this->table('pagamentos');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('Mensalidade', [
            'foreignKey' => 'pagamento_id'
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
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->requirePresence('descricao', 'false')
            ->allowEmpty('descricao', 'true');

        return $validator;
    }
}
