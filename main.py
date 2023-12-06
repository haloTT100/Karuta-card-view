import subprocess

carddurr = subprocess.Popen(['python', 'bot.py'])
pankix = subprocess.Popen(['python', 'bot2.py'])
lakatos = subprocess.Popen(['python', 'bot3.py'])
kamaboko = subprocess.Popen(['python', 'bot4.py'])

carddurr.wait()
pankix.wait()
lakatos.wait()
kamaboko.wait()