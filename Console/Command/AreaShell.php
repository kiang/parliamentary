<?php

class AreaShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {
        $parliamentarians = $this->Parliamentarian->find('all', array(
            'fields' => array('id', 'district'),
            'contain' => array('Area' => array(
                    'fields' => array('id'),
                )),
        ));
        $areas = $this->Parliamentarian->Area->find('list', array(
            'fields' => array('name', 'id'),
            'conditions' => array('parent_id' => '0'),
        ));
        $a2p = array();
        foreach ($parliamentarians AS $parliamentarian) {
            $pAreas = explode('.', $parliamentarian['Parliamentarian']['district']);
            $aLinks = Set::combine($parliamentarian['Area'], '{n}.id', '{n}');

            foreach ($pAreas AS $pArea) {
                $pArea = trim($pArea);
                if (empty($pArea))
                    continue;
                if ($pArea !== '平地原住民' && mb_substr($pArea, -1, 1, 'utf-8') !== '區') {
                    $pArea .= '區';
                }
                if (!isset($areas[$pArea])) {
                    $this->Parliamentarian->Area->create();
                    if ($this->Parliamentarian->Area->save(array('Area' => array(
                                    'name' => $pArea,
                        )))) {
                        $areas[$pArea] = $this->Parliamentarian->Area->getInsertID();
                    }
                }

                $currentAreaId = $areas[$pArea];
                if (!isset($a2p[$currentAreaId])) {
                    $a2p[$currentAreaId] = array();
                }
                $a2p[$currentAreaId][] = $parliamentarian['Parliamentarian']['id'];
                if (!isset($aLinks[$currentAreaId])) {
                    $this->Parliamentarian->AreasParliamentarian->create();
                    $this->Parliamentarian->AreasParliamentarian->save(array('AreasParliamentarian' => array(
                            'Parliamentarian_id' => $parliamentarian['Parliamentarian']['id'],
                            'Area_id' => $currentAreaId,
                    )));
                }
            }
        }
        foreach ($a2p AS $areaId => $p) {
            $aLinks = $this->Parliamentarian->Area->AreasMotion->find('list', array(
                'fields' => array('Motion_id', 'Motion_id'),
                'conditions' => array(
                    'Area_id' => $areaId,
                ),
            ));
            $motions = $this->Parliamentarian->MotionsParliamentarian->find('list', array(
                'fields' => array('Motion_id', 'Motion_id'),
                'conditions' => array(
                    'Parliamentarian_id' => $p,
                    'type' => 'requester',
                ),
            ));
            foreach ($motions AS $motionId) {
                if (!isset($aLinks[$motionId])) {
                    $this->Parliamentarian->Area->AreasMotion->create();
                    $this->Parliamentarian->Area->AreasMotion->save(array('AreasMotion' => array(
                            'Area_id' => $areaId,
                            'Motion_id' => $motionId,
                    )));
                }
            }
        }
    }

}
