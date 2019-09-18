# yii2-sentry-logger

[![Latest Stable Version](https://poser.pugx.org/bossit/yii2-sentry-logger/v/stable)](https://packagist.org/packages/bossit/yii2-sentry-logger)
[![Build Status](https://travis-ci.org/bossit/yii2-sentry-logger.svg?branch=master)](https://travis-ci.org/bossit/yii2-sentry-logger)
[![Total Downloads](https://poser.pugx.org/bossit/yii2-sentry-logger/downloads)](https://packagist.org/packages/bossit/yii2-sentry-logger)

## Install

The preferred way to install this component is through [composer](https://getcomposer.org/download/).

```
$ composer require bossit/yii2-sentry-logger:^1.0  
```

## Usage

The preferred way is to setup the components into our Application's configuration array:

```php
'log' => [
    'traceLevel' => YII_DEBUG ? 3 : 0,
    'targets' => [
        [
            'class' => SentryTarget::class,
            'dsn' => '_YOUR_KEY_',
            'levels' => ['error', 'warning'],
            'logVars' => [],
            'except' => [
                'yii\web\HttpException:404',
            ],
        ],
    ],
],
```

That's it, you are ready to use it as Yii2 components.