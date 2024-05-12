from datetime import datetime
from datetime import datetime
dt = datetime.today()  # Get timezone naive now
seconds = dt.timestamp()
print(round(seconds))
now = datetime.now()
epoch_time = datetime(1970, 1, 1)
delta = (now - epoch_time) 
sekarang= round(delta.total_seconds())
print(sekarang)