# Press Start Platform

Облачный сервис для взаимодействия с [Press Start CMS](https://github.com/reenekt/press-start-cms)

## Установка
### 1. Клонируйте репозиторий
```
git clone https://github.com/reenekt/press-start-platform.git
```

### 2. Env
Скопируйте файл `<project dir>/.env.example` -> `<project dir>/.env` и настройте под себя

### 3. Composer
Установите зависимости composer'а с помощью команды
```
composer install
```

### 4. Создайте базу данных
Создайте новую MySQL базу данных и обновите настройки подключения в `.env` файле

### 5. Artisan
Создайте ключ приложения командой
```
php artisan key:generate
```

Затем запустите миграции
```
php artisan migrate
```

Приложение установлено и готово к работе

## Работа с фронтэндом
Для работы с фронтэндом требуется nodejs и пакетный менеджер npm/yarn

### 4. Установка зависимостей NPM/Yarn
Установите зависимости с помощью NPM или Yarn
```
npm install
```
или
```
yarn
```

Теперь вы можете собирать составляющие фронтэнда с помощью команд
```
npm run dev
npm run development

npm run watch
npm run watch-poll

npm run hot

npm run prod
npm run production

```

dev / development - одноразовая сборка (для разработки)

watch / watch-poll - сборка при каждом изменении файлов

hot - горячая замена

prod / production - сборка production версии с минификацией файлов
