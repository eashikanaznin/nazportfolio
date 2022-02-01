<?php
namespace Drupal\drunine_api\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class drunineController {
  public function drunine() {



    $htm='';
    $nids=array();
 //foreach ($nodes as $node) {
    $nids = \Drupal::entityQuery('node')->condition('type','article')->execute();
    $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);
    $n_array=array();
    foreach($nodes as $node){
      $title =$node->label();
      $nid =$node->id();
      $body = $node->get('body')->getValue();

      $n_array[]=array("id"=>$nid,
        "body"=>$body,
        "title"=>$title);
    }

  // $body = $node->get('body')->getValue();

   // echo '<pre>';
   //   print_r($nodes);
  //die();
 // $htm.= $title.'\n';
//}

    // return array(
    //   '#markup' => 'Welcome to our DRUNINE.\n'.$htm
    // );
    return new JsonResponse(
      $n_array
    );
  }
}
