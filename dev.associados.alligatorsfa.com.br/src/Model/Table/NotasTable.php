<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Notas Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Associados
 * @property \Cake\ORM\Association\BelongsTo $Logins
 *
 * @method \App\Model\Entity\Nota get($primaryKey, $options = [])
 * @method \App\Model\Entity\Nota newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Nota[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Nota|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Nota patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Nota[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Nota findOrCreate($search, callable $callback = null)
 */
class NotasTable extends Table
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

        $this->table('notas');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Associados', [
            'foreignKey' => 'associado_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Login', [
            'foreignKey' => 'login_id',
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
            ->date('data')
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        $validator
            ->requirePresence('tipo', 'create')
            ->notEmpty('tipo');

        $validator
            ->requirePresence('nota', 'create')
            ->notEmpty('nota');

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
        $rules->add($rules->existsIn(['login_id'], 'Login'));

        return $rules;
    }
}
