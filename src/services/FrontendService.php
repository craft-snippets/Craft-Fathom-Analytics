<?php

namespace craftsnippets\fathomanalytics\services;

use Craft;
use craftsnippets\fathomanalytics\FathomAnalytics;
use yii\base\Component;
use craft\helpers\Html;

/**
 * Frontend Service service
 */
class FrontendService extends Component
{

    public function canIncludeTracking(): bool
    {
        $settings = FathomAnalytics::getInstance()->getSettings();
        $canInclude = true;
        //if enabled
        if($settings->getIsEnabled() == false) {
            $canInclude = false;
        }
        // if key entered
        if (empty($settings->fathomSiteId)) {
            $canInclude = false;
        }
        return $canInclude;
    }

    public function getTrackingCode(): string
    {
        $html = Html::tag('script', '', [
            'src' => 'https://cdn.usefathom.com/script.js',
            'data-site' => FathomAnalytics::getInstance()->getSettings()->getFathomSiteId(),
            'defer' => true,
        ]);
        return $html;
    }

    public function outputTrackingCode(): void
    {
        if(!$this->canIncludeTracking()) {
            return;
        }
        $trackingCode = $this->getTrackingCode();
        Craft::$app->getView()->registerHtml($trackingCode, Craft::$app->getView()::POS_HEAD);
    }
}
