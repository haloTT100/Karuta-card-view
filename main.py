import asyncio
import json

with open('secret.json', 'r', encoding='utf8') as f:
    git = json.load(f)

repo_url = f"https://{git['git']}:x-oauth-basic@github.com/haloTT100/Karuta-card-view.git"

async def run_bot(bot_script):
    process = await asyncio.create_subprocess_exec('python', '-Xfrozen_modules=off', bot_script)
    await process.wait()

async def git_pull():
    while True:
        process = await asyncio.create_subprocess_exec('git', 'pull', repo_url, 'dev')
        await process.wait()
        await asyncio.sleep(60)

async def main():
    # Run bots concurrently
    await asyncio.gather(
        run_bot('bot.py'),
        run_bot('bot2.py'),
        run_bot('bot3.py'),
        run_bot('bot4.py'),
        git_pull()
    )

# Run the main function
asyncio.run(main())