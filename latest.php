<div class="container" style="width: 100%;">                                                                                
  <div class="table-responsive" id="latestTable">          
  
  </div>
</div>
<script>
  var myFirebaseRef = new Firebase("https://group15.firebaseio.com/messages");

  //TEST DATA
  myFirebaseRef.push({
    number : "07731784340",
    message: "Hello, world!"
  });
  myFirebaseRef = new Firebase("https://group15.firebaseio.com/groups");
  myFirebaseRef.push({
    name : "Default"
  });
  myFirebaseRef = new Firebase("https://group15.firebaseio.com/groupcontact");
  myFirebaseRef.push({
    contactid:"someid",
    groupid:"anotherid"
  });
  myFirebaseRef = new Firebase("https://group15.firebaseio.com/contact");
  myFirebaseRef.push({
    name:"Rachel",
    number:"07731784340"
  });

  myFirebaseRef = new Firebase("https://group15.firebaseio.com/messages");
  //END DATA
  //TODO: NEEDS TIMESTAMP!
  var tableContent ="";
  var query = myFirebaseRef.limitToLast(3);
  query.on("value", function(snap) {
    snap.forEach(function(ss) {
      tableContent = tableContent+"<tr><td>"+ss.val().number+"</td><td>"+ss.val().message+"</td></tr>";
    });

    var table = "<table class=\"table\"><thead><tr><th>Latest Orders</th></tr></thead><tbody>"+tableContent+"</tbody></table>";
    document.getElementById("latestTable").innerHTML = table;
  });
  
</script>