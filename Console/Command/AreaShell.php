<?php

class AreaShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {
        $parliamentarians = $this->Parliamentarian->find('all', array(
            'fields' => array('id', 'district'),
            'contain' => array('Area'),
        ));
        $areas = $this->Parliamentarian->Area->find('list', array(
            'fields' => array('name', 'id'),
            'conditions' => array('parent_id' => '0'),
        ));
        foreach($parliamentarians AS $parliamentarian) {
            $pAreas = explode('.', $parliamentarian['Parliamentarian']['district']);
            $aLinks = Set::combine($parliamentarian['Area'], '{n}.Area_id', '{n}');
            foreach($pAreas AS $pArea) {
                if($pArea !== '平地原住民' && mb_substr($pArea, -1, 1, 'utf-8') !== '區') {
                    $pArea .= '區';
                }
                if(!isset($areas[$pArea])) {
                    $this->Parliamentarian->Area->create();
                    if($this->Parliamentarian->Area->save(array('Area' => array(
                        'name' => $pArea,
                    )))) {
                        $areas[$pArea] = $this->Parliamentarian->Area->getInsertID();
                    }
                }
                
                $currentAreaId = $areas[$pArea];
                if(!isset($aLinks[$currentAreaId])) {
                    $this->Parliamentarian->AreasParliamentarian->create();
                    $this->Parliamentarian->AreasParliamentarian->save(array('AreasParliamentarian' => array(
                        'Parliamentarian_id' => $parliamentarian['Parliamentarian']['id'],
                        'Area_id' => $currentAreaId,
                    )));
                }
            }
        }
    }

}
