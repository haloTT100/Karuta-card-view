from bot import bolondBot
import json

with open('trianon.json', 'r', encoding='utf8') as f:
    config = json.load(f)

TOKEN = config['token']

carddurr = bolondBot()
carddurr.run(TOKEN)