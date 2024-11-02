<?php

namespace craftsnippets\fathomanalytics\models;

use Craft;
use craft\base\Model;
use craft\helpers\App;

/**
 * Fathom Analytics integration settings
 */
class Settings extends Model
{
    public $isEnabled;
    public $fathomSiteId;

    public function getIsEnabled(): bool
    {
        return App::parseEnv($this->isEnabled);
    }

    public function getFathomSiteId()
    {
        return App::parseEnv($this->fathomSiteId);
    }
}
