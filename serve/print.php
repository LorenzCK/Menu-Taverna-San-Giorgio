<?php
$payload = $_GET['payload'];
if(empty($payload)) {
    error_log('No payload provided');
    http_response_code(400);
    die();
}

$total = null;
if(!empty($_GET['total']) && is_numeric($_GET['total'])) {
    $total = number_format(floatval($_GET['total']), 1, ',', '.');
}

// Create associative array to hold dish IDs and their counts
/*$qr_code_payload = [];
$dishes = explode('-', $payload);
foreach($dishes as $dish) {
    $parts = explode('x', $dish);
    if(count($parts) !== 2) {
        error_log('Invalid dish format: ' . $dish);
        continue;
    }

    $dish_id = intval($parts[0]);
    if($dish_id <= 0) {
        error_log('Invalid dish ID: ' . $dish_id);
        continue;
    }
    $dish_count = intval($parts[1]);
    if($dish_count < 0) {
        error_log('Invalid dish count: ' . $dish_count);
        continue;
    }

    $qr_code_payload[$dish_id] = $dish_count;
}

if(count($qr_code_payload) === 0) {
    error_log('No valid dishes found in payload');
    http_response_code(400);
    die();
}*/

// Prepare output for thermal printer
$output = [];
$output[] = [
    'type' => 0,
    'content' => 'Taverna San Giorgio',
    'bold' => 1,
    'align' => 1,
    'format' => 1,
];
$output[] = [
    'type' => 3,
    'value' => 'GSG' . $payload, //json_encode($qr_code_payload),
    'size' => 60,
    'align' => 1,
];
if($total !== null) {
    $output[] = [
        'type' => 0,
        'content' => 'Totale: €' . $total,
        'bold' => 1,
        'align' => 1,
        'format' => 0,
    ];
}
$output[] = [
    'type' => 0,
    'content' => 'Presentare il codice alla cassa per il pagamento.',
    'align' => 0,
    'format' => 0,
];

echo json_encode($output, JSON_FORCE_OBJECT);
