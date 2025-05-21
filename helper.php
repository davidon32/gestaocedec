<?php

// SETUP DO .ENV PARA UTILIZACAO DO GETENV()
function loadEnvFile($envPath = null) {
    if ($envPath === null) {
        $envPath = __DIR__.'/.env';
    }
    if (file_exists($envPath)) {
        $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            if (strpos(trim($line), '#') === 0) continue;
            list($key, $value) = array_map('trim', explode('=', $line, 2));
            if (!array_key_exists($key, $_ENV)) {
                $_ENV[$key] = $value;
                putenv("$key=$value");
            }
        }
    }
}

?>