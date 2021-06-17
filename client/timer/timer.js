function formatTimeLeft(time) {
    const minutes = Math.floor(time / 60);
    
    let seconds = time % 60;
    
    if (seconds < 10) {
      seconds = `0${seconds}`;
    }
  
    return `${seconds}`;
  }

  