<?php


namespace App\Http\Service;

use Illuminate\Http\Request;
use DOMAttr;

class CreateXmlService {


    public function createXML($data, $filename) {

        //create the xml document
        $xmlDoc = new \DOMDocument();
		$xmlDoc->encoding = 'utf-8';
		$xmlDoc->xmlVersion = '1.0';
        $xmlDoc->standalone = 'no';
		$xmlDoc->formatOutput = true;

// -------

        // Create root.
        $root = $xmlDoc->createElement('invoice:request');
		$root->setAttributeNode(new DOMAttr('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance'));
        // Create invoice processing.
        $invoice_processing = $xmlDoc->createElement('invoice:processing');
        $invoice_transport = $xmlDoc->createElement('invoice:transport');
        // Set attribute node invoice:transport and invoice:via
        $invoice_transport->setAttributeNode(new DOMAttr('from', 7601001302112));
        $invoice_transport->setAttributeNode(new DOMAttr('to', 7634567890000));
        $invoice_via = $xmlDoc->createElement('invoice:via');
        $invoice_via->setAttributeNode(new DOMAttr('via', 2000012345678));
        $invoice_via->setAttributeNode(new DOMAttr('sequence_id', 1));
        // save child invoice:via which is in invoice:transport THEN invoice:transport which is in invoice:processing
        $invoice_transport->appendChild($invoice_via);
        $invoice_processing->appendChild($invoice_transport);
        // Save invoice processing in $root
        $root->appendChild($invoice_processing);

// -------


        // Create invoice:payload
        $invoice_payload = $xmlDoc->createElement('invoice:payload');
        // Set attribute node invoice:payload
        $invoice_payload->setAttributeNode(new DOMAttr('type', 'invoice'));
        $invoice_payload->setAttributeNode(new DOMAttr('copy', 0));
        $invoice_payload->setAttributeNode(new DOMAttr('storno', 0));
        // Create invoice:invoice
        $invoice_invoice = $xmlDoc->createElement('invoice:invoice');
        // Set attribute node invoice:invoice
        $invoice_invoice->setAttributeNode(new DOMAttr('request_timestamp', 1619688895));
        $invoice_invoice->setAttributeNode(new DOMAttr('request_date', '2021-04-25T00:00:00'));
        $invoice_invoice->setAttributeNode(new DOMAttr('request_id', 2936699385));
        // save child invoice:invoice which is in invoice:playload
        $invoice_payload->appendChild($invoice_invoice);



// ------

        // Create invoice:body which is in invoice:payload
        $invoice_body = $xmlDoc->createElement('invoice:body');
        // Set attribute node invoice:invoice
        $invoice_body->setAttributeNode(new DOMAttr('role', 'hospital'));
        $invoice_body->setAttributeNode(new DOMAttr('place', 'hospital'));

// -----

        /**
         * Create invoice prolog.
         */

        // Create invoice:prolog which is in invoice:payload
        $invoice_prolog = $xmlDoc->createElement('invoice:prolog');
        $invoice_package = $xmlDoc->createElement('invoice:package');

        // Set attribute node invoice:package
        $invoice_package->setAttributeNode(new DOMAttr('name', 'GeneralInvoiceRequestTest'));
        $invoice_package->setAttributeNode(new DOMAttr('copyright', 'suva 2000-21'));
        $invoice_package->setAttributeNode(new DOMAttr('version', '100021'));

        // Create invoice:depends_on which is in invoice:generator
        $invoice_generator = $xmlDoc->createElement('invoice:generator');
        $invoice_depends_on = $xmlDoc->createElement('invoice:depends_on');

        // Set attribute node invoice:generator and invoice:depends_on
        $invoice_generator->setAttributeNode(new domAttr('name','GeneralInvoiceRequestManager 4.50.019'));
        $invoice_generator->setAttributeNode(new domAttr('copyright','suva 2000-21'));
        $invoice_generator->setAttributeNode(new domAttr('version',450));
        $invoice_depends_on->setAttributeNode(new domAttr('name','drgValidator ATL Module'));
        $invoice_depends_on->setAttributeNode(new domAttr('copyright','Suva'));
        $invoice_depends_on->setAttributeNode(new domAttr('version',100));
        $invoice_depends_on->setAttributeNode(new domAttr('id',1007090101));

        // save child invoice:depends_on which is in invoice:generator
        $invoice_generator->appendChild($invoice_depends_on);
        $invoice_prolog->appendChild($invoice_generator);

        // save child invoice:package which is in invoice:prolog
        $invoice_prolog->appendChild($invoice_package);
        $invoice_body->appendChild($invoice_prolog);


        /**
         * Create invoice invoice:remark.
         */

        // Create invoice:remark with texte Between tag/node(balise) wich is in invoice:payload
        $texte_remark= 'Lorem ipsum per nostra mi fune torectum mikonstra.diloru si limus mer fin per od per nostra mi fune torectum mi konstradiloru si limus mer fin itorectum mi konstradiloruko.';
        $invoice_remark = $xmlDoc->createElement('invoice:remark', $texte_remark);
        // save child invoice:remark which is in invoice:payload
        $invoice_body->appendChild($invoice_remark);


        /**
         * Create invoice invoice:invoice_tiers_payant.
         */

        // Create invoice:biller which is in invoice:tiers_payant
        $invoice_tiers_payant = $xmlDoc->createElement('invoice:invoice_tiers_payant');
        $invoice_biller = $xmlDoc->createElement('invoice:biller');

        // Set attribute node invoice:biller which is in invoice:tiers_payant
        $invoice_biller->setAttributeNode(new domAttr('ean_party',2011234567890));
        $invoice_biller->setAttributeNode(new domAttr('zsr','H121111'));
        $invoice_biller->setAttributeNode(new domAttr('uid_number','CHE108791452'));

        // Create invoice:company which is in invoice:biller
        $invoice_company = $xmlDoc->createElement('invoice:company');
        $invoice_company_name = $xmlDoc->createElement('invoice:companyname', 'Biller AG');
        $invoice_company->appendChild($invoice_company_name);
        $invoice_department = $xmlDoc->createElement('invoice:department', 'Abteilung Inkasso');
        $invoice_company->appendChild($invoice_department);
        $invoice_postal = $xmlDoc->createElement('invoice:postal');
        $invoice_street = $xmlDoc->createElement('invoice:street', 'Billerweg 128');
        $invoice_zip = $xmlDoc->createElement('invoice:zip', 4414);
        $invoice_city = $xmlDoc->createElement('invoice:city', 'Frenkendorf');
        $invoice_postal->appendChild($invoice_street);
        $invoice_postal->appendChild($invoice_zip);
        $invoice_postal->appendChild($invoice_city);
        $invoice_company->appendChild($invoice_postal);
        $invoice_biller->appendChild($invoice_company);



        // save child invoice:depends_on which is in invoice:generator
        $invoice_tiers_payant->appendChild($invoice_biller);
        $invoice_body->appendChild($invoice_tiers_payant);

// -----

/*
        $invoice_company_name = $xmlDoc->createElement('invoice:companyname');
        // $invoice_department = $xmlDoc->createElement('invoice:department');
        // Set attribute node invoice:company/companyname/departement which is in invoice:biller
        $invoice_biller->appendChild($invoice_company);
        $invoice_payload->appendChild($invoice_biller);


// -----


        // Create invoice:debitore which is in invoice:biller

        $invoice_debitor = $xmlDoc->createElement('invoice:debitor');

        $invoice_debitor->setAttributeNode(new domAttr('ean_party',7634567890000));



        $invoice_payload->appendChild($invoice_debitor);



// -----


         // Create invoice:provider which is in invoice:payload

        $invoice_provider = $xmlDoc->createElement('invoice:provider');

        $invoice_provider->setAttributeNode(new domAttr('ean_party',7634567890111));
        $invoice_provider->setAttributeNode(new domAttr('zsr','P123456'));




        $invoice_payload->appendChild($invoice_provider);

// -----


         // Create invoice:provider which is in invoice:payload

         $invoice_insurance = $xmlDoc->createElement('invoice:insurance');

         $invoice_insurance->setAttributeNode(new domAttr('ean_party',7634567890000));




         $invoice_payload->appendChild($invoice_insurance);
*/
// -----

        /*

        // Create invoice:biller which is in invoice:tiers_payant
        $invoice_service = $xmlDoc->createElement('invoice:invoice_service');

        // Set attribute node invoice:biller which is in invoice:tiers_payant
        $invoice_service->setAttributeNode(new domAttr('record_id',1));
        $invoice_service->setAttributeNode(new domAttr('tariff_type',020));
        $invoice_service->setAttributeNode(new domAttr('code','TR11A'));
        $invoice_service->setAttributeNode(new domAttr('session',1));
        $invoice_service->setAttributeNode(new domAttr('quantity',1));
        $invoice_service->setAttributeNode(new domAttr('date_begin','2021-02-10T00:00:00'));

        $invoice_service->setAttributeNode(new domAttr('ean_party',2011234567890));
        $invoice_service->setAttributeNode(new domAttr('ean_party',2011234567890));

        // save child invoice:depends_on which is in invoice:generator
        $invoice_body->appendChild($invoice_service);
        */

        // Save save.
        $invoice_payload->appendChild($invoice_body);

        // Save payload.
        $root->appendChild($invoice_payload);








































// ---------- End of processus
        // Save XML to file.
        $xmlDoc->appendChild($root);
        $xmlDoc->save(public_path($filename));

        return $xmlDoc;


    }

}





        /*
        $title = $data['title'];
        $rowCount = count($data['patient']);


        $root = $xmlDoc->appendChild($xmlDoc->createElement("patien_info"));
        $root->appendChild($xmlDoc->createElement("title",$title));
        $root->appendChild($xmlDoc->createElement("totalRows",$rowCount));
        $tabUsers = $root->appendChild($xmlDoc->createElement('rows'));

        foreach($data['patients'] as $patient){
            if(!empty($patient)){
                $tabUser = $tabUsers->appendChild($xmlDoc->createElement('patient'));
                foreach($patient as $key=>$val){
                    $tabUser->appendChild($xmlDoc->createElement($key, $val));
                }
            }
        }

        header("Content-Type: text/plain");

        //make the output pretty
        $xmlDoc->formatOutput = true;

        //save xml file
        $file_name = str_replace(' ', '_',$title).'_'.time().'.xml';
        $xmlDoc->save("files/" . $file_name);

        //return xml file name
        return $file_name;
        */



?>


