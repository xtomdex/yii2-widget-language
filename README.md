Yii2 language widget
============================

Renders languages dropdown for choosing application language. Excepts current application language from the list and puts it in the dropdown link

Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist xtomdex/yii2-widget-language "*"
```

or add

```
"xtomdex/yii2-widget-language": "*"
```

to the require section of your `composer.json` file.


Usage
-----

Once the extension is installed, simply use it in your code by  :

```php
<?= \xtomdex\widgets\Language::widget([
    'items' => [ 
        'en' => [
            'name' => 'English',
            'countryCode' => 'gb' //country code 
        ],
        'ru' => [
            'name' => 'Русский',
            'countryCode' => 'ru'
        ],
    ] //default items, pass all languages that are used in your app
]); ?>

```