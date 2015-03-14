<div class="container" style="width: 100%;">                                                                                
  <div>          
  <table class="table" id="completedTable">
  </table>
  </div>
</div>
<script>
  myFirebaseRef = new Firebase("https://group15.firebaseio.com/messages");
  myFirebaseRef.on("value", displayCompleted);
  //document.getElementById("outstandingTable").addEventListener("click", messageTableFunctionality, false);
</script>