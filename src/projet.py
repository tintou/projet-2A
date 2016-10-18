from gi.repository import GLib
try:
    import RPi.GPIO as GPIO
except RuntimeError:
    print("Error importing RPi.GPIO!  This is probably because you need superuser privileges.  You can achieve this by using 'sudo' to run your script")

def ir_callback(channel):
    print('This is a edge event callback function!')
    print('Edge detected on channel %s'%channel)
    print('This is run in a different thread to your main program')

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
