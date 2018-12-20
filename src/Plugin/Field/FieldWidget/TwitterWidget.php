<?php

namespace Drupal\field_twitter\Plugin\Field\FieldWidget;

use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Field\WidgetBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Plugin implementation of the 'twitterfield_default' widget.
 *
 * @FieldWidget(
 *   id = "twitterfield_default",
 *   module = "twitter_field",
 *   label = @Translation("Twitter feed"),
 *   field_types = {
 *     "twitterfield"
 *   }
 * )
 */
class TwitterWidget extends WidgetBase {

  /**
   * {@inheritdoc}
   */
  public function formElement(FieldItemListInterface $items, $delta, array $element, array &$form, FormStateInterface $form_state) {
    $value = isset($items[$delta]->value) ? $items[$delta]->value : '';

    $element += array(
      '#type' => 'textfield',
      '#default_value' => $value,
      '#size' => 60,
      '#maxlength' => 255,
      '#element_validate' => array(
        array($this, 'validate'),
      ),
    );

    return array('value' => $element);
  }

  /**
   * Validate the color text field.
   */
  public function validate($element, FormStateInterface $form_state) {
    $value = $element['#value'];
    if (strlen($value) == 0) {
      $form_state->setValueForElement($element, '');

      return;
    }
  }
}
