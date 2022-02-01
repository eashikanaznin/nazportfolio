<?php

namespace Drupal\job_builder\Utils;

use \Drupal\node\Entity\Node;
use Drupal\Component\Serialization\Json;

class nodeImporter {

  public static function nodeGenerator($response){
    $response=Json::decode($response);
    $response=$response['vacancies'];

    $count=0;
    foreach($response as $res){
  //process date format before insertion
      $start_date = $res['startDate'];
      $timestamp = strtotime($start_date);
      $formatter = \Drupal::service('date.formatter');
      $formatted_date = $formatter->format($timestamp, 'custom', 'Y-m-d');

// Create node object and insert as data to oppoptunity content type
      $node = Node::create([
        'type'        => 'opportunity',
        'title'       =>  $res['title'],
        'field_opportunity_link'       =>  $res['vacancyUrl'],
        'field_possible_start_date'       =>  $formatted_date,
      ]);
      $node->save();
      $count++;
    }
    return $count;
  }



}
