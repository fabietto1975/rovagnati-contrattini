<?php

namespace backend\app\service;

use backend\app\dao\ClienteDAO;

class ImageService {
    
    private $clienteDAO;

    public function __construct() {
        $this->clienteDAO = new ClienteDAO();
    }

    public function upload($id_cliente, $id_image, $parameters, $area, $coordinate) {
        if (isset($parameters['files']['immagine'])) {            
            
            $image = $parameters['files']['immagine'];
            
            $res = $this->saveUploadedFile($image, 'IMG_' . $id_cliente . '_' . $area.'_'.$id_image);
            
            if ($res['status'] == 'KO') {
                $status = 'KO';
                return array(
                    'status' => 'KO',
                    'error' => 'Errore nel caricamento dell\'immagine : ' . $res['error'],
                    'message' => 'Errore nel caricamento dell\'immagine'
                );
            }
            
            $coord_txt = '';
            if (isset($coordinate['latitudine']) && isset($coordinate['longitudine'])) {
   
                $coord_db = $this->clienteDAO->readCoordinateRilevate($id_cliente);
                if($coord_db[0]['latitudine_rilevata']==null || ($coord_db[0]['longitudine_rilevata']==null)) {                    

                    $this->clienteDAO->updateCoordinateRilevate($id_cliente, $coordinate);                    
                    $coord_txt = ' Coordinate anagrafica aggiornate.';
                }                
            }
            
            return array(
                'status' => 'OK',
                'res' => 'OK',
                'message' => $image['name'] . ": caricamento completato con successo." . $coord_txt

            );
        } else {
            return array(
                'status' => 'KO',
                'message' => 'File immagine non recepito correttamente',
                'error' => 'File immagine non recepito correttamente'
            );
        }
    }

    private function saveUploadedFile($file, $nomeTargetFile) {
        include(APP_ROOT . '/config/config-local.php');
        $targetDir = $contrattini['imageDir'];
        $imageFileType = pathinfo($file['name'], PATHINFO_EXTENSION);
          
        if ($file['type'] != 'image/png') {

            return array(
                'status' => 'KO',
                'message' => $file['name'] . ' ha estensione non ammessa',
                'error' => $file['name'] . ' ha estensione non ammessa'
            );
        } else {
            $check = getimagesize($file["tmp_name"]);
            if ($check == false) {
                return array(
                    'status' => 'KO',
                    'error' => $file['name'] . ' è un immagine non valida',
                    'message' => $file['name'] . ' è un immagine non valida'
                );
            } else {
                $targetFile = $targetDir . '\\' . $nomeTargetFile . '.' . $imageFileType;
                if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                    return array(
                        'status' => 'OK'
                    );
                } else {
                    return array(
                        'status' => 'KO',
                        'error' => $file['name'] . ": errore nell'upload del file ",
                        'message' => $file['name'] . ": errore nell'upload del file "
                    );
                }
            }
        }
    }

}
