<?php

namespace Drupal\job_builder\Controller;

use Drupal\Core\Controller\ControllerBase;

/**
 * Returns responses for job_builder routes.
 */
class JobBuilderController extends ControllerBase {

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
