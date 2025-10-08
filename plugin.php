<?php
require_once '/opt/fpp/www/common.php';

class fpp_mqtt_system_status extends FPPPlugin
{
    public function __construct($pluginName)
    {
        parent::__construct($pluginName);
    }

    public function Init()
    {
        $settings = [
            'broker'   => ['default' => '192.168.1.201', 'description' => 'MQTT Broker Host'],
            'port'     => ['default' => '1883',          'description' => 'MQTT Port'],
            'username' => ['default' => 'fpp',           'description' => 'MQTT Username'],
            'password' => ['default' => '',              'description' => 'MQTT Password'],
            'topic'    => ['default' => 'fpp/system/status', 'description' => 'MQTT Topic'],
            'interval' => ['default' => '2',             'description' => 'Polling Interval (seconds)']
        ];
        $this->RegisterSettings($settings);
    }
}

$plugin = new fpp_mqtt_system_status('fpp-mqtt-system-status');
