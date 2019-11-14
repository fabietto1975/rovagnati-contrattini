<?php

namespace backend\app\service;

use backend\app\dao\WaveSeriJakalaDAO;

class WaveSeriJakalaService {

    private $waveSeriJakalaDAO;

    public function __construct() {
        $this->waveSeriJakalaDAO = new WaveSeriJakalaDAO();
    }

    public function read() {
    }

    public function readWavesSeriJakalaByTipologia($tipologia) {
        $res = $this->waveSeriJakalaDAO->readWavesSeriJakalaByTipologia($tipologia);
        return array(
            'status' => 'success',
            'res' => $res
        );
    }

    public function readCurrentWavesSeriJakala() {
        $res = $this->waveSeriJakalaDAO->readCurrentWaves();
        return array(
            'status' => 'success',
            'res' => $res
        );
    }

    public function readElencoPremi($id_wave) {
        $wave = $this->waveSeriJakalaDAO->readByID($id_wave)[0];
        $tipologia_wave = $wave['tipologia_wave'];
        $res = $this->waveSeriJakalaDAO->readElencoPremi($id_wave, $tipologia_wave);
        return array(
            'status' => 'success',
            'res' => $res
        );
    }

}
