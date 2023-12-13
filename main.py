import asyncio

async def run_bot(bot_script):
    process = await asyncio.create_subprocess_exec('python', '-Xfrozen_modules=off', bot_script)
    await process.wait()

async def git_pull():
    while True:
        process = await asyncio.create_subprocess_exec('git', 'pull')
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