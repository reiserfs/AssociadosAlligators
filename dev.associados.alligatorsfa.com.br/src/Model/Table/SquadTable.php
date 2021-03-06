<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Squad Model
 *
 * @property \Cake\ORM\Association\HasMany $SquadAssociado
 *
 * @method \App\Model\Entity\Squad get($primaryKey, $options = [])
 * @method \App\Model\Entity\Squad newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Squad[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Squad|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Squad patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Squad[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Squad findOrCreate($search, callable $callback = null)
 */
class SquadTable extends Table
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

        $this->table('squad');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Associados', [
            'foreignKey' => 'coach'
        ]);

        $this->hasMany('SquadAssociado', [
            'foreignKey' => 'squad_id'
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
            ->date('data')
            ->requirePresence('data', 'create')
            ->notEmpty('data');

        $validator
            ->boolean('ativo')
            ->requirePresence('ativo', 'create')
            ->notEmpty('ativo');

        $validator
            ->integer('coach')
            ->requirePresence('coach', 'create')
            ->notEmpty('coach');

        $validator
            ->integer('modalidade')
            ->requirePresence('modalidade', 'create')
            ->notEmpty('modalidade');

        return $validator;
    }
}
