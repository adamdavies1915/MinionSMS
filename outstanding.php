<div class="container" style="width: 100%;">                                                                                
  <div class="table-responsive">          
  <table class="table" id="outstandingTable">
  </table>
  </div>
</div>
<script>
  myFirebaseRef = new Firebase("https://group15.firebaseio.com/messages");

  var tableContent ="";
  myFirebaseRef.on("value", function(snap) {
    snap.forEach(function(ss) {
      tableContent = tableContent+"<tr><td>"+ss.val().number+"</td><td>"+ss.val().message+"</td><td><div class=\"dropdown pull-right\"><div class=\"pull-right\"><button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenu\" data-toggle=\"dropdown\" aria-expanded=\"true\">Action<span class=\"caret\"></span></button><ul class=\"dropdown-menu\" role=\"menu\" aria-labelledby=\"dropdownMenu1\"><li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-ok\"></span> Mark Done</a></li><li role=\"presentation\"><a role=\"menuitem\" tabindex=\"-1\" href=\"#\"><span aria-hidden=\"true\" class=\"pull-left glyph glyph-remove\"></span> Decline </a></li></ul></div></div></td></tr>";
    });

    var table = "<thead><tr><th>Orders</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
    document.getElementById("outstandingTable").innerHTML = table;
  });
</script>