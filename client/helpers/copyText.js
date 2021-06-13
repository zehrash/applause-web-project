function displayCopied() {
    var copyText = document.getElementById("created-event-link");
  
    copyText.select();
    copyText.setSelectionRange(0, 99999); /* For mobile devices */
    document.execCommand("copy");
    
    let tooltip = document.getElementById("copyTooltip");
    tooltip.innerHTML = "Copied: " + copyText.value;
  }
  function removeDisplayCopied() {
    var tooltip = document.getElementById("copyTooltip");
    tooltip.innerHTML = "Copy to clipboard";
  }