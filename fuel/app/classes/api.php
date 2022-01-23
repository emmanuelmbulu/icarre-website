<?php
class Api
{
	public static function toJSONResponse($data, $status = 200)
    {
        //$data = (object)$data;
		$responsebody = Format::forge($data)->to_json();
		
		$content_type = 'application/json';
		
        $response = new Response();
        $response->set_status($status);
        $response->body($responsebody);
        $response->set_header('Content-Type', $content_type);
        $response->set_header('Pragma', 'no-cache');
        $response->send_headers();
        $response->send();
		die();
    }	
	
	
	public static function toXMLResponse($data = null, $structure = null, $basenode = null, $use_cdata = null, $bool_representation = null, $status = 200)
    {
        //$data = (object)$data;
		$responsebody = Format::forge($data)->to_xml($data,$structure,$basenode, $use_cdata, $bool_representation);
		
		$content_type = 'application/xml';
		
        $response = new Response();
        $response->set_status($status);
        $response->body($responsebody);
        $response->set_header('Content-Type', $content_type);
        $response->set_header('Pragma', 'no-cache');
        $response->send_headers();
        $response->send();
		die();
    }	
	
	
	public static function toPreResponse($data)
    {
        echo "<pre>";
		echo print_r($data, true);
		echo "</pre>";
		
		die();
    }
}