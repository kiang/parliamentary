<?php

class PartiesController extends AppController {

    public $name = 'Parties';
    public $paginate = array();
    public $helpers = array();

    function index() {
        $this->paginate['Party'] = array(
            'limit' => 20,
        );
        $this->set('items', $this->paginate($this->Party));
    }

    function view($id = null) {
        if (!$id || !$this->data = $this->Party->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_index() {
        $this->paginate['Party'] = array(
            'limit' => 20,
        );
        $this->set('items', $this->paginate($this->Party));
    }

    function admin_view($id = null) {
        if (!$id || !$this->data = $this->Party->read(null, $id)) {
            $this->Session->setFlash(__('Please do following links in the page', true));
            $this->redirect(array('action' => 'index'));
        }
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Party->create();
            if ($this->Party->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.Party');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->write('form.Party.data', $this->data);
                $this->Session->write('form.Party.validationErrors', $this->Party->validationErrors);
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
            if ($this->Party->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->Session->delete('form.Party');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->write('form.Party.data', $this->data);
                $this->Session->write('form.Party.validationErrors', $this->Party->validationErrors);
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->Party->read(null, $id);
    }

    function admin_form($id = 0, $foreignModel = '') {
        $id = intval($id);
        if ($sessionFormData = $this->Session->read('form.Party.data')) {
            $this->Party->validationErrors = $this->Session->read('form.Party.validationErrors');
            $this->Session->delete('form.Party');
        }
        if ($id > 0) {
            $this->data = $this->Party->read(null, $id);
            if (!empty($sessionFormData['Party'])) {
                foreach ($sessionFormData['Party'] AS $key => $val) {
                    if (isset($this->data['Party'][$key])) {
                        $this->data['Party'][$key] = $val;
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
        } else if ($this->Party->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

}
