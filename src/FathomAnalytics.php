<?php

namespace craftsnippets\fathomanalytics;

use Craft;
use yii\base\Event;
use craft\base\Model;
use craft\base\Plugin;
use craft\web\twig\variables\CraftVariable;
use craftsnippets\fathomanalytics\models\Settings;
use craftsnippets\fathomanalytics\services\FrontendService;
use craftsnippets\fathomanalytics\variables\FathomVariable;

/**
 * Fathom Analytics integration plugin
 *
 * @method static FathomAnalytics getInstance()
 * @method Settings getSettings()
 * @author Piotr Pogorzelski <piotrpog@protonmail.com>
 * @copyright Piotr Pogorzelski
 * @license MIT
 * @property-read FrontendService $frontendService
 */
class FathomAnalytics extends Plugin
{
    public string $schemaVersion = '1.0.0';
    public bool $hasCpSettings = true;

    public static function config(): array
    {
        return [
            'components' => ['frontend' => FrontendService::class],
        ];
    }

    public function init(): void
    {
        parent::init();
        $this->attachEventHandlers();
    }

    protected function createSettingsModel(): ?Model
    {
        return Craft::createObject(Settings::class);
    }

    protected function settingsHtml(): ?string
    {
        return Craft::$app->view->renderTemplate('fathom-analytics/_settings.twig', [
            'plugin' => $this,
            'settings' => $this->getSettings(),
        ]);
    }

    private function attachEventHandlers(): void
    {

        Event::on(
            CraftVariable::class,
            CraftVariable::EVENT_INIT,
            function (Event $event) {
                /** @var CraftVariable $variable */
                $variable = $event->sender;
                $variable->set('fathomAnalytics', FathomVariable::class);
            }
        );
    }
}
