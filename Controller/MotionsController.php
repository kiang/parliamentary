<?php

class MotionsController extends AppController {

    public $name = 'Motions';
    public $paginate = array();
    public $helpers = array();
    
    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('view', 'index');
    }

    function index($foreignModel = null, $foreignId = 0) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();


        $habtmKeys = array(
            'Parliamentarian' => 'Parliamentarian_id',
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);

        $scope = array();
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['Motion.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Parliamentarian' => array(
                    0 => array(
                        'table' => 'motions_parliamentarians',
                        'alias' => 'MotionsParliamentarian',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Motion_id = Motion.id'),
                    ),
                    1 => array(
                        'table' => 'parliamentarians',
                        'alias' => 'Parliamentarian',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Parliamentarian_id = Parliamentarian.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Motion.' . $foreignKeys[$foreignModel]]);
                $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                $this->paginate['Motion']['joins'] = $joins[$foreignModel];
            }
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['Motion']['limit'] = 20;
        $this->paginate['Motion']['order'] = array(
            'Motion.modified' => 'DESC',
        );
        $items = $this->paginate($this->Motion, $scope);
        $this->set('items', $items);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
    }

    function view($id = null) {
        $item = $this->Motion->find('first', array(
            'conditions' => array('Motion.id' => $id),
            'contain' => array('Parliamentarian'),
        ));
        if(!empty($item)) {
            $this->set('item', $item);
        } else {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_index($foreignModel = null, $foreignId = 0, $op = null) {
        $foreignId = intval($foreignId);
        $foreignKeys = array();


        $habtmKeys = array(
            'Parliamentarian' => 'Parliamentarian_id',
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);

        $scope = array();
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['Motion.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Parliamentarian' => array(
                    0 => array(
                        'table' => 'motions_parliamentarians',
                        'alias' => 'MotionsParliamentarian',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Motion_id = Motion.id'),
                    ),
                    1 => array(
                        'table' => 'parliamentarians',
                        'alias' => 'Parliamentarian',
                        'type' => 'inner',
                        'conditions' => array('MotionsParliamentarian.Parliamentarian_id = Parliamentarian.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Motion.' . $foreignKeys[$foreignModel]]);
                if ($op != 'set') {
                    $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                    $this->paginate['Motion']['joins'] = $joins[$foreignModel];
                }
            }
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['Motion']['limit'] = 20;
        $items = $this->paginate($this->Motion, $scope);

        if ($op == 'set' && !empty($joins[$foreignModel]) && !empty($foreignModel) && !empty($foreignId) && !empty($items)) {
            foreach ($items AS $key => $item) {
                $items[$key]['option'] = $this->Motion->find('count', array(
                    'joins' => $joins[$foreignModel],
                    'conditions' => array(
                        'Motion.id' => $item['Motion']['id'],
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
        if (!$id || !$this->data = $this->Motion->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Motion->create();
            if ($this->Motion->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.Motion');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->write('form.Motion.data', $this->data);
                $this->Session->write('form.Motion.validationErrors', $this->Motion->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect($this->referer());
        }
        if (!empty($this->data)) {
            if ($this->Motion->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.Motion');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->write('form.Motion.data', $this->data);
                $this->Session->write('form.Motion.validationErrors', $this->Motion->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->Motion->read(null, $id);
    }

    function admin_form($id = 0, $foreignModel = '') {
        $id = intval($id);
        if ($sessionFormData = $this->Session->read('form.Motion.data')) {
            $this->Motion->validationErrors = $this->Session->read('form.Motion.validationErrors');
            $this->Session->delete('form.Motion');
        }
        if ($id > 0) {
            $this->data = $this->Motion->read(null, $id);
            if (!empty($sessionFormData['Motion'])) {
                foreach ($sessionFormData['Motion'] AS $key => $val) {
                    if (isset($this->data['Motion'][$key])) {
                        $this->data['Motion'][$key] = $val;
                    }
                }
            }
        } else if (!empty($sessionFormData)) {
            $this->data = $sessionFormData;
        }

        $this->set('id', $id);
        $this->set('foreignModel', $foreignModel);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
        } else if ($this->Motion->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

    function admin_habtmSet($foreignModel = null, $foreignId = 0, $id = 0, $switch = null) {
        $habtmKeys = array(
            'Parliamentarian' => array(
                'associationForeignKey' => 'Parliamentarian_id',
                'foreignKey' => 'Motion_id',
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
            $habtmModel = &$this->Motion->$habtmKeys[$foreignModel]['alias'];
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
