<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * SquadAssociado Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Squads
 * @property \Cake\ORM\Association\BelongsTo $Posicaos
 * @property \Cake\ORM\Association\BelongsTo $Associados
 *
 * @method \App\Model\Entity\SquadAssociado get($primaryKey, $options = [])
 * @method \App\Model\Entity\SquadAssociado newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\SquadAssociado[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\SquadAssociado|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\SquadAssociado patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\SquadAssociado[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\SquadAssociado findOrCreate($search, callable $callback = null)
 */
class SquadAssociadoTable extends Table
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

        $this->table('squad_associado');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Squad', [
            'foreignKey' => 'squad_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Posicao', [
            'foreignKey' => 'posicao_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Associados', [
            'foreignKey' => 'associados_id',
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
        $rules->add($rules->existsIn(['squad_id'], 'Squad'));
        $rules->add($rules->existsIn(['posicao_id'], 'Posicao'));
        $rules->add($rules->existsIn(['associados_id'], 'Associados'));

        return $rules;
    }
}
