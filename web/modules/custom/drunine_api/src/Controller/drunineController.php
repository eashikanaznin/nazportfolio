<?php
namespace Drupal\drunine_api\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class drunineController {
  public function drunine() {
$node_array = array();
$query = \Drupal::entityQuery('node');
$query->condition('status', 1);
$query->condition('type', 'article');
$entity_ids = $query->execute();
$nodes = \Drupal::entityTypeManager()->getStorage('node')->loadMultiple($entity_ids);
$htm='';
 foreach ($nodes as $node) {
  $title = $node->getTitle();
  $body = $node->get('body')->getValue();

  $node_array[] = array(
'node_title' => $title,

//'node_body' => $body,
);
  $htm.= $title.'\n';
}

    // return array(
    //   '#markup' => 'Welcome to our DRUNINE.\n'.$htm
    // );
    return new JsonResponse([
      // 'data' => $htm,
      // 'method' => 'GET',
      // "userId"=>1,
      // "id"=>1,
      // "title"=>"MY Aurora"
      "title_arr"=>$node_array
    ]);
  }
}