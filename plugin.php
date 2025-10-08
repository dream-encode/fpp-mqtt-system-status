<?php
$pluginName = basename(dirname(__FILE__));

function MQTTSystemStatus_setup() {
    $settings = array(
        'broker'   => array('default' => '192.168.1.10', 'description' => 'MQTT Broker Host'),
        'port'     => array('default' => '1883', 'description' => 'MQTT Port'),
        'username' => array('default' => 'fpp', 'description' => 'MQTT Username'),
        'password' => array('default' => '', 'description' => 'MQTT Password'),
        'topic'    => array('default' => 'fpp/system/status', 'description' => 'MQTT Topic'),
        'interval' => array('default' => '2', 'description' => 'Polling interval (seconds)')
    );

    RegisterPluginSettings($pluginName, $settings);
}

function MQTTSystemStatus_Start() {
    global $settings, $pluginName;

    $settings = ParsePluginSettings($pluginName);

    $cmd = "/home/fpp/media/plugins/$pluginName/start.sh";

    exec($cmd . " > /dev/null 2>&1 &");
}

function MQTTSystemStatus_Stop() {
    $cmd = "/home/fpp/media/plugins/MQTTSystemStatus/stop.sh";

    exec($cmd);
}
