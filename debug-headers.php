<?php
header('Content-Type: text/plain');
echo "HTTPS: " . var_export($_SERVER['HTTPS'] ?? null, true) . "\n";
echo "HTTP_X_FORWARDED_PROTO: " . var_export($_SERVER['HTTP_X_FORWARDED_PROTO'] ?? null, true) . "\n";
echo "SERVER_PORT: " . var_export($_SERVER['SERVER_PORT'] ?? null, true) . "\n";
echo "REQUEST_SCHEME: " . var_export($_SERVER['REQUEST_SCHEME'] ?? null, true) . "\n";
foreach ($_SERVER as $k => $v) {
    if (stripos($k, 'FORWARD') !== false || stripos($k, 'PROTO') !== false || stripos($k, 'HTTPS') !== false) {
        echo "$k = " . var_export($v, true) . "\n";
    }
}
