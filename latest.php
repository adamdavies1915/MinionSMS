<div class="container" style="width: 100%;">                                                                                
  <div class="table-responsive" id="latestTable">          
  
  </div>
</div>
<script>

  var myFirebaseRef = (new Firebase("https://group15.firebaseio.com/messages"))
                          .limitToLast(3);  
  myFirebaseRef.on("value", displayLatest);
  
</script>