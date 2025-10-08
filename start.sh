#!/bin/bash
PLUGIN_DIR="/home/fpp/media/plugins/MQTTSystemStatus"
CONFIG_FILE="$PLUGIN_DIR/settings.json"

BROKER=$(jq -r '.broker' $CONFIG_FILE)
PORT=$(jq -r '.port' $CONFIG_FILE)
USER=$(jq -r '.username' $CONFIG_FILE)
PASS=$(jq -r '.password' $CONFIG_FILE)
TOPIC=$(jq -r '.topic' $CONFIG_FILE)
INTERVAL=$(jq -r '.interval' $CONFIG_FILE)

pkill -f mqtt_status_publisher.py

/usr/bin/python3 $PLUGIN_DIR/mqtt_status_publisher.py "$BROKER" "$PORT" "$USER" "$PASS" "$TOPIC" "$INTERVAL" &
