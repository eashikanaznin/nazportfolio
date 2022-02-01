<?php

namespace Drupal\pink\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for pinky routes.
 */
class PinkController extends ControllerBase {

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
