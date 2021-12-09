<?php
namespace App\Http\Service;

use Illuminate\Support\Facades\Validator;
use App\Exceptions\ValidateException;

class XmlToHtmlFormService {


    public function buildFormContent($filename)
    {
        $xml_fields = new SimpleXmlElement($filename, 0, true);
        $html = '';

        foreach ($xml_fields as $field) {
            $attributes = $field->attributes();
            $html .= '<label for="'.$attributes['name'].'">'.$attributes['label'].'</label>'.PHP_EOL;

            if ('text' == $attributes['type']) {
                $html .= '<input type="text" name="'.$attributes['name'].'" />'.PHP_EOL;
            } else {
                $html .= $this->buildOptionInputs($field);
            }
        }

        return $html;
    }


    protected function buildOptionInputs($field)
    {
        $html = '';
        $attributes = $field->attributes();
        foreach ($field->option as $option) {
            $html .= '<input type="radio" name="'.$attributes['name'].'" value="'.$option.'" />'.PHP_EOL;
        }
        return $html;
    }
}

// Uncomment below to actually see the output, this works with your xml file.
// $converter = new XmlToHtmlFormConverter;
// echo $converter->buildFormContent('form.xml');
