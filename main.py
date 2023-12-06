import subprocess

carddurr = subprocess.Popen(['python', 'bot.py'])
pankix = subprocess.Popen(['python', 'bot2.py'])

carddurr.wait()
pankix.wait()