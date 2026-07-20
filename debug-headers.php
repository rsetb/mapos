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

echo "\n--- conf-enabled ---\n";
echo shell_exec('ls -la /etc/apache2/conf-enabled/ 2>&1');
echo "\n--- our conf file content ---\n";
echo shell_exec('cat /etc/apache2/conf-available/zz-proxy-https.conf 2>&1');
echo "\n--- apache2ctl -M (rewrite?) ---\n";
echo shell_exec('apache2ctl -M 2>&1 | grep -i rewrite');
echo "\n--- apache2ctl configtest ---\n";
echo shell_exec('apache2ctl configtest 2>&1');
