import time
import discord
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

class bolondBot(discord.Client):
    def __init__(self):
        super().__init__()
        self.cshannel = None
        self.messageLoader = None
        self.karuta_bot = None
        self.tempcard = None
        self.data = []

    async def on_ready(self):
        self.channel = self.get_channel(1181224154511462413)
        self.messageLoader = self.get_channel(1181330761270444143)
        self.karuta_bot = await self.fetch_user(646937666251915264)

    async def on_message(self, message):
        if message.channel == self.channel and message.author.name == 'Bolond' and message.content == 'Embeds sent!':
            messages = [msg async for msg in self.messageLoader.history(limit=100)]
            await self.messageLoader.purge(limit=100)
            for msg in messages:
                if msg.embeds:
                    embed = msg.embeds[0]
                    try:
                        self.data.extend(embed.description.split(';'))
                    except Exception:
                        logger.error(f"Failed to parse embed: {embed.description}")
                        return
                    
            messages = []
            logger.info(f"{self.data}")
            await self.channel.send(f"Loaded {len(self.data)} codes.")

        if message.author.name == self.user.name and f"Loaded {len(self.data)} codes." in message.content:
            await getCard(self, self.data)
            
        if message.author == self.karuta_bot and message.embeds:
            embed = message.embeds[0]
            logger.info(f"Picture: {embed.image.url.split('?')[0]}")
            await postCard(embed.image.url.split("?")[0], self.tempcard)

async def getCard(self, data):
    global tempcard
    while data:
        self.tempcard = data.pop(0)
        logger.info(f"Sending card: {self.tempcard}")
        await self.channel.send(f"kv {self.tempcard}")
        await asyncio.sleep(10)
            
async def postCard(url, code):
    async with aiohttp.ClientSession() as session:
        data = {"link": url,
                "code": code}  # replace with your actual data
        async with session.post('http://127.0.0.1/Karuta-card-view/website/saveLink.php', data=data) as resp:
            logger.info(resp.status)