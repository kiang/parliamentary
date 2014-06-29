<?php

class MatchShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {
        $parliamentarians = $this->Parliamentarian->find('list');
        $motions = $this->Parliamentarian->Motion->find('all');
        foreach ($motions AS $motion) {
            $links = $this->Parliamentarian->MotionsParliamentarian->find('all', array(
                'conditions' => array('Motion_id' => $motion['Motion']['id']),
            ));
            $links = Set::combine($links, '{n}.MotionsParliamentarian.Parliamentarian_id', '{n}.MotionsParliamentarian');
            foreach ($parliamentarians AS $parliamentarianId => $parliamentarian) {
                if (false !== strpos($motion['Motion']['requester'], $parliamentarian)) {
                    if (!isset($links[$parliamentarianId])) {
                        $this->Parliamentarian->MotionsParliamentarian->create();
                        $this->Parliamentarian->MotionsParliamentarian->save(array('MotionsParliamentarian' => array(
                                'Parliamentarian_id' => $parliamentarianId,
                                'Motion_id' => $motion['Motion']['id'],
                                'type' => 'requester',
                        )));
                    } elseif($links[$parliamentarianId]['type'] != 'requester') {
                        $this->Parliamentarian->MotionsParliamentarian->id = $links[$parliamentarianId]['id'];
                        $this->Parliamentarian->MotionsParliamentarian->save(array(
                            'type' => 'requester',
                        ));
                    }
                } elseif (false !== strpos($motion['Motion']['petition_people'], $parliamentarian)) {
                    if (!isset($links[$parliamentarianId])) {
                        $this->Parliamentarian->MotionsParliamentarian->create();
                        $this->Parliamentarian->MotionsParliamentarian->save(array('MotionsParliamentarian' => array(
                                'Parliamentarian_id' => $parliamentarianId,
                                'Motion_id' => $motion['Motion']['id'],
                                'type' => 'petition',
                        )));
                    } elseif($links[$parliamentarianId]['type'] != 'petition') {
                        $this->Parliamentarian->MotionsParliamentarian->id = $links[$parliamentarianId]['id'];
                        $this->Parliamentarian->MotionsParliamentarian->save(array(
                            'type' => 'petition',
                        ));
                    }
                }
            }
        }
    }

}
