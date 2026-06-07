<?php
header('Content-Type: application/json');

// ========================================================
// 🛠️ CONFIGURATION: PUT YOUR SERVER IP AND PORT HERE
// ========================================================
$server_ip = "206.168.173.69"; 
$server_port = "30121"; 
// ========================================================

$url = "http://" . $server_ip . ":" . $server_port . "/dynamic.json";

// 3-second request timeout to keep processing snappy
$context = stream_context_create(array('http' => array('timeout' => 3))); 
$response = @file_get_contents($url, false, $context);

if ($response !== false) {
    $data = json_decode($response, true);
    echo json_encode([
        "online" => true,
        "clients" => isset($data['clients']) ? $data['clients'] : 0,
        "maxclients" => isset($data['sv_maxclients']) ? $data['sv_maxclients'] : 32
    ]);
} else {
    echo json_encode([
        "online" => false
    ]);
}
?>
