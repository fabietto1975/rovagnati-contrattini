<?php

namespace backend\app\service;

class FirmaService {

    public function __construct() {
        
    }

    public function upload($id_contrattino, $parameters) {

        if (isset($parameters['files']['firma_agente']) && isset($parameters['files']['firma_cliente'])) {
            $file_agente = $parameters['files']['firma_agente'];
            $file_cliente = $parameters['files']['firma_cliente'];
            $res_cliente = $this->saveUploadedFile($file_cliente, $id_contrattino . '_cliente');
            $res_agente = $this->saveUploadedFile($file_agente, $id_contrattino . '_agente');
            if (($res_cliente['status'] == 'KO') || ($res_agente['status'] == 'KO')) {
                $status = 'KO';
                return array(
                    'status' => 'KO',
                    'error' => 'Errore nel caricamento dei file di firma : '. ($res_cliente['status']=='KO'?$res_cliente['error']:''). ' '  . ($res_agente['status']=='KO'?$res_agente['error']:''),
                    'message' => 'Errore nel caricamento dei file di firma'
                );
            }
            return array(
                'status' => 'OK',
                'res' => 'OK',
                'message' => $file_agente['name'] . " e ".$file_cliente['name'].": caricamento completato con successo "

            );
        } else {
            return array(
                'status' => 'KO',
                'message' => 'Fornire sia la firma agente che la firma cliente',
                'error' => 'Fornire sia la firma agente che la firma cliente'
            );
        }
    }

    private function saveUploadedFile($file, $nomeTargetFile) {
        include \Go\Instrument\Transformer\FilterInjectorTransformer::rewrite((APP_ROOT . '/config/config-local.php'), 'D:\xampp-5.6.3\htdocs\rilevazioni\backend\app\service');
        $targetDir = $contrattini['firmeDir'];
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
