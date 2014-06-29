<?php

class MotionShell extends AppShell {

    public $uses = array('Parliamentarian');
    public $path = '';
    public $cacheFolder = '';
    public $listFolder = '';
    public $itemFolder = '';
    public $motionIdStack = array();

    public function main() {
        $this->pathInit();
        $this->getMotionIdStack();
        //$this->checkMotionIdStack();
        $this->processMotions();
        $this->importMotions();
        $this->matchParliamentarian();
        $this->updateParliamentarianCounter();
    }

    public function updateParliamentarianCounter() {
        $parliamentarians = $this->Parliamentarian->find('list');
        foreach ($parliamentarians AS $parliamentarianId => $parliamentarian) {
            $this->Parliamentarian->query("UPDATE parliamentarians SET count_submits = (SELECT COUNT(*) FROM motions_parliamentarians WHERE Parliamentarian_id = '{$parliamentarianId}' AND type = 'requester') WHERE id = '{$parliamentarianId}'");
            $this->Parliamentarian->query("UPDATE parliamentarians SET count_petitions = (SELECT COUNT(*) FROM motions_parliamentarians WHERE Parliamentarian_id = '{$parliamentarianId}' AND type = 'petition') WHERE id = '{$parliamentarianId}'");
        }
    }

    public function matchParliamentarian() {
        $parliamentarians = $this->Parliamentarian->find('list');
        foreach ($this->motionIdStack AS $motionId => $motionSummary) {
            $links = $this->Parliamentarian->MotionsParliamentarian->find('all', array(
                'conditions' => array('Motion_id' => $motionId),
            ));
            $links = Set::combine($links, '{n}.MotionsParliamentarian.Parliamentarian_id', '{n}.MotionsParliamentarian');
            $toMatchString1 = is_array($motionSummary['detail']['提案單位/人']) ? implode(",", $motionSummary['detail']['提案單位/人']) : $motionSummary['detail']['提案單位/人'];
            $toMatchString2 = is_array($motionSummary['detail']['連署人']) ? implode(",", $motionSummary['detail']['連署人']) : $motionSummary['detail']['連署人'];
            foreach ($parliamentarians AS $parliamentarianId => $parliamentarian) {
                if (false !== strpos($toMatchString1, $parliamentarian)) {
                    if (!isset($links[$parliamentarianId])) {
                        $this->Parliamentarian->MotionsParliamentarian->create();
                        $this->Parliamentarian->MotionsParliamentarian->save(array('MotionsParliamentarian' => array(
                                'Parliamentarian_id' => $parliamentarianId,
                                'Motion_id' => $motionId,
                                'type' => 'requester',
                        )));
                    } elseif ($links[$parliamentarianId]['type'] != 'requester') {
                        $this->Parliamentarian->MotionsParliamentarian->id = $links[$parliamentarianId]['id'];
                        $this->Parliamentarian->MotionsParliamentarian->save(array(
                            'type' => 'requester',
                        ));
                    }
                } elseif (false !== strpos($toMatchString2, $parliamentarian)) {
                    if (!isset($links[$parliamentarianId])) {
                        $this->Parliamentarian->MotionsParliamentarian->create();
                        $this->Parliamentarian->MotionsParliamentarian->save(array('MotionsParliamentarian' => array(
                                'Parliamentarian_id' => $parliamentarianId,
                                'Motion_id' => $motionId,
                                'type' => 'petition',
                        )));
                    } elseif ($links[$parliamentarianId]['type'] != 'petition') {
                        $this->Parliamentarian->MotionsParliamentarian->id = $links[$parliamentarianId]['id'];
                        $this->Parliamentarian->MotionsParliamentarian->save(array(
                            'type' => 'petition',
                        ));
                    }
                }
            }
        }
    }

    public function importMotions() {
        foreach ($this->motionIdStack AS $motionId => $motionSummary) {
            if ($this->Parliamentarian->Motion->find('count', array(
                        'conditions' => array('id' => $motionId),
                    )) === 0) {
                $this->Parliamentarian->Motion->create();
            } else {
                $this->Parliamentarian->Motion->id = $motionId;
            }
            $this->Parliamentarian->Motion->save(array('Motion' => array(
                    'id' => $motionId,
                    'sequence' => $motionSummary['detail']['議案屆次別'],
                    'type' => $motionSummary['detail']['大會類別'],
                    'group_type' => $motionSummary['detail']['審查會別'],
                    'number' => $motionSummary['detail']['案號'],
                    'source' => $motionSummary['detail']['提案類別'],
                    'requested_date' => $motionSummary['detail']['來文日期'],
                    'requested_number' => $motionSummary['detail']['來文字號'],
                    'requester' => is_array($motionSummary['detail']['提案單位/人']) ? implode(",", $motionSummary['detail']['提案單位/人']) : $motionSummary['detail']['提案單位/人'],
                    'petition_people' => is_array($motionSummary['detail']['連署人']) ? implode(",", $motionSummary['detail']['連署人']) : $motionSummary['detail']['連署人'],
                    'summary' => $motionSummary['detail']['主旨'],
                    'description' => $motionSummary['detail']['說明'],
                    'rules' => $motionSummary['detail']['辦法'],
                    'comments' => $motionSummary['detail']['審查意見'],
                    'result' => $motionSummary['detail']['大會決議'],
                    'status' => $motionSummary['detail']['辦理情形'],
                    'result_date' => $motionSummary['detail']['決議日期'],
                    'posting_date' => $motionSummary['detail']['發文日期'],
                    'posting_number' => $motionSummary['detail']['發文字號'],
                    'attachments' => $motionSummary['detail']['議會附件一'],
            )));
        }
    }

    public function processMotions() {
        foreach ($this->motionIdStack AS $motionId => $motionSummary) {
            $itemCacheFile = $this->itemFolder . '/' . str_replace('-', '/', $motionId);
            if (!file_exists(dirname($itemCacheFile))) {
                mkdir(dirname($itemCacheFile), 0777, true);
            }
            if (!file_exists($itemCacheFile)) {
                file_put_contents($itemCacheFile, file_get_contents('http://www.tncc.gov.tw/motions/page.asp?mainid=' . $motionId));
            }
            $itemContent = file_get_contents($itemCacheFile);
            $itemContent = substr($itemContent, strpos($itemContent, '"table2">') + 10);
            $itemContent = substr($itemContent, 0, strpos($itemContent, '</table>'));
            $lines = explode('</tr>', $itemContent);
            $result = array();
            foreach ($lines AS $lineKey => $lineVal) {
                $lineVal = str_replace('</th>', '</td>', $lineVal);
                $lineCols = explode('</td>', $lineVal);
                switch ($lineKey) {
                    case 8:
                        $lineCols[1] = str_replace('<br>', "\n", $lineCols[1]);
                        break;
                }
                foreach ($lineCols AS $k => $lineCol) {
                    $lineCols[$k] = trim(strip_tags($lineCol));
                }
                switch ($lineKey) {
                    case 5:
                        $lineCols[1] = explode(' ', $lineCols[1]);
                        break;
                    case 6:
                        $lineCols[1] = str_replace(' ', '', $lineCols[1]);
                        $lineCols[1] = explode(',', $lineCols[1]);
                        break;
                }

                switch ($lineKey) {
                    case 0:
                    case 1:
                        // 4 cols
                        $result[$lineCols[0]] = $lineCols[1];
                        $result[$lineCols[2]] = $lineCols[3];
                        break;
                    case 17:
                        //skip
                        break;
                    default:
                        // 2 cols
                        $result[$lineCols[0]] = $lineCols[1];
                }
            }
            $this->motionIdStack[$motionId]['detail'] = $result;
        }
    }

    public function checkMotionIdStack() {
        foreach ($this->motionIdStack AS $motionId => $motionSummary) {
            if ($this->Parliamentarian->Motion->find('count', array(
                        'conditions' => array(
                            'id' => $motionId,
                        ),
                    )) > 0) {
                unset($this->motionIdStack[$motionId]);
            }
        }
    }

    public function getMotionIdStack() {
        $finalPage = 142;
        $finalPageUpdated = false;

        for ($i = 1; $i <= $finalPage; $i++) {
            $url = 'http://www.tncc.gov.tw/motions/default1.asp?status=^&menu1=A00000&topage=' . $i;
            $cacheFile = $this->listFolder . '/' . md5($url);
            if (!file_exists($cacheFile)) {
                file_put_contents($cacheFile, file_get_contents($url));
            }
            $listContent = file_get_contents($cacheFile);
            if (false === $finalPageUpdated) {
                $pageParts = explode('topage=', $listContent);
                foreach ($pageParts AS $pagePart) {
                    $pagePart = substr($pagePart, 0, 50);
                    if (false !== strpos($pagePart, 'menu1')) {
                        $getPage = intval(substr($pagePart, 0, strpos($pagePart, '&')));
                        if ($getPage > $finalPage) {
                            $finalPage = $getPage;
                        }
                    }
                }
                $finalPageUpdated = true;
            }
            $listContent = substr($listContent, strpos($listContent, 'id="printa"') + 12);
            $listContent = substr($listContent, 0, strpos($listContent, '</table>'));
            $listLines = explode('</tr>', $listContent);
            foreach ($listLines AS $listLine) {
                $cols = explode('</td>', $listLine);
                if (false === strpos($cols[0], 'mainid=')) {
                    continue;
                }
                unset($cols[9]);
                foreach ($cols AS $k => $col) {
                    switch ($k) {
                        case 0:
                            //example: 1A1F7251-3CD8-4AE6-BB97-6C3A021D9351
                            $tmpString = explode('mainid={', $col);
                            $cols[$k] = substr($tmpString[1], 0, 36);
                            break;
                        default:
                            $cols[$k] = trim(strip_tags($col));
                    }
                }
                $this->motionIdStack[$cols[0]] = $cols;
            }
        }
    }

    public function pathInit() {
        $this->path = TMP . 'motions';
        $this->cacheFolder = $this->path . '/cache';
        $this->listFolder = $this->cacheFolder . '/motions_list';
        $this->itemFolder = $this->cacheFolder . '/motions_item';
        if (!file_exists($this->listFolder)) {
            mkdir($this->listFolder, 0777, true);
        }
        if (!file_exists($this->itemFolder)) {
            mkdir($this->itemFolder, 0777, true);
        }
    }

}
