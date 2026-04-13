<?php

/**
 * Implements hook_views_data_alter().
 */
function digitalia_muni_view_field_views_data_alter(array &$data) {
  $data['node']['pdflink'] = array(
    'title' => t('PDF link'),
    'group' => t('Content'),
    'field' => array(
      'title' => t('PDF link'),
      'help' => t('Link to a PDF file in media Document primary'),
      'id' => 'pdflink',
    ),
  );
}
