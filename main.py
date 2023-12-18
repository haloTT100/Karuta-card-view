import asyncio
import json

with open('secret.json', 'r', encoding='utf8') as f:
    git = json.load(f)
with open('trianon.json', 'r', encoding='utf8') as f:
    bots = json.load(f)

repo_url = f"https://{git['git']}:x-oauth-basic@github.com/haloTT100/Karuta-card-view.git"

async def run_bot(bot_script, *args):
    process = await asyncio.create_subprocess_exec('python', '-Xfrozen_modules=off', bot_script, *args)
    await process.wait()

async def git_pull():
    while True:
        process = await asyncio.create_subprocess_exec('git', 'pull', repo_url, 'dev')
        await process.wait()
        await asyncio.sleep(60)

async def main():
    tasks = []
    tasks.append(asyncio.create_task(git_pull()))
    for name, args in bots.items():
        tasks.append(asyncio.create_task(run_bot('bot.py', args['token'], name, str(args['channel']), str(args['embedNum'])), name=name))
    await asyncio.gather(*tasks)
    
asyncio.run(main())