<?php

namespace Drupal\lorem_ipsum\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for Lorem ipsum routes.
 */
class LoremIpsumController extends ControllerBase {

  /**
   * Builds the response.
   */
  public function build() {

    $build['content'] = [
      '#type' => 'item',
      '#markup' => $this->t('It works!'),
    ];

    return $build;
  }

}
