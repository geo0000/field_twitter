<?php

namespace Drupal\field_twitter\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;
use Drupal\Core\Url;

/**
 * Plugin implementation of the 'twitterfield_default' formatter.
 *
 * @FieldFormatter(
 *   id = "twitterfield_default",
 *   module = "twitter_field",
 *   label = @Translation("Twitter feed formatter"),
 *   field_types = {
 *     "twitterfield"
 *   }
 * )
 */
class TwitterFieldFormatter extends FormatterBase {

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode) {
    $elements = array();

    foreach ($items as $delta => $item) {
      $twitter_script = array(
        '#type' => 'link',
        '#title' => $this->t('Tweets by @@username', ['@username' => $item->value]),
        '#url' => Url::fromUri('https://twitter.com/' . $item->value),
        '#attributes' => [
          'class' => ['twitter-timeline'],
          'data-tweet-limit' => 5,
          'data-chrome' => "noheader nofooter noborders",
          'show-replies' => FALSE
        ],
        '#attached' => [
          'library' => ['twitter_block/widgets'],
        ],
      );

      $elements[$delta] = array(
        '#theme' => 'twitter_script_formatter',
        '#twitter_script' => $twitter_script,
      );
    }

    return $elements;
  }
}
