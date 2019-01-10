<?php 
$property_type = get_field('property_type', $property->ID) ?: 'movein';

$fields = [
    'movein' => [
        'plan', 'village', 'size', 'beds', 'baths', 'garages',
    ],
    'plan' => [
        'village', 'size', 'lot_size',
    ],
    'lot' => [
        'village', 'size', 'lot_size',
    ],
];

$fields = array_map(function($field) use ($property){
    return get_field_object($field, $property->ID);
}, $fields[$property_type]);

$fields = array_filter($fields, function($field){
    return isset($field['value']) && strlen($field['value']) > 0;
});

?>
<div class="card property property-<?php echo $property_type; ?> mb-4">
    <img class="card-img-top" src="<?php echo get_the_post_thumbnail_url( $property->ID, 'medium' ) ?>" alt="<?php echo get_the_title($property->ID); ?>">
    <div class="card-body">
        <h2 class="heading-alt">$<?php echo number_format( floatval(get_field('price', $property->ID)) ?: 0, 2, '.', ','); ?></h2>
        <h5 class="card-title"><?php echo get_the_title($property->ID); ?></h5>
        <p class="card-text">
            <?php 
            $content = strip_tags(get_the_content($property->id));
            if(strlen($content) > 55){
                $content = substr($content, 0, 55) . ' ... ';
            }
            echo $content;
            ?>
        </p>
        <?php 
        echo "<p class='card-text mb-0'>";
        foreach($fields as $field){
                echo "<b>". $field['label'] .": </b>";
                echo $field['value'];
                echo "<br>";
        }
        echo "</p>";
        ?>
    </div>
    <div class="card-footer">
      <a href="<?php the_permalink($property->ID); ?>" class="btn btn-primary">Details</a>
    </div>
</div>