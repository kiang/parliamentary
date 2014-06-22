<?php

class StatShell extends AppShell {

    public $uses = array('Parliamentarian');

    public function main() {
        $parliamentarians = $this->Parliamentarian->find('list');
        foreach ($parliamentarians AS $parliamentarianId => $parliamentarian) {
            $this->Parliamentarian->query("UPDATE parliamentarians SET count_submits = (SELECT COUNT(*) FROM motions WHERE requester LIKE '%{$parliamentarian}%') WHERE id = '{$parliamentarianId}'");
            $this->Parliamentarian->query("UPDATE parliamentarians SET count_petitions = (SELECT COUNT(*) FROM motions WHERE petition_people LIKE '%{$parliamentarian}%') WHERE id = '{$parliamentarianId}'");
        }
    }

}
