function getTicketDetails(email,card,quantity,busId,ticketPrice) {
  var ticketID = document.getElementById('busId').value;
  var ticketPrice= document.getElementById('ticketPrice').value;
  var card =document.getElementById('card').value;
  var quantity = document.getElementById('quantity').value;
  var email = document.getElementById('email');

  document.write(ticketID+"<br>").innerHTML('busdetail');
  document.write(ticketPrice+"<br>").innerHTML('busprice');
  document.write(card+"<br>").innerHTML('creditcard');
  document.write(quantity+"<br>").innerHTML('quantity');
  document.write(email+"<br>").innerHTML('email');

}
