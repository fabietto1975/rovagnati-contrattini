<?php

namespace backend\app\dao;

use backend\common\dao\DAOAbstract;
use backend\common\dao\DAOInterface;

class ProdottoRovagnatiDAO__AopProxied extends DAOAbstract implements DAOInterface {

    public function __construct() {
        parent::__construct();
    } 

    public function create($item) {
        //NOP
    }

    public function delete($id) {
        //NOP
    }

    public function readProdottoRovagnatiPerLivello($id_livello, $filtro) {
        if ($filtro == null){
            $where = "where divisione in ('GASTRONOMIA', 'LIBERO SERVIZIO', 'DIVERSIFICAZIONE', 'TAKE AWAY')"; 
        } else {
            $where = "where divisione in (";
            foreach($filtro as $div){
                $where .= "'".strtoupper($div)."'";
                if (end($filtro)!=$div){
                    $where .= ',';
                }
            }
            $where .= ')';
        }

        
        switch ($id_livello) {
            case "5":
                $sql = "select codice_articolo as cod_item, concat('(',codice_articolo,') - ',descrizione) as descr_item from anagrafica_prodotti_rovagnati ".$where." and codice_articolo in (select codice_articolo from anagrafica_listino_rovagnati where tipolistino = 'det') group by descrizione, codice_articolo order by prodotto;";
                break;
            case "4":
                $sql = "select cod_tipo as cod_item, tipo as descr_item from anagrafica_prodotti_rovagnati ".$where." group by tipo, cod_tipo order by tipo;";
                break;
            case "3":
                $sql = "select cod_linea as cod_item, linea as descr_item from anagrafica_prodotti_rovagnati ".$where." group by linea, cod_linea order by linea;";
                break;
            case "2":
                $sql = "select cod_famiglia as cod_item, famiglia as descr_item from anagrafica_prodotti_rovagnati ".$where."  group by famiglia, cod_famiglia order by famiglia;";
                break;
            case "1":
                $sql = "select cod_divisione as cod_item, divisione as descr_item  from anagrafica_prodotti_rovagnati ".$where." group by divisione, cod_divisione order by divisione;";
                break;
            /*
            case "6":
                $sql = "select distinct (descrizione) as ITEM from anagrafica_prodotti_rovagnati ".$where." order by descrizione;";
                break;
*/
            default:
                break;
        }
        print_r($sql);
        die();
        $stmt = $this->getPdo()->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll();
        
    }

    public function update($item) {
         //NOP
    }

    public function readByID($id) {
        
    }

    public function read() {
        $stmt = $this->getPdo()->prepare("select * from anagrafica_prodotti_rovagnati order by codice_articolo;");
        $stmt->execute();
        return $stmt->fetchAll();
    }

}
include_once AOP_CACHE_DIR . '/_proxies/backend\\app\\dao\\ProdottoRovagnatiDAO.php';

