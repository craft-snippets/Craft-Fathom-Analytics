<?php

namespace craftsnippets\fathomanalytics\variables;

use craftsnippets\fathomanalytics\FathomAnalytics;
class FathomVariable
{

    public function outputTrackingCode()
    {
        FathomAnalytics::getInstance()->frontend->outputTrackingCode();
    }
}