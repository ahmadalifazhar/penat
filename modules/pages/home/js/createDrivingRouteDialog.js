  $("#Dialog").click(function(){
        $.Dialog({
            'title'       : 'Route Guide',
            'content'     : '<div id="dialogPopupContent">From&nbsp;:&nbsp;&nbsp;<input id="txtStart" type="text" size="30"/>&nbsp;<input type="button" id="showBtn" class="mini" value=">" onClick="$(\'#txtStart\').show(1000);$(\'#showBtn\').hide(500);" style="display:none"><input type="button" id="fromMyLoc" value="From My Location" onclick="$(\'#txtStart\').hide(500);$(\'#txtStart\').val(\'melaka\');$(\'#showBtn\').show(1000);"/><br /><br />To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input id="txtEnd" type="text" size="30"/><br /><br /><input type="button" id="CreateDrvButton"  value="Create Driving Route" onclick="createDirections();"/>&nbsp;<button id="closeDialog" onclick="clearDisplay()">Close</button></div><br /><hr><div style=" width:300px;height:200px;overflow-x:hidden;" id="directionsItinerary"></div>',
            'draggable'   : true,
            'overlay'     : false,
            'closeButton' : false,
            'buttonsAlign': 'right',
            'position'    : {
                'zone'    : 'right'
            },
            'buttons'     : {
               
            }
        });
    });
  
  
$("#fromMyLoc").click(function () {
								alert("test");
				var startLoc = 'melaka';
				$("#txtStart").val(startLoc);
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
  
  
  <script type='text/javascript'>//alif custom dialog box for get directions
 $("#Dialog").click(function(){
							 alert("(Testting)Dialog Box Called before function");
        $.Dialog({
            'title'       : 'Route Guide',
            'content'     : '<div id="dialogPopupContent">From&nbsp;:&nbsp;&nbsp;<input id="txtStart" type="text" size="50"/><br /><br />To&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;&nbsp;<input id="txtEnd" type="text" size="50"/><br /><br /><input type="button" id="CreateDrvButton"  value="Create Driving Route" onclick="createDirections();"/>&nbsp;<button id="closeDialog" onclick="clearDisplay()">Close</button></div><br /><hr><div style=" width:500px;height:300px;overflow-x:hidden;" id="directionsItinerary"></div>',
            'draggable'   : true,
            'overlay'     : false,
            'closeButton' : false,
            'buttonsAlign': 'left',
            'position'    : {
                'zone'    : 'right'
            },
            'buttons'     : {
               
            }
        });
		alert("(Testting)Dialog Box Called after function");
    });
</script>


           */
