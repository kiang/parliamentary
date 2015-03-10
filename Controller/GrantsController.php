<?php

class GrantsController extends AppController {

    public $name = 'Grants';
    public $paginate = array();
    public $helpers = array();

    function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allowedActions = array('view', 'index');
    }

    function index($foreignModel = null, $foreignId = 0) {
        $foreignKeys = array();

        $habtmKeys = array(
            'Parliamentarian' => 'Parliamentarian_id',
            'Area' => 'Area_id',
        );
        $foreignKeys = array_merge($habtmKeys, $foreignKeys);

        $scope = array();
        if (array_key_exists($foreignModel, $foreignKeys) && $foreignId > 0) {
            $scope['Grant.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Area' => array(
                    0 => array(
                        'table' => 'areas_grants',
                        'alias' => 'AreasGrant',
                        'type' => 'inner',
                        'conditions' => array('AreasGrant.Grant_id = Grant.id'),
                    ),
                ),
                'Parliamentarian' => array(
                    0 => array(
                        'table' => 'grants_parliamentarians',
                        'alias' => 'GrantsParliamentarian',
                        'type' => 'inner',
                        'conditions' => array('GrantsParliamentarian.Grant_id = Grant.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Grant.' . $foreignKeys[$foreignModel]]);
                $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                $this->paginate['Grant']['joins'] = $joins[$foreignModel];
            }
        } else {
            $foreignModel = '';
        }

        if (isset($this->request->data['Grant']['keyword'])) {
            $this->Session->write('Grants.index.keyword', $this->request->data['Grant']['keyword']);
        }
        $keyword = $this->Session->read('Grants.index.keyword');
        if (!empty($keyword)) {
            $scope[] = array(
                array('OR' => array(
                        'Grant.title LIKE' => "%{$keyword}%",
                        'Grant.vendors LIKE' => "%{$keyword}%",
                        'Grant.parliamentarians LIKE' => "%{$keyword}%",
                        'Grant.area LIKE' => "%{$keyword}%",
                    )),
            );
        }

        $this->set('scope', $scope);
        $this->paginate['Grant']['limit'] = 20;
        $this->paginate['Grant']['order'] = array(
            'Grant.year' => 'DESC',
        );
        $areas = $this->Grant->Area->find('all', array(
            'fields' => array('id', 'name'),
        ));
        $areas = Set::combine($areas, '{n}.Area.id', '{n}');
        $items = $this->paginate($this->Grant, $scope);
        $this->set('items', $items);
        $this->set('areas', $areas);
        $this->set('keyword', $keyword);
        $this->set('foreignId', $foreignId);
        $this->set('foreignModel', $foreignModel);
        $this->set('url', array($foreignModel, $foreignId));
        if ($foreignModel === 'Area' && !empty($foreignId)) {
            $title_for_layout = $desc_for_layout = '台南市' . $areas[$foreignId]['Area']['name'] . '議員建議事項';
        } else {
            $title_for_layout = $desc_for_layout = '台南市議員建議事項：';
        }
        if (!empty($items)) {
            $desc_for_layout .= implode(' | ', Set::extract('{n}.Grant.summary', $items));
        }
        $this->set('title_for_layout', $title_for_layout . '一覽');
        $this->set('desc_for_layout', $desc_for_layout);
    }

    function view($id = null) {
        $item = $this->Grant->find('first', array(
            'conditions' => array('Grant.id' => $id),
            'contain' => array(
                'Parliamentarian' => array(
                    'fields' => array('id', 'image_url', 'name', 'contacts_phone', 'district')
                )
            ),
        ));
        if (!empty($item)) {
            $this->set('item', $item);
            $ogTitle = mb_substr($item['Grant']['title'], 0, 50, 'utf-8');
            if ($ogTitle !== $item['Grant']['title']) {
                $ogTitle .= '...';
            }
            $this->set('title_for_layout', '議員建議事項：' . $ogTitle);
            $this->set('desc_for_layout', $item['Grant']['title']);
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
            $scope['Grant.' . $foreignKeys[$foreignModel]] = $foreignId;

            $joins = array(
                'Parliamentarian' => array(
                    0 => array(
                        'table' => 'grants_parliamentarians',
                        'alias' => 'GrantsParliamentarian',
                        'type' => 'inner',
                        'conditions' => array('GrantsParliamentarian.Grant_id = Grant.id'),
                    ),
                    1 => array(
                        'table' => 'parliamentarians',
                        'alias' => 'Parliamentarian',
                        'type' => 'inner',
                        'conditions' => array('GrantsParliamentarian.Parliamentarian_id = Parliamentarian.id'),
                    ),
                ),
            );
            if (array_key_exists($foreignModel, $habtmKeys)) {
                unset($scope['Grant.' . $foreignKeys[$foreignModel]]);
                if ($op != 'set') {
                    $scope[$joins[$foreignModel][0]['alias'] . '.' . $foreignKeys[$foreignModel]] = $foreignId;
                    $this->paginate['Grant']['joins'] = $joins[$foreignModel];
                }
            }
        } else {
            $foreignModel = '';
        }
        $this->set('scope', $scope);
        $this->paginate['Grant']['limit'] = 20;
        $items = $this->paginate($this->Grant, $scope);

        if ($op == 'set' && !empty($joins[$foreignModel]) && !empty($foreignModel) && !empty($foreignId) && !empty($items)) {
            foreach ($items AS $key => $item) {
                $items[$key]['option'] = $this->Grant->find('count', array(
                    'joins' => $joins[$foreignModel],
                    'conditions' => array(
                        'Grant.id' => $item['Grant']['id'],
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
        if (!$id || !$this->data = $this->Grant->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Grant->create();
            if ($this->Grant->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.Grant');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->write('form.Grant.data', $this->data);
                $this->Session->write('form.Grant.validationErrors', $this->Grant->validationErrors);
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
            if ($this->Grant->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.Grant');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->write('form.Grant.data', $this->data);
                $this->Session->write('form.Grant.validationErrors', $this->Grant->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->Grant->read(null, $id);
    }

    function admin_form($id = 0, $foreignModel = '') {
        $id = intval($id);
        if ($sessionFormData = $this->Session->read('form.Grant.data')) {
            $this->Grant->validationErrors = $this->Session->read('form.Grant.validationErrors');
            $this->Session->delete('form.Grant');
        }
        if ($id > 0) {
            $this->data = $this->Grant->read(null, $id);
            if (!empty($sessionFormData['Grant'])) {
                foreach ($sessionFormData['Grant'] AS $key => $val) {
                    if (isset($this->data['Grant'][$key])) {
                        $this->data['Grant'][$key] = $val;
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
        } else if ($this->Grant->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

    function admin_habtmSet($foreignModel = null, $foreignId = 0, $id = 0, $switch = null) {
        $habtmKeys = array(
            'Parliamentarian' => array(
                'associationForeignKey' => 'Parliamentarian_id',
                'foreignKey' => 'Grant_id',
                'alias' => 'GrantsParliamentarian',
            ),
        );
        $foreignModel = array_key_exists($foreignModel, $habtmKeys) ? $foreignModel : null;
        $foreignId = intval($foreignId);
        $id = intval($id);
        $switch = in_array($switch, array('on', 'off')) ? $switch : null;
        if (empty($foreignModel) || $foreignId <= 0 || $id <= 0 || empty($switch)) {
            $this->set('habtmMessage', __('Wrong Parameters'));
        } else {
            $habtmModel = &$this->Grant->$habtmKeys[$foreignModel]['alias'];
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
