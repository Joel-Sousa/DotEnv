<?php

    function loadEnv($path)
    {
        if (!file_exists($path)) {
            throw new Exception(".env não encontrado: $path");
        }

        $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        foreach ($lines as $line) {
            // Ignorar comentários
            if (str_starts_with(trim($line), '#')) {
                continue;
            }

            // Quebrar chave=valor
            list($key, $value) = explode('=', $line, 2);

            $key = trim($key);
            $value = trim($value);

            // Definir nas variáveis de ambiente
            putenv("$key=$value");
            $_ENV[$key] = $value;
            $_SERVER[$key] = $value;
        }
    }

    loadEnv(__DIR__ . '/.env');
