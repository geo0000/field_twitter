<?php

namespace Drupal\field_twitter\Plugin\Field\FieldType;

use Drupal\Core\Field\FieldItemBase;
use Drupal\Core\Field\FieldStorageDefinitionInterface;
use Drupal\Core\TypedData\DataDefinition;

/**
 * Plugin implementation of the 'twitterfield' field type.
 *
 * @FieldType(
 *   id = "twitterfield",
 *   label = @Translation("Twitter field"),
 *   module = "field_twitter",
 *   description = @Translation("Feed from Twitter."),
 *   default_widget = "twitterfield_default",
 *   default_formatter = "twitterfield_default"
 * )
 */
class TwitterFieldItem extends FieldItemBase {

  const TWITTER_FIELD_MAX_LENGTH = 255;

  /**
   * {@inheritdoc}
   */
  public static function schema(FieldStorageDefinitionInterface $field_definition) {
    return array(
      'columns' => array(
        'value' => array(
          'type' => 'char',
          'length' => static::TWITTER_FIELD_MAX_LENGTH,
          'not null' => FALSE,
        ),
      ),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function isEmpty() {
    $value = $this->get('value')->getValue();

    return $value === NULL || $value === '';
  }

  /**
   * {@inheritdoc}
   */
  public static function propertyDefinitions(FieldStorageDefinitionInterface $field_definition) {
    $properties['value'] = DataDefinition::create('string')
      ->setLabel(t('Twitter feed'));

    return $properties;
  }
}
