<?php

class TermsController extends AppController {

    public $name = 'Terms';
    public $paginate = array();
    public $helpers = array();

    function index() {
        $this->paginate['Term'] = array(
            'limit' => 20,
        );
        $this->set('items', $this->paginate($this->Term));
    }

    function admin_index($termId = '', $isActive = '1') {
        if (!empty($termId)) {
            $this->Term->id = $termId;
            $this->Term->saveField('is_active', $isActive);
        }
        $this->paginate['Term'] = array(
            'limit' => 20,
            'order' => array(
                'Term.is_active' => 'DESC',
                'Term.count' => 'DESC',
            ),
        );
        $this->set('items', $this->paginate($this->Term));
    }

    function admin_add() {
        if (!empty($this->data)) {
            $this->Term->create();
            if ($this->Term->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
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
            if ($this->Term->save($this->data)) {
                $this->Session->setFlash(__('The data has been saved', true));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('Something was wrong during saving, please try again', true));
            }
        }
        $this->set('id', $id);
        $this->data = $this->Term->read(null, $id);
    }

    function admin_delete($id = null) {
        if (!$id) {
            $this->Session->setFlash(__('Please do following links in the page', true));
        } else if ($this->Term->delete($id)) {
            $this->Session->setFlash(__('The data has been deleted', true));
        }
        $this->redirect(array('action' => 'index'));
    }

}
