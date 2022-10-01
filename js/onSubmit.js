  // onsubmit show loader 

  function showLoader() {
    // Show full page LoadingOverlay
 $.LoadingOverlay("show");
 
 // Hide it after 3 seconds
 setTimeout(function(){
     $.LoadingOverlay("hide");
 }, 4000);
 }