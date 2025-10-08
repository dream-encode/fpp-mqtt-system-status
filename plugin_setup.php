<?php
$pluginName = basename(__DIR__);

function MQTTSystemStatus_Initialize() {
    $settings = [
        'broker'   => ['default' => '192.168.1.10', 'description' => 'MQTT Broker Host'],
        'port'     => ['default' => '1883',          'description' => 'MQTT Port'],
        'username' => ['default' => 'fpp',           'description' => 'MQTT Username'],
        'password' => ['default' => '',              'description' => 'MQTT Password'],
        'topic'    => ['default' => 'fpp/system/status', 'description' => 'MQTT Topic'],
        'interval' => ['default' => '2',             'description' => 'Polling interval (seconds)']
    ];

    RegisterPluginSettings($pluginName, $settings);
}

function MQTTSystemStatus_Start() {
    global $settings, $pluginName;

    $settings = ParsePluginSettings($pluginName);

    $cmd = "/home/fpp/media/plugins/$pluginName/start.sh";

    exec("$cmd > /dev/null 2>&1 &");
}

function MQTTSystemStatus_Stop(){
    exec("pkill -f mqtt_status_publisher.py");
}
