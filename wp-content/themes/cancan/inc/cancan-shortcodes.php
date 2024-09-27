<?php
function register_shortcodes()
{
   add_shortcode('arrow-title', 'arrow_title_shortcode');
}
add_action('init', 'register_shortcodes');

function arrow_title_shortcode($atts)
{
  ob_start();
    $title=$atts['title']
?>
<div class="arrow-title">
  <span class="arrow-line left"></span>
  <span class="triangle"></span>
  <h2 class="font-komika-title"><?php echo $title?></h2>
  <span class="triangle left"></span>
  <span class="arrow-line right"></span>
</div>
<?php
  return ob_get_clean();
}
