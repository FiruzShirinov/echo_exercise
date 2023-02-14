<p align="center">
    <a href="https://echo-company.ru" target="_blank">
        <img src="https://echo-company.ru/local/templates/fastsite/logo.svg" width="400" alt="Echo Logo">
    </a>
</p>

## Как запустить тестовое задание

1) Клонируйте проект на свой ПК и откройте его папку в IDE
2) Создайте файл `.env` и скопируйте и вставьте в него содержимое из файла `.env-example`.
3) Создайте БД и назовите его `echo_exercise`
4) Откройте терминал и выполните команды:

- `composer install`
- `npm install`
- `npm run build`
- `php artisan migrate`
- `php artisan serve`

5) Перейдите по адресу [127.0.0.1:8000](http://127.0.0.1:8000/), чтобы открыть проект в веб-браузере.
