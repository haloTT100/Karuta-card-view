import subprocess

carddurr = subprocess.Popen(['python', '-Xfrozen_modules=off', 'bot.py'])
pankix = subprocess.Popen(['python', '-Xfrozen_modules=off', 'bot2.py'])
lakatos = subprocess.Popen(['python', '-Xfrozen_modules=off', 'bot3.py'])
kamaboko = subprocess.Popen(['python', '-Xfrozen_modules=off', 'bot4.py'])

carddurr.wait()
pankix.wait()
lakatos.wait()
kamaboko.wait()