<?php

namespace bossit\sentry;

use Sentry\Severity;
use Sentry\State\Scope;
use Throwable;
use yii\log\Logger;
use yii\log\Target;
use function Sentry\captureException;
use function Sentry\captureMessage;
use function Sentry\configureScope;
use function Sentry\init;

class SentryTarget extends Target
{
    /** @var string Sentry client key. */
    public $dsn;

    public function collect($messages, $final): void
    {
        init(['dsn' => $this->dsn]);

        parent::collect($messages, $final);
    }

    public function export(): void
    {

        foreach ($this->messages as $message) {
            [$text, $level, $category, $timestamp, $traces] = $message;

            configureScope(static function (Scope $scope) use ($level, $category): void {
                $scope->setLevel(static::getLevelName($level));
                $scope->setTag('category', $category);
                $scope->setTag('env', YII_ENV);
            });

            if ($text instanceof Throwable) {
                captureException($text);

                continue;
            }

            captureMessage($text);
        }
    }

    public static function getLevelName(int $level): Severity
    {
        switch ($level) {
            case Logger::LEVEL_ERROR:
                return Severity::error();
                break;
            case Logger::LEVEL_WARNING:
                return Severity::warning();
                break;
            case Logger::LEVEL_INFO:
                return Severity::info();
                break;
            default:
                return Severity::debug();
        }
    }
}
