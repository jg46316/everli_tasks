<?php

function haversine($lat_1, $lng_1, $lat_2, $lng_2) {

    // convert from degrees to radians
    $lat_from = deg2rad($lat_1);
    $lng_from = deg2rad($lng_1);
    $lat_to = deg2rad($lat_2);
    $lng_to = deg2rad($lng_2);

    $lat_delta = $lat_to - $lat_from;
    $lng_delta = $lng_to - $lng_from;

    $angle = 2 * asin(sqrt(pow(sin($lat_delta / 2), 2) +
        cos($lat_from) * cos($lat_to) * pow(sin($lng_delta / 2), 2)));
    return $angle * 6371;
};

$locations = [
    [ 'id' => 1000, 'zip_code' => '37069', 'lat' => 45.35, 'lng' => 10.84],
    [ 'id' => 1001, 'zip_code' => '37121', 'lat' => 45.44, 'lng' => 10.99 ],
    [ 'id' => 1001, 'zip_code' => '37129', 'lat' => 45.44, 'lng' => 11.00 ],
    [ 'id' => 1001, 'zip_code' => '37133', 'lat' => 45.43, 'lng' => 11.02 ],

];

$shoppers = [
    [ 'id'=> 'S1', 'lat'=> 45.46, 'lng'=> 11.03, 'enabled'=> true ],
    [ 'id'=> 'S2', 'lat'=> 45.46, 'lng'=> 10.12, 'enabled'=> true ],
    [ 'id'=> 'S3', 'lat'=> 45.34, 'lng'=> 10.81, 'enabled'=> true ],
    [ 'id'=> 'S4', 'lat'=> 45.76, 'lng'=> 10.57, 'enabled'=> true ],
    [ 'id'=> 'S5', 'lat'=> 45.34, 'lng'=> 10.63, 'enabled'=> true ],
    [ 'id'=> 'S6', 'lat'=> 45.42, 'lng'=> 10.81, 'enabled'=> true ],
    [ 'id'=> 'S7', 'lat'=> 45.34, 'lng'=> 10.94, 'enabled'=> true ],
];

$sorted = [];

$numberOfLocations = count($locations);
foreach ($shoppers as &$shopper) {
    $coverage = 0;

    foreach ($locations as $location) {
        $distance = haversine($shopper['lat'], $shopper['lng'], $location['lat'], $location['lng']);
        if ($distance < 10) {
            $coverage++;
        }
    }

    $shopperCoverage = 100 / $numberOfLocations * $coverage;
    if ($shopperCoverage > 0) {
        $sorted[$shopper['id']] = [
            'shopper_id' => $shopper['id'],
            'coverage'   => $shopperCoverage,
        ];
    }
}

// Since the spaceship operator orders ascending, by multipling by -1 I get a reversed sorting.
usort($sorted, function ($a, $b) {
    return ($a['coverage'] <=> $b['coverage']) * -1;
});

var_dump($sorted);
