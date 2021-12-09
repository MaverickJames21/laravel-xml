<?php
namespace App\Services;

use Illuminate\Support\Facades\Validator;
use App\http\api\XMLReaderController;


class XMLReaderService {

  /**
   * Validate fields from request.
   *
   * @param  array $fields
   * @param  array $validatorRules
   * @return void
   */
  public function XmlReader()
  {


         // get route xml document.

      $xmlString = file_get_contents(public_path('streha_mcd_03.xml'));
         //load xml doc to string

      $xmlObject = simplexml_load_string($xmlString);

      $json = json_encode($xmlObject);
      $phpArray = json_decode($json, true);

      dd($phpArray);


    }
}








// public function array_to_xml(array $data, \SimpleXMLElement $xml) {
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
//
