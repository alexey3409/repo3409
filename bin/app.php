<?php

try {
    unset($argv[0]);

    // Регистрируем функцию автозагрузки
    spl_autoload_register(function (string $className) {
        require_once __DIR__ . '/../src/' . $className . '.php';
    });

    // Создаём экземпляр класса, передав параметры и вызываем метод execute()
    $className = '\\LibProject\\Cli\\Index';
    $class = new $className($argv);
    $class->execute();
} catch (\LibProject\Exceptions\CliException $e) {
    echo 'Error: ' . $e->getMessage();
}