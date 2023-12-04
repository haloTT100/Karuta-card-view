import time
import discord
from discord.ext import commands
import json
import asyncio
import logging
import aiohttp

class CustomFormatter(logging.Formatter):

    gray = "\033[90m"
    blue = "\033[38;5;69m"
    yellow = "\033[38;5;226m"
    red = "\x1b[31;20m"
    bold_red = "\x1b[31;1m"
    reset = "\x1b[0m"
    format = "%(time)s %(levelname)s %(message)s"
    FORMATS = {
        logging.DEBUG: gray + "%(time)s " + reset + blue + "%(levelname)s" + reset + "    %(message)s",
        logging.INFO: gray + "%(time)s " + reset + blue + "%(levelname)s" + reset + "     %(message)s",
        logging.WARNING: gray + "%(time)s " + reset + yellow + "%(levelname)s" + reset + "  %(message)s",
        logging.ERROR: gray + "%(time)s " + reset + red + "%(levelname)s" + reset + "    %(message)s",
        logging.CRITICAL: gray + "%(time)s " + reset + bold_red + "%(levelname)s" + reset + "     %(message)s"
    }
    
    def format(self, record):
        record.time = time.strftime("%Y-%m-%d %H:%M:%S", time.gmtime(record.created))
        log_fmt = self.FORMATS.get(record.levelno)
        formatter = logging.Formatter(log_fmt)
        return formatter.format(record)

logger = logging.getLogger("Karuta selfbot")
logger.setLevel(logging.DEBUG)
logger.propagate = False  # Prevent logs from being passed to the handlers of higher level loggers

# Remove all handlers associated with the logger object.
for handler in logger.handlers[:]:
    logger.removeHandler(handler)

ch = logging.StreamHandler()
ch.setLevel(logging.DEBUG)
ch.setFormatter(CustomFormatter())
logger.addHandler(ch)

with open('trianon.json', 'r', encoding='utf8') as f:
    config = json.load(f)

TOKEN = config['token']
channel = None
karuta_bot = None

data = []

bot = commands.Bot(command_prefix='!', self_bot=True)

@bot.event
async def on_ready():
    global channel, karuta_bot
    channel = bot.get_channel(1181224154511462413)
    karuta_bot = await bot.fetch_user(646937666251915264)

@bot.event
async def on_message(message):
    if message.author.name == 'Bolond' and message.embeds:
        embed = message.embeds[0]
        logger.info(f"Received embed: {embed.description}")
        try:
            data = embed.description.split(';')
            logger.info(f"{data}")
            await getCard(data)
        except Exception:
            logger.error(f"Failed to parse embed: {embed.description}")
            return
        
    if message.author == karuta_bot and message.embeds:
        embed = message.embeds[0]
        logger.info(f"Picture: {embed.image.url}")
        # await channel.send(embed.image.url.split('?')[0]) vissza az api-nak

async def getCard(data):
    for card in data:
        await channel.send(f"kv {card}")
        await asyncio.sleep(10)
    


bot.run(TOKEN)