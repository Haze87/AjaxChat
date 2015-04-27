<?php
require_once('core.php');
$Chat =  new Chat();
?>

<div id="chat">
	<div id="chField">
    </div>
    <div id="onlinePeople">
    list of online users here
    &#x25BC
    </div>

	<div id="chCommand">
		<form action="index.php" method="POST" >
			<textarea type='text' name="text_message" placeholder="Type here" maxlength="250"></textarea>
			<input type="button" name="sendMessage" value="Send">
		</form>
		<div id="SendOnEnter">
			press Enter <input id="sendOnEnter" type="checkbox">
		</div>
	</div>

</div>

<?php
if(isset($_POST['text_message']))
{
	if(!empty($_POST['text_message']))
	{
		$Chat->postNewMessage($_SESSION['id'], $_POST['text_message']);
	}
}

if(isset($_POST['update']))
{
	$Chat->getMessages();
} 
	
?>
 