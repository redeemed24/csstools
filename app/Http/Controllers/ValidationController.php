<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use XmlParser;

use Curl;

class ValidationController extends Controller
{
	public $w3c = "http://jigsaw.w3.org/css-validator/validator?output=soap12&uri=";

    public function css(Request $request){
    	
    	$validator = Validator::make($request->all(), [ //validation
            'url' => 'required|url'
        ]);

        if ($validator->fails()) { //url format is invalid
            return redirect()->back()->withErrors($validator);
        }
        
        $data['url'] =  $request->url;

        $file = 'results/' . time() . '.xml';

        $data['response'] = Curl::to($this->w3c . $request->url)->withContentType('application/soap+xml')->download($file); //access w3school API
      
       	$xml = simplexml_load_string(file_get_contents(url('/') . '/' . $file)); //parse XML File
    	
       	foreach($xml->children('http://www.w3.org/2003/05/soap-envelope') as $el){
		    if ($el->getName() == 'Body'){
		      	foreach($el->children('http://www.w3.org/2005/07/css-validator') as $m){
		      		$data['results'] = $m->result;
		      	}
		    }
		}

		
        return view('results', $data); //display view
    }
}
