define({ "api": [
  {
    "type": "get",
    "url": "/rest/rilevazione/famigliaprodotto/:id_famiglia",
    "title": "(b) Richiesta dati relativi al dettaglio famiglia prodotto",
    "name": "GetFamigliaProdotto",
    "group": "FamiglieProdotto",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id_famiglia",
            "description": "<p>Id famiglia prodotto</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Status code HTTP</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "famigliaprodotto",
            "description": "<p>Dati famigliaprodotto</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Id famiglia</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "desc_famiglia",
            "description": "<p>Desc famiglia prodotto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n  \"request_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"code\": 200,\n  \"response_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"status\": \"success\",\n  \"famigliaprodotto\": [\n       {\n           \"id\": \"8\",\n           \"desc_famiglia\": \"COTTO\"\n       }\n   ]\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/FamigliaProdottoController.php",
    "groupTitle": "FamiglieProdotto"
  },
  {
    "type": "get",
    "url": "/rest/rilevazione/famigliaprodotto",
    "title": "(a) Richiesta dati relativi alle famiglie prodotto",
    "name": "GetFamiglieProdotto",
    "group": "FamiglieProdotto",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Status code HTTP</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "famigliaprodotto",
            "description": "<p>Dati famiglia prodotto</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Id famiglia</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "desc_famiglia",
            "description": "<p>Desc famiglia prodotto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n  \"request_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"code\": 200,\n  \"response_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"status\": \"success\",\n  \"famigliaprodotto\": [\n       {\n           \"id\": \"8\",\n           \"desc_famiglia\": \"COTTO\"\n       },\n       {\n           \"id\": \"9\",\n           \"desc_famiglia\": \"CRUDI\"\n       },\n       {\n           \"id\": \"10\",\n           \"desc_famiglia\": \"MORTADELLA\"\n       },\n       {\n           \"id\": \"11\",\n           \"desc_famiglia\": \"SALAME\"\n       },\n       {\n           \"id\": \"12\",\n           \"desc_famiglia\": \"PANCETTA\"\n       },\n       {\n           \"id\": \"13\",\n           \"desc_famiglia\": \"ALTRI PRODOTTI SUINI\"\n       },\n       {\n           \"id\": \"14\",\n           \"desc_famiglia\": \"ALTRI PRODOTTI NON SUINI\"\n       }\n   ]\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/FamigliaProdottoController.php",
    "groupTitle": "FamiglieProdotto"
  },
  {
    "type": "get",
    "url": "/rest/rilevazione/famigliaprodotto/:id_famiglia/tipoprodotto",
    "title": "(c) Richiesta dati relativi ai tipi prodotto collegati alla data famiglia prodotto",
    "name": "GetTipiProdotto",
    "group": "FamiglieProdotto",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id_famiglia",
            "description": "<p>Id famiglia prodotto</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Status code HTTP</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "tipoprodotto",
            "description": "<p>Dati tipo prodotto</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_tipo_prodotto",
            "description": "<p>Id id_tipo_prodotto</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "desc_tipo_prodotto",
            "description": "<p>Desc tipo prodotto</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n  \"request_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"code\": 200,\n  \"response_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"status\": \"success\",\n   \"tipoprodotto\": [\n       {\n           \"id_tipo_prodotto\": \"327\",\n           \"desc_tipo_prodotto\": \"AROMATIZZATO O ARROSTO-BRACE\"\n       },\n       {\n           \"id_tipo_prodotto\": \"340\",\n           \"desc_tipo_prodotto\": \"LISCIO\"\n       }\n   ]\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/FamigliaProdottoController.php",
    "groupTitle": "FamiglieProdotto"
  },
  {
    "type": "get",
    "url": "/rest/concorrente",
    "title": "(a) Elenco concorrenti",
    "name": "Concorrente",
    "group": "GetConcorrente",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Status code HTTP</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "rilevazione",
            "description": "<p>Dati rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Id rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data_inizio",
            "description": "<p>Data inizio validita' rilevazione (YYYY-mm-dd)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data_fine",
            "description": "<p>Data termine validita' rilevazione (YYYY-mm-dd)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_famiglia",
            "description": "<p>Id famiglia prodotto (cat. merceologica) oggetto della rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "descrizione_famiglia",
            "description": "<p>Desc famiglia prodotto (cat. merceologica) oggetto della rilevazione</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n  \"request_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"code\": 200,\n  \"response_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"status\": \"success\",\n  \"concorrente\": [\n     {\n         \"id\": \"4\",\n         \"desc_concorrente\": \"CONCORRENTE1\"\n     },\n     {\n         \"id\": \"14\",\n         \"desc_concorrente\": \"CONCORRENTE21\"\n     }]",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/ConcorrenteController.php",
    "groupTitle": "GetConcorrente"
  },
  {
    "type": "get",
    "url": "/rest/profiloCliente/:id_cliente/:id_wave",
    "title": "(a) Richiesta dati relativi profilo cliente",
    "name": "GetProfiloCliente",
    "group": "ProfiloCliente",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id_cliente",
            "description": "<p>Id cliente</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id_wave",
            "description": "<p>Id wave</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Status code HTTP</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "profilocliente",
            "description": "<p>Dati famiglia prodotto</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_wave",
            "description": "<p>Id wave</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_domanda",
            "description": "<p>Id domanda</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "area_domanda",
            "description": "<p>Area logica della domanda (es: &quot;LOCATION, TIPO LOCALE, APERTURA, GESIONE, POSIZIONAMENTO...&quot;)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "ordine_domanda",
            "description": "<p>Ordine di sequenza della domanda (all'interno dell'area)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "testo_domanda",
            "description": "<p>Testo della domanda</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "valori_risposta",
            "description": "<p>Valori ammissibili per la risposta (string unica in formato id:valore;id:valore)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "max_risposte_ammesse",
            "description": "<p>Numero massimo di valori ammissibili (-1: nessun limite)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'RADIO'",
              "'CHECK'",
              "'TESTO'",
              "'SELECT'"
            ],
            "optional": false,
            "field": "tipo_domanda",
            "description": "<p>Tipo domanda</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_risposta",
            "description": "<p>Id risposta (eventualmente null)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "valore_risposta",
            "description": "<p>Valore (stringa) del dato fornito in risposta (id della particolare scelta in caso di domanda</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n   \"request_time\": \"Mon Jun 20 14:34:39 CEST 2016\",\n   \"code\": 200,\n   \"response_time\": \"Mon Jun 20 14:34:39 CEST 2016\",\n   \"status\": \"success\",\n   \"profilocliente\": [\n       {\n           \"id_wave\": \"1\",\n           \"id_domanda\": \"3\",\n           \"area_domanda\": \"LOCATION\",\n           \"ordine_domanda\": \"3\",\n           \"testo_domanda\": \"Tipo via\",\n           \"tipo_domanda\": \"RADIO\",\n           \"valori_risposta\": \"1:Commerciale;2:Residenziale\",\n           \"max_risposte_ammesse\": \"1\",\n           \"id_risposta\": null,\n           \"valore_risposta\": null,\n           \"id_cliente\": \"2\"\n       },\n       {\n           \"id_wave\": \"1\",\n           \"id_domanda\": \"4\",\n           \"area_domanda\": \"LOCATION\",\n           \"ordine_domanda\": \"4\",\n           \"testo_domanda\": \"Popolazione prevalente zona\",\n           \"tipo_domanda\": \"RADIO\",\n           \"valori_risposta\": \"1:Residenziale;2:Lavorativa;3:Mista\",\n           \"max_risposte_ammesse\": \"1\",\n           \"id_risposta\": null,\n           \"valore_risposta\": null,\n           \"id_cliente\": \"2\"\n       },\n       {\n           \"id_wave\": \"1\",\n           \"id_domanda\": \"5\",\n           \"area_domanda\": \"LOCATION\",\n           \"ordine_domanda\": \"5\",\n           \"testo_domanda\": \"In un raggio di 200-300 metri sono presenti\",\n           \"tipo_domanda\": \"RADIO\",\n           \"valori_risposta\": \"1:Centro commerciale;2:Scuola-Università;3:Stazione ferroviaria;4:Stazione bus;5:Grandi uffici-fabbriche;6:Ospedale;7:Struttura sportiva;8:Mercato;9:Banche;10:Uffici postali\",\n           \"max_risposte_ammesse\": null,\n           \"id_risposta\": null,\n           \"valore_risposta\": null,\n           \"id_cliente\": \"2\"\n       }\n\t]\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/ProfiloClienteController.php",
    "groupTitle": "ProfiloCliente"
  },
  {
    "type": "get",
    "url": "/rest/rilevazione/rilevazionecorrente",
    "title": "(a) Richiesta dati relativi alla rilevazione concorrenza attualmente attiva",
    "name": "Rilevazione",
    "group": "Rilevazione",
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Status code HTTP</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "rilevazione",
            "description": "<p>Dati rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id",
            "description": "<p>Id rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data_inizio",
            "description": "<p>Data inizio validita' rilevazione (YYYY-mm-dd)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data_fine",
            "description": "<p>Data termine validita' rilevazione (YYYY-mm-dd)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_famiglia",
            "description": "<p>Id famiglia prodotto (cat. merceologica) oggetto della rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "descrizione_famiglia",
            "description": "<p>Desc famiglia prodotto (cat. merceologica) oggetto della rilevazione</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n  \"request_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"code\": 200,\n  \"response_time\": \"Mon May 30 19:13:55 CEST 2016\",\n  \"status\": \"success\",\n  \"rilevazione\": {\n      \"id\": \"4\",\n      \"data_inizio\": \"2015-04-01 00:00:00\",\n      \"data_fine\": \"2016-12-31 00:00:00\",\n      \"id_famiglia\": \"12\",\n      \"descrizione_famiglia\": \"PANCETTA\"\n  }",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/RilevazioneController.php",
    "groupTitle": "Rilevazione"
  },
  {
    "type": "get",
    "url": "/rest/rilevazione/:id_cliente/:id_rilevazione",
    "title": "(b) Richiesta dati relativi scheda di rilevazione concorrenza",
    "name": "SchedaRilevazione",
    "group": "Rilevazione",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id_cliente",
            "description": "<p>Identificativo cliente oggetto della rilevazione (come da risposta di /rest/users/login)</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "id_rilevazione",
            "description": "<p>Identificativo rilevazione (come da risposta di /rest/rilevazione/rilevazionecorrente)</p>"
          }
        ]
      }
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Status code HTTP</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "rilevazione",
            "description": "<p>Dati scheda di rilevazione prodotti</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_rilevazione",
            "description": "<p>Id rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_scheda_rilevazione",
            "description": "<p>Id scheda di rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_cliente",
            "description": "<p>Id cliente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_utente",
            "description": "<p>Id utente (come da risposta /rest/users/login)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Username (come da risposta /rest/users/login)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data_inizio_validita",
            "description": "<p>Data iinzio validita' rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data_fine_validita",
            "description": "<p>Data iinzio fine rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data_creazione_scheda",
            "description": "<p>Categoria merceologica</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "data_ultimo_aggiornamento_scheda",
            "description": "<p>Data ultimo aggiornamento scheda rilevazione</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "id_dati_prodotto",
            "description": "<p>Id record</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "prezzo_prodotto",
            "description": "<p>Prezzo del prodotto</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "ordine_prodotto",
            "description": "<p>Ordine item</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "prodotto_in_promozione",
            "description": "<p>Flag (0/1) prodotto in promo</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "prodotto_top_seller",
            "description": "<p>Flag (0/1) prodotto top sell</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n  \"request_time\": \"Tue May 31 10:09:34 CEST 2016\",\n  \"code\": 200,\n  \"response_time\": \"Tue May 31 10:09:34 CEST 2016\",\n  \"status\": \"success\",\n  \"rilevazione\":    [\n {\n       \"id_rilevazione\": \"4\",\n       \"id_scheda_rilevazione\": \"0\",\n       \"id_cliente\": \"1\",\n       \"id_utente\": \"1\",\n       \"username\": \"user9002\",\n       \"categoria_merceologica\": \"PANCETTA\",\n       \"data_inizio_validita\": \"2015-04-01 00:00:00\",\n       \"data_fine_validita\": \"2016-12-31 00:00:00\",\n       \"data_creazione_scheda\": \"2016-05-30 00:00:00\",\n       \"data_ultimo_aggiornamento_scheda\": \"2016-05-30 00:00:00\",\n       \"id_dati_prodotto\": \"3\",\n       \"prezzo_prodotto\": \"2121.00\",\n       \"ordine_prodotto\": \"0\",\n       \"prodotto_in_promozione\": \"1\",\n       \"prodotto_top_seller\": \"1\"\n    },\n           {\n        \"id_rilevazione\": \"4\",\n        \"id_scheda_rilevazione\": \"0\",\n        \"id_cliente\": \"1\",\n        \"id_utente\": \"1\",\n        \"username\": \"user9002\",\n        \"categoria_merceologica\": \"PANCETTA\",\n        \"data_inizio_validita\": \"2015-04-01 00:00:00\",\n        \"data_fine_validita\": \"2016-12-31 00:00:00\",\n        \"data_creazione_scheda\": \"2016-05-30 00:00:00\",\n        \"data_ultimo_aggiornamento_scheda\": \"2016-05-30 00:00:00\",\n        \"id_dati_prodotto\": \"1\",\n        \"prezzo_prodotto\": \"233.00\",\n        \"ordine_prodotto\": \"1\",\n        \"prodotto_in_promozione\": \"1\",\n        \"prodotto_top_seller\": \"0\"\n     }\n  ]\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/RilevazioneController.php",
    "groupTitle": "Rilevazione"
  },
  {
    "type": "post",
    "url": "/rest/token",
    "title": "(a) Richiesta token per autenticazione WS",
    "name": "Token",
    "group": "Token",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Username</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"username\":\"USERNAME\",\n    \"password\":\"PASSWORD\"\t\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "code",
            "description": "<p>Status code HTTP</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "token",
            "description": "<p>Token da utilizzare per le autenticazioni</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n    \"request_time\": \"Tue May 31 8:48:03 CEST 2016\",\n    \"code\": 200,\n    \"response_time\": \"Tue May 31 8:48:03 CEST 2016\",\n    \"status\": \"success\"\n    \"token\": \"eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzUxMiJ9.eyJpYXQiOjE0NjQ2NzcyODMsImp0aSI6IlhnVG9ibzBsWlM4T3hnaDR0bTJaMWxGWTk3bUF2NERZbkFIanJxZVdUNGc9IiwiaXNzIjoiaHR0cDpcL1wvYXBwcy52YWx1ZWxhYi5pdCIsIm5iZiI6MTQ2NDY3NzI4MywiZXhwIjoxNDY0NzYzNjgzLCJkYXRhIjp7InVzZXJOYW1lIjoicml2YWxleCJ9fQ.ymL353UNJJdBSooOrkdDPPsfYyqp5r2ZL8sJvyfwWkzOjdxlynbIBxyCQatywBnNjuhOREyPaTXJkA5uS_kjEw\"\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/TokenController.php",
    "groupTitle": "Token"
  },
  {
    "type": "post",
    "url": "/rest/users/login",
    "title": "(a) Login Utente",
    "name": "LoginUtente",
    "group": "Utente",
    "parameter": {
      "fields": {
        "Parameter": [
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "username",
            "description": "<p>Username</p>"
          },
          {
            "group": "Parameter",
            "type": "String",
            "optional": false,
            "field": "password",
            "description": "<p>Password</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Request-Example:",
          "content": "{\n    \"username\":\"USERNAME\",\n    \"password\":\"PASSWORD\"\t\n}",
          "type": "json"
        }
      ]
    },
    "success": {
      "fields": {
        "Success 200": [
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'success'",
              "'fail'"
            ],
            "optional": false,
            "field": "status",
            "description": "<p>Esito della richiesta .</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "request_time",
            "description": "<p>Timestamp relativo alla ricezione della richiesta.</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "response_time",
            "description": "<p>Timestamp relativo alla generazione della risposta.</p>"
          },
          {
            "group": "Success 200",
            "type": "Object",
            "optional": false,
            "field": "utente",
            "description": "<p>Profilo utente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.id",
            "description": "<p>Id dell'utente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.nome",
            "description": "<p>Nome dell'utente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.username",
            "description": "<p>Username dell'utente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "allowedValues": [
              "'AGENTE'",
              "'ISPETTORE'",
              "'CAPOAREA'"
            ],
            "optional": false,
            "field": "utente.ruolo",
            "description": "<p>Ruolo dell'utente</p>"
          },
          {
            "group": "Success 200",
            "type": "Object[]",
            "optional": false,
            "field": "utente.cliente",
            "description": "<p>Lista dei clienti (punti vendita) associati all'utente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.cliente.id",
            "description": "<p>Id cliente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.cliente.nome",
            "description": "<p>Nome del cliente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.cliente.cognome",
            "description": "<p>Cognome del cliente</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.cliente.via",
            "description": "<p>Indirizzo del cliente (via)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.cliente.cap",
            "description": "<p>Indirizzo del cliente (cap)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.cliente.citta",
            "description": "<p>Indirizzo del cliente (citta)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.cliente.provincia",
            "description": "<p>Indirizzo del cliente (provincia)</p>"
          },
          {
            "group": "Success 200",
            "type": "String",
            "optional": false,
            "field": "utente.cliente.cod_fisc",
            "description": "<p>Codice fiscale/PIVA del cliente</p>"
          }
        ]
      },
      "examples": [
        {
          "title": "Success-Response:",
          "content": "\n{\n  \"request_time\": \"Tue May 10 11:25:31 CEST 2016\",\n  \"code\": 200,\n  \"response_time\": \"Tue May 10 11:25:31 CEST 2016\",\n  \"status\": \"success\",\n  \"utente\":    {\n     \"id\": \"282\",\n     \"username\": \"userisp9490\",\n     \"ruolo\": \"ISPETTORE\",\n     \"id_agente\": null,\n     \"id_ispettore\": \"20\",\n     \"id_capoarea\": null,\n     \"cliente\":       [\n                 {\n           \"id\": \"373\",\n           \"cod_cliente\": \"30918\",\n           \"nome\": \"AGI MARKET S.N.C. DI BULLA GIROLAMO & C.\",\n           \"cognome\": null,\n           \"via\": \"VIA DANTE 5/B\",\n           \"cap\": \"25020\",\n           \"citta\": \"DELLO\",\n           \"provincia\": \"BS\",\n           \"cod_fisc\": \"629610981\",\n           \"id_agente\": \"55\",\n           \"id_ispettore\": \"20\",\n           \"id_capoarea\": \"2\"\n        },\n        {\n           \"id\": \"748\",\n           \"cod_cliente\": \"32053\",\n           \"nome\": \"ALIMENTARI TIRABOSCHI\",\n           \"cognome\": \"ROBERTO S.N.C.\",\n           \"via\": \"VIA PERLETTI 1\",\n           \"cap\": \"24013\",\n           \"citta\": \"OLTRE IL COLLE\",\n           \"provincia\": \"BG\",\n           \"cod_fisc\": \"1630860169\",\n           \"id_agente\": \"48\",\n           \"id_ispettore\": \"20\",\n           \"id_capoarea\": \"2\"\n        }\n     ]\n  }\n}",
          "type": "json"
        }
      ]
    },
    "version": "0.0.0",
    "filename": "d:/xampp-5.6.3/htdocs/rilevazioni/backend/app/rest/controllers/UserController.php",
    "groupTitle": "Utente"
  }
] });
