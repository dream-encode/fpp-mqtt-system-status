#!/usr/bin/env python3
import sys, time, json, requests, paho.mqtt.client as mqtt

if len(sys.argv) < 7:
    print("Usage: mqtt_status_publisher.py <broker> <port> <user> <pass> <topic> <interval>")
    sys.exit(1)

broker, port, user, pw, topic, interval = sys.argv[1:7]
port = int(port)
interval = int(interval)

client = mqtt.Client("fpp_system_status")
if user:
    client.username_pw_set(user, pw)
client.connect(broker, port, 60)
client.loop_start()

def get_status():
    try:
        r = requests.get("http://localhost/api/system/status", timeout=3)
        if r.status_code == 200:
            return r.json()
    except Exception as e:
        print("Error:", e)
    return None

while True:
    data = get_status()
    if data:
        payload = json.dumps(data)
        client.publish(topic, payload, qos=0, retain=True)
    time.sleep(interval)
