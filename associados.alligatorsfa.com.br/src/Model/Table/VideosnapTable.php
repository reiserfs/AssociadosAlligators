<?php
namespace App\Model\Table;

use App\Model\Entity\Videosnap;
use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Videosnap Model
 *
 * @property \Cake\ORM\Association\BelongsTo $Videos
 */
class VideosnapTable extends Table
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

        $this->table('videosnap');
        $this->displayField('id');
        $this->primaryKey('id');

        $this->belongsTo('Video', [
            'foreignKey' => 'video_id',
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
            ->requirePresence('inicio', 'create')
            ->notEmpty('inicio');

        $validator
            ->requirePresence('fim', 'create')
            ->notEmpty('fim');

        $validator
            ->requirePresence('casa', 'create')
            ->notEmpty('casa');

        $validator
            ->requirePresence('visitante', 'create')
            ->notEmpty('visitante');

        $validator
            ->requirePresence('resultado', 'create')
            ->notEmpty('resultado');

        $validator
            ->allowEmpty('descricao');

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
        $rules->add($rules->existsIn(['video_id'], 'Video'));
        return $rules;
    }
}
