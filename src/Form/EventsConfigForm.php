<?php
/**
 * @file
 * Contains \Drupal\bt_events\Form\EventsConfigForm.
 */
namespace Drupal\bt_events\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class EventsConfigForm extends ConfigFormBase {
  public function getFormId() {
    return 'events_config';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $form['events_cron_clean_up'] = array(
      '#type' => 'checkbox',
      '#title' => t('Clean Up Expired Events'),
      '#description' => t('When enabled, events that have past their dates will be un-published. By default, the default View of events is filtered by date.'),
      '#default_value' => \Drupal::config('bt_events.config')->get('events_cron_clean_up', 0),
    );

    return $form;
  }

  public function submitForm(array &$form, FormStateInterface $form_state) {
    foreach($form_state->getValues() as $key => $value) {
      \Drupal::config('bt_events.config')
        ->set($key, $value)
        ->save();
    }
  }
}