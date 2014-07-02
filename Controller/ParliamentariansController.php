<?php

class ParliamentariansController extends AppController {

    public $name = 'Parliamentarians';
    public $paginate = array();
    public $helpers = array();
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('view', 'index', 'stat');
    }

    function index($foreignModel = null, $foreignId = 0) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();

        $foreignKeys = array(
            'Party' => 'Party_id',
        );
        $habtmKeys = array(
            'Motion' => 'Motion_id',
            'Area' => 'Area_id',
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);

        $scope = array();
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['Parliamentarian.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Motion' => array(
                    0 => array(
                        'table' => 'motions_parliamentarians',
                        'alias' => 'MotionsParliamentarian',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Parliamentarian_id = Parliamentarian.id'),
                    ),
                    1 => array(
                        'table' => 'motions',
                        'alias' => 'Motion',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Motion_id = Motion.id'),
                    ),
                ),
                'Area' => array(
                    0 => array(
                        'table' => 'areas_parliamentarians',
                        'alias' => 'AreasParliamentarian',
                        'type' => 'inner',
                        'conditions' => array('AreasParliamentarian.Parliamentarian_id = Parliamentarian.id'),
                    ),
                    1 => array(
                        'table' => 'areas',
                        'alias' => 'Area',
                        'type' => 'inner',
                        'conditions' => array('AreasParliamentarian.Area_id = Area.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Parliamentarian.' . $foreignKeys[$foreignModel]]);
                $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                $this->paginate['Parliamentarian']['joins'] = $joins[$foreignModel];
            }
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['Parliamentarian']['limit'] = 20;
        $this->paginate['Parliamentarian']['order'] = array('modified' => 'DESC');
        $this->paginate['Parliamentarian']['fields'] = array(
            'id', 'Party_id', 'name', 'district', 'links_council', 'image_url',
        );
        $items = $this->paginate($this->Parliamentarian, $scope);
        foreach ($items AS $key => $item) {
            $items[$key]['Motion'] = $this->Parliamentarian->Motion->find('all', array(
                'joins' => array(
                    array(
                        'table' => 'motions_parliamentarians',
                        'alias' => 'MotionsParliamentarian',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Motion_id = Motion.id'),
                    ),
                ),
                'fields' => array(
                    'Motion.id', 'Motion.summary', 'Motion.modified',
                ),
                'conditions' => array(
                    'MotionsParliamentarian.Parliamentarian_id' => $item['Parliamentarian']['id'],
                ),
                'limit' => 5,
                'order' => array(
                    'Motion.modified' => 'DESC'
                ),
            ));
        }
        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }

    function view($id = null, $motionType = 'all') {
        $item = $this->Parliamentarian->read(null, $id);
        if (!empty($item)) {
            $motionConditions = array(
                'MotionsParliamentarian.Motion_id = Motion.id',
            );
            switch($motionType) {
                case 'requester':
                    $motionConditions['MotionsParliamentarian.type'] = 'requester';
                    break;
                case 'petition':
                    $motionConditions['MotionsParliamentarian.type'] = 'petition';
                    break;
                default:
                    $motionType = 'all';
            }
            $this->paginate['Motion']['joins'] = array(
                array(
                    'table' => 'motions_parliamentarians',
                    'alias' => 'MotionsParliamentarian',
                    'type' => 'inner',
                    'conditions' => $motionConditions,
                ),
            );
            $this->paginate['Motion']['order'] = array('Motion.modified' => 'DESC');
            $motions = $this->paginate($this->Parliamentarian->Motion, array(
                'MotionsParliamentarian.Parliamentarian_id' => $id,
            ));
            $this->set('motions', $motions);
            $this->set('item', $item);
            $this->set('url', array($id, $motionType));
            $this->set('motionType', $motionType);
        } else {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }
    
    function stat() {
        $this->layout = 'blank';
        $this->set('items', $this->Parliamentarian->find('all'));
    }

    function admin_index($foreignModel = null, $foreignId = 0, $op = null) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();

        $foreignKeys = array(
            'Party' => 'Party_id',
        );


        $habtmKeys = array(
            'Motion' => 'Motion_id',
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);

        $scope = array();
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['Parliamentarian.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Motion' => array(
                    0 => array(
                        'table' => 'motions_parliamentarians',
                        'alias' => 'MotionsParliamentarian',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Parliamentarian_id = Parliamentarian.id'),
                    ),
                    1 => array(
                        'table' => 'motions',
                        'alias' => 'Motion',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Motion_id = Motion.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Parliamentarian.' . $foreignKeys[$foreignModel]]);
                if ($op != 'set') {
                    $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                    $this->paginate['Parliamentarian']['joins'] = $joins[$foreignModel];
                }
            }
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['Parliamentarian']['limit'] = 20;
        $items = $this->paginate($this->Parliamentarian, $scope);

        if ($op == 'set' && !empty($joins[$foreignModel]) && !empty($foreignModel) && !empty($foreignId) && !empty($items)) {
            foreach ($items AS $key => $item) {
                $items[$key]['option'] = $this->Parliamentarian->find('count', array(
                    'joins' => $joins[$foreignModel],
                    'conditions' => array(
                        'Parliamentarian.id' => $item['Parliamentarian']['id'],
                        $foreignModel . '.id' => $foreignId,
                    ),
                ));
                if ($items[$key]['option'] > 0) {
                    $items[$key]['option'] = 1;
                }
            }
            $this->set('op', $op);
        }

        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }

    function admin_view($id = null) {
        if (!$id || !$this->data = $this->Parliamentarian->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_add($foreignModel = null, $foreignId = 0) {
        $foreignId = intval($foreignId);
        $foreignKeys = array(
            'Party' => 'Party_id',
        );
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            if (!empty($this->data)) {
                $this->data['Parliamentarian'][$foreignKeys[$foreignModel]] = $foreignId;
            }
        } else {
            $foreignModel = '';
        }
        if (!empty($this->data)) {
            $this->Parliamentarian->create();
            if ($this->Parliamentarian->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.Parliamentarian');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->write('form.Parliamentarian.data', $this->data);
                $this->Session->write('form.Parliamentarian.validationErrors', $this->Parliamentarian->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this->Parliamentarian->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.Parliamentarian');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->write('form.Parliamentarian.data', $this->data);
                $this->Session->write('form.Parliamentarian.validationErrors', $this->Parliamentarian->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->Parliamentarian->read(null, $id);
    }

    function admin_form($id = 0, $foreignModel = '') {
        $id = intval($id);
        if ($sessionFormData = $this->Session->read('form.Parliamentarian.data')) {
            $this->Parliamentarian->validationErrors = $this->Session->read('form.Parliamentarian.validationErrors');
            $this->Session->delete('form.Parliamentarian');
        }
        if ($id > 0) {
            $this->data = $this->Parliamentarian->read(null, $id);
            if (!empty($sessionFormData['Parliamentarian'])) {
                foreach ($sessionFormData['Parliamentarian'] AS $key => $val) {
                    if (isset($this->data['Parliamentarian'][$key])) {
                        $this->data['Parliamentarian'][$key] = $val;
                    }
                }
            }
        } else if (!empty($sessionFormData)) {
            $this->data = $sessionFormData;
        }

        $this->set('id', $id);
        $this->set('foreignModel', $foreignModel);

        $belongsToModels = array(
            'listParty' => array(
                'label' => 'Parties',
                'modelName' => 'Party',
                'foreignKey' => 'Party_id',
            ),
        );

        foreach ($belongsToModels AS $key => $model) {
            if ($foreignModel == $model['modelName']) {
                unset($belongsToModels[$key]);
                continue;
            }
            $this->set($key, $this->Parliamentarian->$model['modelName']->find('list'));
        }
        $this->set('belongsToModels', $belongsToModels);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
        } else if ($this->Parliamentarian->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

    function admin_habtmSet($foreignModel = null, $foreignId = 0, $id = 0, $switch = null) {
        $habtmKeys = array(
            'Motion' => array(
                'associationForeignKey' => 'Motion_id',
                'foreignKey' => 'Parliamentarian_id',
                'alias' => 'MotionsParliamentarian',
            ),
        );
        $foreignModel = array_key_exists($foreignModel, $habtmKeys) ? $foreignModel : null;
        $foreignId = intval($foreignId);
        $id = intval($id);
        $switch = in_array($switch, array('on', 'off')) ? $switch : null;
        if (empty($foreignModel) || $foreignId <= 0 || $id <= 0 || empty($switch)) {
            $this->set('habtmMessage', __('Wrong Parameters'));
        } else {
            $habtmModel = &$this->Parliamentarian->$habtmKeys[$foreignModel]['alias'];
            $conditions = array(
                $habtmKeys[$foreignModel]['associationForeignKey'] => $foreignId,
                $habtmKeys[$foreignModel]['foreignKey'] => $id,
            );
            $status = ($habtmModel->find('count', array(
                        'conditions' => $conditions,
                    ))) ? 'on' : 'off';
            if ($status == $switch) {
                $this->set('habtmMessage', __('Duplicated operactions', true));
            } else if ($switch == 'on') {
                $habtmModel->create();
                if ($habtmModel->save(array($habtmKeys[$foreignModel]['alias'] => $conditions))) {
                    $this->set('habtmMessage', __('Updated', true));
                } else {
                    $this->set('habtmMessage', __('Update failed', true));
                }
            } else {
                if ($habtmModel->deleteAll($conditions)) {
                    $this->set('habtmMessage', __('Updated', true));
                } else {
                    $this->set('habtmMessage', __('Update failed', true));
                }
            }
        }
    }

}
