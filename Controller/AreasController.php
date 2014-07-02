<?php

class AreasController extends AppController {

    public $name = 'Areas';
    public $components = array('Paginator');

    function admin_index($parentId = 0) {
        $parentId = intval($parentId);
        $this->Paginator->settings['Area']['limit'] = 20;
        $items = $this->Paginator->paginate($this->Area, array('Area.parent_id' => $parentId));
        $this->set('items', $items);
        $this->set('url', array($parentId));
        $this->set('parentId', $parentId);
        if ($parentId > 0) {
            $this->set('parents', $this->Area->getPath($parentId, array('id', 'name')));
        }
    }

    function admin_add($parentId = 0) {
        if (!empty($this->request->data)) {
            $areaNames = explode("\n", $this->request->data['Area']['name']);
            $counter = 0;
            foreach ($areaNames AS $areaName) {
                $areaName = trim($areaName);
                if (!empty($areaName)) {
                    $this->Area->create();
                    if ($this->Area->save(array('Area' => array(
                                    'parent_id' => $parentId,
                                    'name' => $areaName,
                                    )))) {
                        ++$counter;
                    }
                }
            }
            $this->Session->setFlash("新增了 {$counter} 筆資料");
            $this->redirect(array('action' => 'index', $parentId));
        }
        $this->set('parentId', $parentId);
    }

    function admin_edit($id = null) {
        if (!$id && empty($this->request->data)) {
            $this->Session->setFlash('請依據網頁指示操作');
            $this->redirect('/');
        }
        if (!empty($this->request->data)) {
            if ($this->Area->save($this->request->data)) {
                $this->Session->setFlash('資料已經儲存');
                $this->Session->delete('form.Area');
                $this->redirect(array('action' => 'index', $this->request->data['Area']['parent_id']));
            } else {
                $this->Session->write('form.Area.data', $this->request->data);
                $this->Session->write('form.Area.validationErrors', $this->Area->validationErrors);
                $this->Session->setFlash('資料儲存失敗，請重試');
            }
        }
        $this->set('id', $id);
        $this->request->data = $this->Area->read(null, $id);
    }

    function admin_form($id = 0, $foreignModel = '') {
        $id = intval($id);
        if ($sessionFormData = $this->Session->read('form.Area.data')) {
            $this->Area->validationErrors = $this->Session->read('form.Area.validationErrors');
            $this->Session->delete('form.Area');
        }
        if ($id > 0) {
            $this->request->data = $this->Area->read(null, $id);
            if (!empty($sessionFormData)) {
                foreach ($sessionFormData AS $key => $val) {
                    if (isset($this->request->data['Area'][$key])) {
                        $this->request->data['Area'][$key] = $val;
                    }
                }
            }
            $parents = $this->Area->generateTreeList(array('Area.id !=' => $id));
            $parents[0] = '最上層';
            $this->set('parents', $parents);
        } else if (!empty($sessionFormData)) {
            $this->request->data = $sessionFormData;
        }
        $this->set('id', $id);
        $this->set('foreignModel', $foreignModel);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash('請依據網頁指示操作');
        } else if ($this->Area->delete($id)) {
            $this->Session->setFlash('資料已經刪除');
        }
        $this->redirect(array('action' => 'index'));
    }

}