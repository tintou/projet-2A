from gi.repository import GLib
try:
    import RPi.GPIO as GPIO
except RuntimeError:
    print("Error importing RPi.GPIO!  This is probably because you need superuser privileges.  You can achieve this by using 'sudo' to run your script")
import picamera
import datetime
import dailymotion
import subprocess

camera = picamera.PiCamera()
camera.framerate = 25
d = dailymotion.Dailymotion()
d.set_grant_type('password', api_key='fc97978e5589a52f86d8', api_secret='537033ac621be2a85d78caa35d273ac1897e8ca7', scope=['userinfo', 'manage_videos'], info={'username': 'tintou@mailoo.org', 'password': 'ferreira'})

def stop_record():
    camera.stop_recording()
    print(' - Record stoped')
    print(' - Sending video')
    output_file = current_file.replace (".h264", ".mp4");
    subprocess.call(["avconv", "-r", "25", "-i", current_file, "-vcodec", "copy", output_file])
    
    url = d.upload('./{0}'.format(output_file))
    d.post('/me/videos', {'url': url, 'title': output_file, 'published': 'false', 'channel': 'news'})
    print(' - Video sent')
    return False

def start_record():
    global current_file
    current_file = datetime.datetime.now().strftime("%Y-%m-%d %H:%M:%S")+'.h264'
    camera.start_recording(current_file, format='h264', bitrate=17000)
    print(' - Record started')
    GLib.timeout_add_seconds(10, stop_record)
    return False

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
    print('logged as ', d.get('/me', {'fields': 'id,fullname'}).get('fullname'))
    GLib.timeout_add_seconds(10, start_record)
    GLib.MainLoop().run()
    GPIO.cleanup()

if __name__ == '__main__':
    main()
