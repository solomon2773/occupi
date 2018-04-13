# this is the python file for reading out both cpu and gpu temputure
import os
import time
import urllib2
import urllib
import json
import time;
import commands
import smbus

from Adafruit_AMG88xx import Adafruit_AMG88xx
from time import sleep

bus = smbus.SMBus(1)
address = 0x69

# get current wireless card mac address ...
mac_address = commands.getoutput("ifconfig wlan0 | grep -o -E '([[:xdigit:]]{1,2}:){5}[[:xdigit:]]{1,2}'")

def measure_gpu_temp(): # get gpu temp function
    temp = os.popen("vcgencmd measure_temp").readline().rstrip('\n').rstrip('\'C')
    return (temp.replace("temp=",""))

def measure_cpu_temp(): #get cpu temp function
    temp = os.popen("cat /sys/class/thermal/thermal_zone0/temp").readline()
    return (int(temp)/1000)



sensor = Adafruit_AMG88xx()

# Optionally you can override the bus number:
#sensor = AMG88.Adafruit_AMG88xx(busnum=2)

#wait for it to boot
sleep(.1)

while True:

    timestamp = time.time()
    gpu_temp = measure_gpu_temp()
    cpu_temp = measure_cpu_temp()
    #datastore = {"gpu_temp","cpu_temp" }
    sensor_data = sensor.readPixels()
    query_args = {"timestamp":timestamp,"GPU_Temp" : gpu_temp,"CPU_Temp": cpu_temp,"mac_address":mac_address,"sensor_data":sensor_data}
    url = 'http://45.35.53.205/pi_post.php'
    data = urllib.urlencode(query_args)
    request = urllib2.Request(url, data)
    response = urllib2.urlopen(request).read()
    print response
    time.sleep(.1) #delay for one second

