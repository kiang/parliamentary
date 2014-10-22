<?php

class ExportShell extends AppShell {

    public $uses = array('Motion');

    public function main() {
        $this->bills();
    }

    public function bills() {
        $motions = $this->Motion->find('all');
        $bills = array();
        foreach ($motions AS $motion) {
            $motion['Motion']['requester'] = str_replace(array('、', ' ', ',,'), array(',', ',', ','), $motion['Motion']['requester']);
            $motion['Motion']['requester'] = explode(',', $motion['Motion']['requester']);
            foreach ($motion['Motion']['requester'] AS $k => $v) {
                if (empty(trim($v))) {
                    unset($motion['Motion']['requester'][$k]);
                }
            }
            $motion['Motion']['requester'] = array_values($motion['Motion']['requester']);
            $motion['Motion']['petition_people'] = str_replace(array('、', ' ', ',,'), array(',', ',', ','), $motion['Motion']['petition_people']);
            $motion['Motion']['petition_people'] = explode(',', $motion['Motion']['petition_people']);
            foreach ($motion['Motion']['petition_people'] AS $k => $v) {
                if (empty(trim($v))) {
                    unset($motion['Motion']['petition_people'][$k]);
                }
            }
            $motion['Motion']['petition_people'] = array_values($motion['Motion']['petition_people']);
            $bills[] = array(
                'category' => $motion['Motion']['group_type'],
                'bill_no' => $motion['Motion']['number'],
                'description' => $motion['Motion']['description'],
                'proposed_by' => $motion['Motion']['requester'],
                'petitioned_by' => $motion['Motion']['petition_people'],
                'election_year' => '2010',
                'abstract' => $motion['Motion']['summary'],
                'links' => 'http://www.tncc.gov.tw/motions/page.asp?mainid=' . $motion['Motion']['id'],
                'county' => '臺南市',
                'motions' => array(
                    array(
                        'motion' => '來文',
                        'date' => $motion['Motion']['requested_date'],
                        'resolution' => '',
                        'no' => $motion['Motion']['requested_number'],
                    ),
                    array(
                        'motion' => '收文',
                        'date' => NULL,
                        'resolution' => NULL,
                    ),
                    array(
                        'motion' => '發文',
                        'date' => $motion['Motion']['posting_date'],
                        'resolution' => '',
                        'no' => $motion['Motion']['posting_number'],
                    ),
                    array(
                        'motion' => '委員會審查意見',
                        'date' => NULL,
                        'resolution' => $motion['Motion']['comments'],
                    ),
                    array(
                        'motion' => '大會議決',
                        'date' => $motion['Motion']['result_date'],
                        'resolution' => $motion['Motion']['result'],
                        'sitting' => $motion['Motion']['sequence'],
                    ),
                ),
                'execution' => $motion['Motion']['status'],
                'type' => $motion['Motion']['source'],
                'id' => $motion['Motion']['id'],
            );
        }
        file_put_contents(__DIR__ . '/data/bills.json', json_encode($bills));
    }

}
