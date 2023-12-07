import botLogger
import discord
import asyncio
import logging
import aiohttp
import json

#load vars
with open('trianon.json', 'r', encoding='utf8') as f:
    tokens = json.load(f)
with open('fájdalom.json', 'r', encoding='utf8') as f:
    channels = json.load(f)

#setup logger
logger = logging.getLogger("lakatos")
logger.setLevel(logging.DEBUG)
logger.propagate = False
for handler in logger.handlers[:]:
    logger.removeHandler(handler)
ch = logging.StreamHandler()
ch.setLevel(logging.DEBUG)

class bolondBot(discord.Client):
    def __init__(self):
        super().__init__()
        self.cshannel = None
        self.messageLoader = int(channels['lakatos'])
        self.karuta_bot = None
        self.tempcard = None
        self.data = []

    async def on_ready(self):
        ch.setFormatter(botLogger.CustomFormatter(self.user.name))
        logger.addHandler(ch)
        self.channel = self.get_channel(1181224154511462413)
        self.messageLoader = self.get_channel(self.messageLoader)
        self.karuta_bot = await self.fetch_user(646937666251915264)

    async def on_message(self, message):
        if message.channel == self.channel and message.author.id == 320948474868924416 and message.content == 'stop':
            await self.close()

        if message.channel == self.channel and message.author.name == 'Bolond' and message.content == 'Embeds sent!':
            messages = [msg async for msg in self.messageLoader.history(limit=1000)]
            await self.messageLoader.purge(limit=1000)
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
            await self.getCard(self.data)
            
        if message.author == self.karuta_bot and message.embeds:
            try:
                embed = message.embeds[0]
                embed_lines = embed.description.split('\n')
                for line in embed_lines[2:]:
                    code = line.split('`')[1]
                if code == self.tempcard:
                    logger.info(f"Picture: {embed.image.url.split('?')[0]}")
                    await self.postCard(embed.image.url.split("?")[0], self.tempcard)
            except Exception:
                logger.error(f"Failed to parse embed: {embed.description}")
                return

    async def getCard(self, data):
        while data:
            self.tempcard = data.pop(0)
            logger.info(f"Sending card: {self.tempcard}")
            await self.channel.send(f"kv {self.tempcard}")
            await asyncio.sleep(10)
                
    async def postCard(self, url, code):
        async with aiohttp.ClientSession() as session:
            data = {"link": url,
                    "code": code}  # replace with your actual data
            async with session.post('http://127.0.0.1/saveLink.php', data=data) as resp:
                logger.info(resp.status)

client = bolondBot()
client.run(tokens['lakatos'])