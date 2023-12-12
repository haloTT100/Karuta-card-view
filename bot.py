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
logger = logging.getLogger("cardurr")
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
        self.messageLoader = int(channels['carddurr'])
        self.karuta_bot = None
        self.tempcard = None
        self.data = []
        self.queuedCards = 0
        self.needToLoad = False
        self.receiveEmptyLinks = None
        self.sync = True

    async def on_ready(self):

        ch.setFormatter(botLogger.CustomFormatter(self.user.name))
        logger.addHandler(ch)
        self.channel = self.get_channel(1181224154511462413)
        self.messageLoader = self.get_channel(self.messageLoader)
        self.karuta_bot = await self.fetch_user(646937666251915264)
        self.receiveEmptyLinks = asyncio.create_task(getEmptyLinks(), name="receiveEmptyLinks")

    async def on_message(self, message):
        if message.channel == self.channel and message.author.id == 320948474868924416 and message.content == 'stop':
            self.receiveEmptyLinks.cancel()
            await self.close()

        if message.channel == self.channel and self.queuedCards == 0 and message.author.name == 'Bolond' and message.content == 'Embeds sent! Bot:1':
            messages = [msg async for msg in self.messageLoader.history(limit=1000)]
            if messages:
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
                self.queuedCards = len(self.data)
                await self.channel.send(f"Loaded {self.queuedCards} codes.")
                self.sync = False

        if message.author.name == self.user.name and f"Loaded {self.queuedCards} codes." in message.content:
            await self.calculateCardLoadTime(self.queuedCards)
            await self.getCard(self.data)

        if message.author == self.karuta_bot and message.content == f'<@{self.user.id}>, that code is invalid.':
            await self.postCard('invalid', self.tempcard, 0)
            
        if message.author == self.karuta_bot and message.embeds:
            embed = message.embeds[0]
            embed_lines = embed.description.split('\n')
            for line in embed_lines[2:]:
                code = line.split('`')[1]
                quality = line.split('`')[3]
            if code == self.tempcard:
                await self.postCard(embed.image.url.split("?")[0], self.tempcard, quality.count('★'))

    async def getCard(self, data):
        while data:
            self.tempcard = data.pop(0)
            await self.channel.send(f"kv {self.tempcard}")
            await asyncio.sleep(10)
            
    async def postCard(self, url, code, quality):
        if url == 'invalid':
            logger.warning(f"Invalid code: {code}")
        else:
            logger.info(f"Posting card: {code}, Quality: {quality}, URL: {url}")
        async with aiohttp.ClientSession() as session:
            data = {"link": url,
                    "code": code,
                    "q": quality}
            async with session.post('http://127.0.0.1/saveLink', data=data) as resp:
                respText = await resp.text()
                if respText == 'okés':
                    self.queuedCards -= 1
                    logger.info(f"Cards left: {self.queuedCards}")
                    if self.queuedCards == 0:
                        logger.info("All cards loaded from messages!")
                        await asyncio.sleep(10)
                        self.sync = True
                else:
                    logger.error(respText)
       
    async def calculateCardLoadTime(self, cards):
        total_secs = cards * 10
        hours = total_secs // 3600
        mins = (total_secs % 3600) // 60
        secs = total_secs % 60
        await self.channel.send(f'''
                                # ----------------------------------------------------------------------------------------------------------------------------
                                # Estimated card load time: {hours} hours, {mins} minutes and {secs} seconds
                                # ----------------------------------------------------------------------------------------------------------------------------
                                ''')
        
async def getEmptyLinks():
    while True:
        if client.queuedCards == 0 and client.sync == True:
            async with aiohttp.ClientSession() as session:
                data = {"b": 1}
                async with session.post('http://127.0.0.1/getEmptyLinks', data=data) as resp:
                    respText = await resp.text()
                    if respText:
                        if respText != 'Okés':
                            logger.error(respText)
        #else:
            #logger.warning("Not checking for empty links because there are still cards to load!")
        await asyncio.sleep(10)

client = bolondBot()
client.run(tokens['carddurr'])