<?php

namespace backend\app\rest\controllers;

use backend\common\rest\controllers\AbstractController;
use backend\app\service\ProfiloClienteService;

class ProfiloClienteController__AopProxied extends AbstractController {

    /**
     * @api {get} /rest/profiloCliente/:id_cliente/:id_wave (a) Richiesta dati relativi profilo cliente 
     * 
     * @apiName GetProfiloCliente
     * @apiGroup ProfiloCliente
     * 
     * @apiParam {String} id_cliente                            Id cliente
     * @apiParam {String} id_wave                               Id wave
     *
     * @apiSuccess {String='success','fail'}                    status                      Esito della richiesta .
     * @apiSuccess {String}                                     code                        Status code HTTP
     * @apiSuccess {String}                                     request_time                Timestamp relativo alla ricezione della richiesta.
     * @apiSuccess {String}                                     response_time               Timestamp relativo alla generazione della risposta.
     * @apiSuccess {Object[]}                                   profilocliente              Dati famiglia prodotto
     * @apiSuccess {String}                                     id_wave                     Id wave
     * @apiSuccess {String}                                     id_domanda                  Id domanda
     * @apiSuccess {String}                                     area_domanda                Area logica della domanda (es: "LOCATION, TIPO LOCALE, APERTURA, GESIONE, POSIZIONAMENTO...")
     * @apiSuccess {String}                                     ordine_domanda              Ordine di sequenza della domanda (all'interno dell'area)
     * @apiSuccess {String}                                     testo_domanda               Testo della domanda
     * @apiSuccess {String}                                     valori_risposta             Valori ammissibili per la risposta (string unica in formato id:valore;id:valore)
     * @apiSuccess {String}                                     max_risposte_ammesse        Numero massimo di valori ammissibili (-1: nessun limite) 
     * @apiSuccess {String='RADIO','CHECK','TESTO','SELECT'}    tipo_domanda                Tipo domanda
     * @apiSuccess {String}                                     id_risposta                 Id risposta (eventualmente null)
     * @apiSuccess {String}                                     valore_risposta             Valore (stringa) del dato fornito in risposta (id della particolare scelta in caso di domanda
     *
     * 
     * @apiSuccessExample Success-Response:
     * 
     * {
     *    "request_time": "Mon Jun 20 14:34:39 CEST 2016",
     *    "code": 200,
     *    "response_time": "Mon Jun 20 14:34:39 CEST 2016",
     *    "status": "success",
     *    "profilocliente": [
     *        {
     *            "id_wave": "1",
     *            "id_domanda": "3",
     *            "area_domanda": "LOCATION",
     *            "ordine_domanda": "3",
     *            "testo_domanda": "Tipo via",
     *            "tipo_domanda": "RADIO",
     *            "valori_risposta": "1:Commerciale;2:Residenziale",
     *            "max_risposte_ammesse": "1",
     *            "id_risposta": null,
     *            "valore_risposta": null,
     *            "id_cliente": "2"
     *        },
     *        {
     *            "id_wave": "1",
     *            "id_domanda": "4",
     *            "area_domanda": "LOCATION",
     *            "ordine_domanda": "4",
     *            "testo_domanda": "Popolazione prevalente zona",
     *            "tipo_domanda": "RADIO",
     *            "valori_risposta": "1:Residenziale;2:Lavorativa;3:Mista",
     *            "max_risposte_ammesse": "1",
     *            "id_risposta": null,
     *            "valore_risposta": null,
     *            "id_cliente": "2"
     *        },
     *        {
     *            "id_wave": "1",
     *            "id_domanda": "5",
     *            "area_domanda": "LOCATION",
     *            "ordine_domanda": "5",
     *            "testo_domanda": "In un raggio di 200-300 metri sono presenti",
     *            "tipo_domanda": "RADIO",
     *            "valori_risposta": "1:Centro commerciale;2:Scuola-Università;3:Stazione ferroviaria;4:Stazione bus;5:Grandi uffici-fabbriche;6:Ospedale;7:Struttura sportiva;8:Mercato;9:Banche;10:Uffici postali",
     *            "max_risposte_ammesse": null,
     *            "id_risposta": null,
     *            "valore_risposta": null,
     *            "id_cliente": "2"
     *        }
     * 	]
     * }	
     * */
    private $profiloClienteService;

    public function __construct($request) {
        parent::__construct($request);
        $this->profiloClienteService = new ProfiloClienteService();
    }

    public function getAction() {
        if (isset($this->request->url_elements [2])) {
            $id_cliente = $this->request->url_elements [2];
            $res = $this->profiloClienteService->readProfilo($id_cliente);
            
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                $this->getResultData($res, 'profilocliente', $res['message']);
            } else {
                $this->getResultData($res, 'profilocliente', null);
            }
        } else {
            $res = $this->profiloClienteService->readElencoProfili();
            
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
                $this->getResultData($res, 'profilocliente', $res['message']);
            } else {
                $this->getResultData($res, 'profilocliente', null);
            }
        }
        return $this->data;
    }

    public function postAction() {
        
    }

    public function deleteAction() {
        
    }

    public function putAction () {
        if (isset($this->request->url_elements [2])) {
            $id_profilo = $this->request->url_elements [2];
            $id_cliente = $this->request->parameters['id_cliente'];
            
            $res = $this->profiloClienteService->setProfiloCliente($id_cliente, $id_profilo);
            if (isset($res['error'])) {
                $this->data['code'] = AbstractController::HTTP_CODE_NOTFOUND;
            } 
            $this->getResultData($res, 'profilocliente', null); 
        }
        return $this->data;                
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\rest\\controllers\\ProfiloClienteController.php';

