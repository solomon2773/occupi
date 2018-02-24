# this is the python file for reading out both cpu and gpu temputure
import os
import time
import urllib2
import urllib
import json
import time;
import commands
import smbus
import numpy as np

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

#initialize variables
old_loc = 0
new_loc = 0
count = 0
direction = 0
m_old = np.array([25,25,25,25,25,25,25,25])

while True:
	
    sensor_data = sensor.readPixels()

    occupancy_counter = 0
    m_new = np.array(sensor_data).reshape(8,8).mean(0)
    diff = m_new - m_old

    if np.max(diff)>1:
        new_loc = np.argmax(diff) + 1
        if old_loc==0:
		old_loc = new_loc
	direction = old_loc - new_loc
        old_loc = new_loc
        count = count + direction
        #print "Direction:",direction,"Count:",count
        if count>3:
            count=0
            occupancy_counter = 1
        #time.sleep(1)

        if count<-3:
            count=0
            occupancy_counter = -1
        #time.sleep(1)
    else: 
	old_loc = 0
	direction = 0
	count = 0

    timestamp = time.time()
    gpu_temp = measure_gpu_temp()
    cpu_temp = measure_cpu_temp()
    #datastore = {"gpu_temp","cpu_temp" }
    #sensor_data = sensor.readPixels()
    #sensor_data.extend([occupancy_counter])
    #print sensor_data
    query_args = {"timestamp":timestamp,"GPU_Temp" : gpu_temp,"CPU_Temp": cpu_temp,"mac_address":mac_address,"sensor_data":sensor_data,"occupancy_counter":occupancy_counter}
    url = 'http://occupi.yottatrend.com/pi_post.php'
    data = urllib.urlencode(query_args)
    request = urllib2.Request(url, data)
    response = urllib2.urlopen(request).read()
    if occupancy_counter != 0:
	print response
        print occupancy_counter

    time.sleep(.1) #delay for one second
