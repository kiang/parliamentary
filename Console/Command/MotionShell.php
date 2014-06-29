<?php

class MatchShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {
        $parliamentarians = $this->Parliamentarian->find('list');
        $motions = $this->Parliamentarian->Motion->find('all');
        foreach($motions AS $motion) {
            $links = $this->Parliamentarian->MotionsParliamentarian->find('list', array(
                'conditions' => array('Motion_id' => $motion['Motion']['id']),
                'fields' => array('id', 'Parliamentarian_id'),
            ));
            $toMatchString = $motion['Motion']['petition_people'] . $motion['Motion']['requester'];
            foreach($parliamentarians AS $parliamentarianId => $parliamentarian) {
                if(false !== strpos($toMatchString, $parliamentarian) && !isset($links[$parliamentarianId])) {
                    $this->Parliamentarian->MotionsParliamentarian->create();
                    $this->Parliamentarian->MotionsParliamentarian->save(array('MotionsParliamentarian' => array(
                        'Parliamentarian_id' => $parliamentarianId,
                        'Motion_id' => $motion['Motion']['id'],
                    )));
                }
            }
        }
    }

}
