<div class="container" style="width: 100%;">                                                                                
  <div class="table-responsive" id="latestTable">          
  
  </div>
</div>
<script>

  var messages = (openFBR("messages"))
                          .limitToLast(3);  
  messages.on("value", displayLatest);
  
</script>