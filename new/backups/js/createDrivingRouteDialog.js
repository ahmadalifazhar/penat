  $("#Dialog").click(function(){
        $.Dialog({
            'title'       : 'Route Guide',
            'content'     : '<div id="dialogPopupContent">From&nbsp;:&nbsp;&nbsp;<input id="txtStart" type="text" size="50"/><br /><br />To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input id="txtEnd" type="text" size="50"/><br /><br /><input type="button" id="CreateDrvButton"  value="Create Driving Route" onclick="createDirections();"/>&nbsp;<button id="closeDialog" onclick="clearDisplay()">Close</button></div><br /><hr><div style=" width:500px;height:300px;overflow-x:hidden;" id="directionsItinerary"></div>',
            'draggable'   : true,
            'overlay'     : false,
            'closeButton' : false,
            'buttonsAlign': 'right',
            'position'    : {
                'zone'    : 'center'
            },
            'buttons'     : {
               
            }
        });
    });
  
  
  /*
  $('#CreateDrvButton').click(function() {
  if ($('#txtStart').val() == '') {
	  alert("ting tongg");
	  if($('#txtStart').val==""){ 
		$('#txtStart').css("border", "1px solid red");
		}

  } else {
    createDirections();
  }
});

           */
