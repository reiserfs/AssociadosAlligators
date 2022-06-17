<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Posicao Model
 *
 * @property \Cake\ORM\Association\HasMany $SquadAssociado
 *
 * @method \App\Model\Entity\Posicao get($primaryKey, $options = [])
 * @method \App\Model\Entity\Posicao newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Posicao[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Posicao|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Posicao patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Posicao[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Posicao findOrCreate($search, callable $callback = null)
 */
class PosicaoTable extends Table
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

        $this->table('posicao');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->hasMany('SquadAssociado', [
            'foreignKey' => 'posicao_id'
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
            ->integer('time')
            ->requirePresence('time', 'create')
            ->notEmpty('time');

        $validator
            ->requirePresence('sigla', 'create')
            ->notEmpty('sigla');

        $validator
            ->requirePresence('nome', 'create')
            ->notEmpty('nome');

        return $validator;
    }
}
