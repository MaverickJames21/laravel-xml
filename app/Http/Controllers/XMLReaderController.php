<?php

namespace App\Http\Controllers;

use App\Http\Service\XmlToHtmlFormService;
use App\Http\Service\EmployeeService;
use App\Http\Service\CreateXmlService;


class XMLReaderController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */



    protected $xml_to_html_form_converter;
    protected $createXmlService;


    public function __construct(XmlToHtmlFormService $xml_to_html_form_converter,
                                CreateXmlService $createXmlService,
                                EmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
        $this->createXmlService =  $createXmlService;
        $this->xml_to_html_form_converter = $xml_to_html_form_converter;
    }


    public function index()
    {

        //    return User::all();
        // $xmlObject = $this->XMLReaderService->allUser();
       // return XMLReaderService::collection($xmlObject);

        $xmlString = file_get_contents(public_path('streha_mcd_03.xml'));
        $xmlObject = simplexml_load_string($xmlString);

        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true);

        dd($phpArray);

            // return some view
    }


    //  Get data from XML to array
    public function readxml()
    {
        $data = $this->employeeService->readXML();
        return response()->json($data);
    }

    //  Get data from XML to array
    public function createxml()
    {
        $data = $this->employeeService->readXML();
        $this->createXmlService->createXML($data, 'nouveaufichier.xml');
        return response()->json();
    }







/*
    //  public function array_to_xml(array $data, \SimpleXMLElement $xml) {
        // foreach ($data as $key => $value) {
            // if (is_array($value)) {
                // if (is_numeric($key)) {
                    // $key = 'item' . $key; //dealing with <0/>..<n/> issues
                // }
                // $subnode = $xml->addChild($key);
                // $this->array_to_xml($value, $subnode);
            // } else {
                // $xml->addChild("$key", htmlspecialchars("$value"));
            // }
        // }
    // }
//
    // public function siteMap()
        // {
    // $data = array(
            // 'bla' => 'blub',
            // 'foo' => 'bar',
            // 'another_array' => array(
            // 'stack' => 'overflow',
            // ),
        // );
//
        // $xml_template_info = new \SimpleXMLElement("<?xml version=\"1.0\"?><template></template>");
        // $this->array_to_xml($data, $xml_template_info);
        // $xml_template_info->asXML(dirname(__FILE__) . "/sitemap.xml");
        // header('Content-type: text/xml');
        // die(readfile(dirname(__FILE__) . "/sitemap.xml"));
    or return readfile(dirname(__FILE__) . "/sitemap.xml");
        // }
    // }
//
*/


}
