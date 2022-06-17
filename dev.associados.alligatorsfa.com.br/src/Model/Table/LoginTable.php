<?php
namespace App\Model\Table;

use App\Model\Entity\Login;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Login Model
 *
 */
class LoginTable extends Table
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

        $this->table('login');
        $this->displayField('id');
        $this->primaryKey('id');
	$this->hasMany('Permissoes');
        $this->belongsTo('Associados');
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
            ->requirePresence('user', 'create')
            ->notEmpty('user');

	$validator->add('user', 'unique', [
		    'rule' => 'validateUnique',
		    'provider' => 'table',
		    'message' => 'Usuario ja cadastrado',
	]);

        $validator
            ->requirePresence('password', 'create')
            ->allowEmpty('password', 'update');

        $validator
            ->date('data_criacao')
            ->allowEmpty('data_criacao', 'true');

        $validator
            ->dateTime('ultimo_login')
            ->allowEmpty('ultimo_login', 'true');

        $validator
            ->boolean('ativo')
            ->requirePresence('ativo', 'false')
            ->allowEmpty('ativo','true');

        $validator
            ->integer('associado_id')
            ->requirePresence('associado_id', 'create')
            ->notEmpty('associado_id');

        $validator
            ->requirePresence('email', 'create')
            ->notEmpty('email');

        $validator
            ->requirePresence('nascimento', 'create')
            ->notEmpty('nascimento');   
        $validator
            ->requirePresence('cpf', 'create')
            ->notEmpty('cpf');

	$validator
		->add('senha', [
		    'match' => [
			    'rule' => ['compareWith', 'confirma_senha'],
			    'message' => 'Senhas precisam ser iguais'
		    ]
    	])
		->add('senha', [
		    'length' => [
		    	    'rule' => ['minLength', 6],
			    'message' => 'A senha precisa ter no minimo 6 digitos!',
   	            ]
	]);
	$validator
            ->requirePresence('confirma_senha', 'create')
            ->notEmpty('confirma_senha');

 
	return $validator;
    }
}
