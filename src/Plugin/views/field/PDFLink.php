<?php

/**
 * @file
 * Definition of Drupal\digitalia_muni_view_field\Plugin\views\field\PDFLink.
 */

namespace Drupal\digitalia_muni_view_field\Plugin\views\field;

use Drupal\Core\Form\FormStateInterface;
use Drupal\node\Entity\Node;
use Drupal\views\Plugin\views\field\FieldPluginBase;
use Drupal\views\ResultRow;

/**
 * Field containing a link to a primary PDF file.
 *
 * @ingroup views_field_handlers
 *
 * @ViewsField("pdflink")
 */
class PDFLink extends FieldPluginBase {

  /**
   * @{inheritdoc}
   */
  public function query() {
    // Leave empty to avoid a query on this field.
  }

  /**
   * Define the available options
   * @return array
   */
  protected function defineOptions() {
    $options = parent::defineOptions();
    return $options;
  }

  /**
   * Provide the options form.
   */
  public function buildOptionsForm(&$form, FormStateInterface $form_state) {
    parent::buildOptionsForm($form, $form_state);
  }

  /**
   * @{inheritdoc}
   */
  public function render(ResultRow $values) {
    $node = $this->getEntity($values);
    // Get Document (primary) media attached to this node
    $media = \Drupal::entityTypeManager()->getStorage('media')->loadByProperties(['bundle' => 'document', 'field_media_of' => $node->id()]);
    if (empty($media)) {
      return '';
    }
    $media = reset($media);
    // Get the file entity from the media
    $file = $media->get('field_media_document')->entity;
    if (!$file) {
      return '';
    }
    // Get the URL of the file
    // Return the link to the PDF file
    $url = $file->createFileUrl();
    $result = '<a href="' . $url . '" target="_blank">' . $this->t('PDF link') . '</a>';

    return $this->t($result);
  }

}