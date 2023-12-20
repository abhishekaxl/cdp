<?php

namespace Drupal\hubspot_submission\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Hubspot submission settings for this site.
 */
class HubspotSubmissonConfigs extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'hubspot_form_configs';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['hubspot_submission.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    
    $form['forms_mapping'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Forms mapping'),
      '#description' => $this->t('Key|Value. Here Key is Form guid on <strong>Hubspot</strong> end and value is Form id on <strong>Drupal</strong> end.'),
      '#default_value' => $this->config('hubspot_submission.settings')->get('forms_mapping') ?? '',
      '#required' => TRUE,
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->config('hubspot_submission.settings')
      ->set('forms_mapping', $form_state->getValue('forms_mapping'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
