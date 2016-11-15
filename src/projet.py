from gi.repository import GLib
try:
    import RPi.GPIO as GPIO
except RuntimeError:
    print("Error importing RPi.GPIO!  This is probably because you need superuser privileges.  You can achieve this by using 'sudo' to run your script")
import picamera
import datetime

camera = picamera.PiCamera()
camera.resolution = (640, 480)

def stop_record():
    camera.stop_recording()
    print(' - Record stoped')

def start_record():
    camera.start_recording(datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")+'.mp4', format='h264', quality=20)
    print(' - Record started')
    GLib.timeout_add_seconds(10, stop_record)

def ir_callback(channel):
    print('This is a edge event callback function!')
    print('Edge detected on channel %s'%channel)
    if (camera.recording == False):
        start_record()

def init_gpio_handler():
    channel = 8
    GPIO.setmode(GPIO.BOARD)
    GPIO.setup(channel, GPIO.IN, pull_up_down=GPIO.PUD_DOWN)
    GPIO.add_event_detect(channel, GPIO.RISING, callback=ir_callback, bouncetime=200)

def main():
    init_gpio_handler()
    GLib.MainLoop().run()
    GPIO.cleanup()

if __name__ == '__main__':
    main()
