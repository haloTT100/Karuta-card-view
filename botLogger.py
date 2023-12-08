import logging
import time

class CustomFormatter(logging.Formatter):

    gray = "\033[90m"
    blue = "\033[38;5;69m"
    yellow = "\033[38;5;226m"
    green = "\033[38;5;46m"
    red = "\x1b[31;20m"
    bold_red = "\x1b[31;1m"
    reset = "\x1b[0m"
    format = "%(time)s %(levelname)s %(user)s %(message)s"
    FORMATS = {
        logging.DEBUG: gray + "%(time)s " + reset + blue + "%(levelname)s" + green +"     %(user)s:" + reset + " %(message)s",
        logging.INFO: gray + "%(time)s " + reset + blue + "%(levelname)s" + green + "     %(user)s:" + reset + " %(message)s",
        logging.WARNING: gray + "%(time)s " + reset + yellow + "%(levelname)s" + green +"  %(user)s:" + reset + " %(message)s",
        logging.ERROR: gray + "%(time)s " + reset + red + "%(levelname)s" + green +"    %(user)s:" + reset + " %(message)s",
        logging.CRITICAL: gray + "%(time)s " + reset + bold_red + "%(levelname)s" + green +" %(user)s:" + reset + " %(message)s"
    }

    def __init__(self, username):
        super().__init__()
        self.username = username
        
    
    def format(self, record):
        record.time = time.strftime("%Y-%m-%d %H:%M:%S", time.gmtime(record.created))
        record.user = self.username
        log_fmt = self.FORMATS.get(record.levelno)
        formatter = logging.Formatter(log_fmt)
        return formatter.format(record)
    
