<?php

namespace Drupal\job_builder\Utils;

use Drupal\Component\Serialization\Json;


class CurlGenerator {
  public static function curlFunction($api_key,$url){
    //fetch the total number of record first; then fetch all records if server permits

    //initializing curl
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_URL => $url,
      CURLOPT_SSL_VERIFYPEER => 0,
      CURLOPT_CUSTOMREQUEST => "GET",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "host: api.apprenticeships.education.gov.uk",
        "ocp-apim-subscription-key: ".$api_key,
        "x-version: 1"
      ),
    ));
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    if ($err) {
      \Drupal::messenger()->addMessage("cURL Error #:".$err);
      return FALSE;
    } else {
      return $response;
    }
  }

  public static function curlreq(){
    //fetching the API key from the key module
    $api_key=\Drupal::service('key.repository')->getKey('displayadvartapi')->getKeyValue();
    $url="https://api.apprenticeships.education.gov.uk/vacancies/vacancy?_format=json&DistanceInMiles=40&Lat=51.49962&Lon=-0.13573&Sort=DistanceAsc";

    //calling first time to get the total number of records; then fetching the records
    $res= self::curlFunction($api_key,$url);
    if($res){
      $res=Json::decode($res);
      $item_total=$res['totalFiltered'];
      //second call with the item number
      $res= self::curlFunction($api_key,$url.'&PageSize='.$item_total);
      return $res;
    }
  }

}
