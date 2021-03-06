<?php
namespace App\Model\Table;

use App\Model\Entity\Associado;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Associados Model
 *
 */
class AssociadosTable extends Table
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

        $this->table('associados');
        $this->displayField('id');
        $this->primaryKey('id');
	$this->hasOne('Login');
	$this->belongsTo('Time');
	$this->belongsTo('Plano');
        $this->hasMany('Mensalidade', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Inventario', [
            'foreignKey' => 'associado_id'
        ]);
        $this->hasMany('Notas', [
            'foreignKey' => 'associado_id'
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
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

        $validator
            ->requirePresence('sobrenome', 'create')
            ->notEmpty('sobrenome');

        $validator
            ->date('nascimento')
            ->requirePresence('nascimento', 'create')
            ->notEmpty('nascimento');

        $validator
            ->email('email')
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('pai', 'false')
            ->allowEmpty('pai', 'true');

        $validator
            ->requirePresence('mae', 'create')
            ->notEmpty('mae');

        $validator
            ->requirePresence('naturalidade', 'create')
            ->notEmpty('naturalidade');

        $validator
            ->requirePresence('nacionalidade', 'create')
            ->notEmpty('nacionalidade');

        $validator
            ->requirePresence('profissao', 'create')
            ->notEmpty('profissao');

        $validator
            ->requirePresence('escolaridade', 'create')
            ->notEmpty('escolaridade');

        $validator
            ->requirePresence('superior', 'false')
            ->allowEmpty('superior', 'true');

        $validator
            ->requirePresence('endereco', 'create')
            ->notEmpty('endereco');

        $validator
            ->requirePresence('cidade', 'create')
            ->notEmpty('cidade');

        $validator
            ->requirePresence('estado', 'create')
            ->notEmpty('estado');

        $validator
            ->requirePresence('bairro', 'create')
            ->notEmpty('bairro');

        $validator
            ->integer('rg')
            ->requirePresence('rg', 'create')
            ->notEmpty('rg');

        $validator
            ->requirePresence('rg_emissor', 'create')
            ->notEmpty('rg_emissor');

        $validator
            ->requirePresence('cpf', 'create')
            ->notEmpty('cpf');

        $validator
            ->integer('contato_numero')
            ->requirePresence('contato_numero', 'false')
            ->allowEmpty('contato_numero', 'true');

        $validator
            ->integer('fixo')
            ->requirePresence('fixo', 'false')
            ->allowEmpty('fixo', 'true');

        $validator
            ->integer('celular')
            ->requirePresence('celular', 'create')
            ->notEmpty('celular');

        $validator
            ->requirePresence('altura', 'create')
            ->notEmpty('altura');

        $validator
            ->requirePresence('peso', 'create')
            ->notEmpty('peso');

        $validator
            ->requirePresence('sangue', 'create')
            ->notEmpty('sangue');

        $validator
            ->requirePresence('apelido', 'false')
            ->allowEmpty('apelido', 'true');

        $validator
            ->integer('cep')
            ->requirePresence('cep', 'create')
            ->notEmpty('cep');

        $validator
            ->integer('time_id')
            ->requirePresence('time_id', 'create')
            ->notEmpty('time_id');

	$validator
            ->integer('plano_id')
            ->requirePresence('plano_id', 'create')
            ->notEmpty('plano_id');

        $validator
            ->date('data_acesso')
            ->requirePresence('data_acesso', 'create')
            ->notEmpty('data_acesso');

        $validator
            ->requirePresence('foto', 'false')
            ->allowEmpty('foto', 'true');

        $validator
            ->requirePresence('sexo', 'create')
            ->notEmpty('sexo');

        $validator
            ->integer('numero')
            ->requirePresence('numero', 'false')
            ->allowEmpty('numero', 'true');


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
        $rules->add($rules->isUnique(['email']));
        return $rules;
    }
}
