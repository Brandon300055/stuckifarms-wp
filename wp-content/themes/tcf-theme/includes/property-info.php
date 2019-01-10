<?php 
$property_type = get_field('property_type', $property->ID) ?: 'movein';

$fields = [
    'movein' => [
       'location', 'village', 'price', 'type', 'status',  'plan', 'size', 'beds', 'baths', 'garages',
    ],
    'plan' => [
       'location', 'village', 'price', 'type', 'status',  'plan', 'size', 'beds', 'baths', 'garages', 'lot_size',
    ],
    'lot' => [
        'location', 'village', 'price', 'type', 'status',  'plan', 'size', 'beds', 'baths', 'garages', 'lot_size',
    ],
];

$fields = array_map(function($field) use ($property){
    return get_field_object($field, $property->ID);
}, $fields[$property_type]);

$fields = array_filter($fields, function($field){
    return isset($field['value']) && strlen($field['value']) > 0;
});

?>
<section class="section section-sm">
    <div class="container">
        <h4 class="subheading bottom-bar bottom-bar-blue">Property Description</h4>
        <div class="row">
            <div class="col-md-4">
                <dl class="row">
                <?php foreach($fields as $field){ ?>
                    <dt class="col-4 text-right"><?php echo $field['label']; ?></dt>
                    <dd class="col-8"><?php echo $field['value']; ?></dd>
                <?php } ?>
                </dl>
            </div>
            <div class="col-md-8">
                <p class="text-bold">Description</p>
                <p class="description">
                    <?php the_content(); ?>
                </p>
                <br>
                <div class="row">
                    <?php 
                    $download = get_field('download_plan', $property->ID);
                    ?>
                    <div class="col-lg-4 mb-4">
                        <?php if($download){ ?>
                            <a href="<?php echo $download; ?>" class="btn btn-arrow">Download Plan</a>
                        <?php } ?>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <a href="" class="btn btn-arrow">Calculate Mortgage</a>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <a href="" class="btn btn-arrow">Talk to an Agent</a>
                    </div>
                    <div class="w-100"></div>
                    <div class="col-lg-4 mb-4">
                        <a href="" class="btn btn-arrow">Buy it Now</a>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <a href="" class="btn btn-arrow">Schedule a Visit</a>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <a href="" class="btn btn-arrow">Keep Searching</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>