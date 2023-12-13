import asyncio
import aiohttp

async def run_bot(bot_script):
    process = await asyncio.create_subprocess_exec('python', '-Xfrozen_modules=off', bot_script)
    await process.wait()

async def git_pull():
    process = await asyncio.create_subprocess_exec('git', 'pull', stdout=asyncio.subprocess.PIPE)
    stdout, stderr = await process.communicate()
    print(stdout.decode())
    await process.wait()

async def main():
    # Run bots concurrently
    await asyncio.gather(
        run_bot('bot.py'),
        run_bot('bot2.py'),
        run_bot('bot3.py'),
        run_bot('bot4.py')
    )

    # Schedule git pull every hour
    while True:
        await git_pull()
        await asyncio.sleep(5)  # Sleep for 1 hour

# Run the main function
asyncio.run(main())