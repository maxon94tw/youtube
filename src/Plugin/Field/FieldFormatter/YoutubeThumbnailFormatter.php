<?php

namespace Drupal\youtube\Plugin\Field\FieldFormatter;

use Drupal\Core\Field\FormatterBase;
use Drupal\Core\Field\FieldItemListInterface;

/**
 * Plugin implementation of the 'youtube_thumbnail' formatter.
 *
 * @FieldFormatter(
 *   id = "youtube_thumbnail",
 *   module = "youtube",
 *   label = @Translation("Displays video thumbnail"),
 *   field_types = {
 *     "youtube"
 *   }
 * )
 */
class YoutubeThumbnailFormatter extends FormatterBase
{

  /**
   * {@inheritdoc}
   */
  public function viewElements(FieldItemListInterface $items, $langcode)
  {
    $elements = array();

    foreach ($items as $delta => $item) {
      preg_match("#(?<=v=)[a-zA-Z0-9-]+(?=&)|(?<=v\/)[^&\n]+(?=\?)|(?<=v=)[^&\n]+|(?<=youtu.be/)[^&\n]+#", $item->value, $matches);

      if (!empty($matches)) {
        $content = '<a href="' . $item->value . '" target="_blank"><img src="http://img.youtube.com/vi/' . $matches[0] . '/0.jpg"></a>';
        $elements[$delta] = array(
          '#type' => 'html_tag',
          '#tag' => 'p',
          '#value' => $content,
        );
}

    }

    return $elements;
  }

}