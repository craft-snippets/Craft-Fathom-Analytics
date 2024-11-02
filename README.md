# Fathom Analytics integration

## Requirements

This plugin requires Craft CMS 5.0.0 or later, and PHP 8.2 or later.

## Installation

```bash
# go to the project directory
cd /path/to/my-project.test

# tell Composer to load the plugin
composer require craftsnippets/craft-fathom-analytics

# tell Craft to install the plugin
./craft plugin/install fathom-analytics-integration
```

## Usage

In the plugin settings in the control panel, enter **Fathom site id** and make sure that **Include fathom tracking code** is enabled.

In site template, include this code:

```
{% do craft.fathomAnalytics.outputTrackingCode() %}
```