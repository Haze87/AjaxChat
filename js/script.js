$(window).unload(function(){
	RegErrors.reset();
});

var RegErrors = {
	
	reg_error1: true,
	reg_error2: true,
	reg_error3: true,
	reg_error4: true,
	reg_error5: true,

	checkErrors: function()
	{
		var errorResult = this.reg_error1 +
					      this.reg_error2 +
						  this.reg_error3 +
						  this.reg_error4 +
						  this.reg_error5 ; 
		errorResult == 0 ?
		$('input[name="signup"]').removeClass('error disabled').removeAttr('disabled')  
		: 
		$('input[name="signup"]').addClass('error').attr('disabled', 'disabled');

	},

	comparePasswords: function(a, b)
	{
		if (a===b)
		{
			this.reg_error5 = false;
		}
		else
		{
			this.reg_error5 = true;
		}
	},

	pression: function()
	{
		$('input[name="signup"]').attr('disabled', 'disabled');
	},

	reset: function()
	{
		this.reg_error1 = true;
		this.reg_error2 = true;
		this.reg_error3 = true;
		this.reg_error4 = true;
		this.reg_error5 = true;
		this.checkErrors();
	}
};

///////////////////////////////////////////////////////////////////////////////////////////////////

$('input[name="r_username"]').keyup(function(){	
	$(this).removeClass('error');
	var newValue = $(this).val().trimLeft().replace(/ +/g, " ");
	$(this).val(newValue);
	var username = $(this).val();

	$.post('classes/Registration.php', {username: username}, function(data) {
	    $('#X1').html(data);
	    var error = $('#X1').text().length;
	    if(error>5)
	    {
	    	$('#X1').show();
	    	RegErrors.reg_error1 = true;
	    	RegErrors.checkErrors();
	    }
	    else
	    {
	    	$('#X1').hide();
            (username.length == 0) ? 
            RegErrors.reg_error1 = true : RegErrors.reg_error1 = false;     
			RegErrors.checkErrors();	
        }
	})
	
}).keydown(function(){
	RegErrors.pression();
});	

$('input[name="r_username"]').blur(function(){
	if($('#X1').text().length>5 && $(this).val().length!=0)
	{
		$(this).addClass('error');
	}
	else
	{
		$(this).removeClass('error');
	}
	$('.errorBox').hide();
});
///////////////////////////////////////////////////////////////////////////////////////////////////

$('input[name="r_email"]').keyup(function(){
	$(this).removeClass('error');
	var newValue = $(this).val().trim();
	$(this).val(newValue);
	var email = $(this).val();
	$.post('classes/Registration.php', {email: email}, function(data){
		$('#X1').html(data);
		var error = $('#X1').text().length;
	    if(error>5)
	    {
	    	$('#X1').show();
	    	RegErrors.reg_error2 = true;
	    	RegErrors.checkErrors();
	    }
	    else
	    {
	    	$('#X1').hide();
	    	(email.length == 0) ? 
            RegErrors.reg_error2 = true : RegErrors.reg_error2 = false;     
			RegErrors.checkErrors();   	

	    }
	});
	
}).keydown(function(){
	RegErrors.pression();
});

$('input[name="r_email"]').blur(function(){
	if($('#X1').text().length>5)
	{
		$(this).addClass('error');
	}
	else
	{
		$(this).removeClass('error');
	}
	$('.errorBox').hide();
});
///////////////////////////////////////////////////////////////////////////////////////////////////

$('input[name="r_password"]').keyup(function(){
	$(this).removeClass('error');
	var password = $(this).val();
	var password_againVal = $('input[name="r_password_again"]').val();
	RegErrors.comparePasswords(password, password_againVal);
	if(password!=password_againVal && password_againVal!=0)
	{
		$('input[name="r_password_again"]').addClass('error');
	}
	else
	{
		$('input[name="r_password_again"]').removeClass('error');
	}
	$.post('classes/Registration.php', {password: password}, function(data){
		$('#X2').html(data);
		var error = $('#X2').text().length;
	    if(error>5)
	    {
	    	
	    	$('#X2').show();
	    	RegErrors.reg_error3 = true;
	    	RegErrors.checkErrors();
	    }
	    else
	    {
	    	$('#X2').hide();
			(password.length == 0) ? 
            RegErrors.reg_error3 = true : RegErrors.reg_error3 = false;     
			RegErrors.checkErrors();   	
	    }
	});
	
}).keydown(function(){
	RegErrors.pression();
});

$('input[name="r_password"]').blur(function(){
	if($('#X2').text().length>5)
	{
		$(this).addClass('error');
	}
	else
	{
		$(this).removeClass('error');
	}
	$('.errorBox').hide();
});
///////////////////////////////////////////////////////////////////////////////////////////////////

$('input[name="r_password_again"]').keyup(function(){
	$(this).removeClass('error');
	var passwordVal = $('input[name="r_password"]').val();
	var password_again = $(this).val();
	RegErrors.comparePasswords(passwordVal, password_again);
	$.post('classes/Registration.php', {passwordVal: passwordVal, password_again: password_again}, function(data){
		$('#X2').html(data);
		var error = $('#X2').text().length;
	    if(error>5)
	    {
	    	$('#X2').show();
	    	RegErrors.reg_error4 = true;
	    	RegErrors.checkErrors();
	    }
	    else
	    {
	    	$('#X2').hide();
            (password_again.length == 0) ? 
            RegErrors.reg_error4 = true : RegErrors.reg_error4 = false;     
			RegErrors.checkErrors();
	    }
	});
	
}).keydown(function(){
	RegErrors.pression();
});

$('input[name="r_password_again"]').blur(function(){
	if($('#X2').text().length>5)
	{
		$(this).addClass('error');
	}
	else
	{
		$(this).removeClass('error');
	}
	$('.errorBox').hide();
});
///////////////////////////////////////////////////////////////////////////////////////////////////
//CHAT FUNCTIONS

setInterval(function(){
	$.post('page.php', {update: true}, function(data){
		$('#chField').html(data);
	})
}, 500);

var text_message

$('textarea[name="text_message"]').keyup(function() {
	text_message = $(this).val();
});

$('input[name="sendMessage"]').click(function(){
	$.post('page.php', {text_message: text_message});
	$.post('page.php', {update: true}, function(data){
		$('#chField').html(data);
		$('#chField').scrollTop(($('#chField')[0].scrollHeight)+15);
	});
    $('textarea[name="text_message"]').val('');

});

//on checkbox check===true, submit on enter key press else nothing
var sendOnEnter = false;

$('#sendOnEnter').click(function() {
    if($(this).prop("checked") == true)
    {
        sendOnEnter = true;
    }
    else if( $(this).prop("checked") == false)
    {
        sendOnEnter = false;   
    }
});
		
$('textarea[name="text_message"]').keydown(function(event){
	if(event.which == 13 && sendOnEnter==true)
	{
		event.preventDefault();
		$('input[name="sendMessage"]').trigger('click');
	}
	
});
    

var menuY;
var windowY;

//toggling between login and register forms with a fast slide effect
$('#or').click(function() {
	$('#signup, #login').slideToggle(200)
}).toggleText('or register', 'or log in');

$('.headerItem').click(function(event){
	menuY = $(window).scrollTop();
	event.stopPropagation('.subMenu');
	$(this).prevAll().find('.pointer, .subPointer, .subMenu').slideUp(75);
	$(this).nextAll().find('.pointer, .subPointer, .subMenu').slideUp(75);
	$(this).find('.pointer, .subPointer, .subMenu').slideDown(150);
	$('#searchBox').focus().val('');
});


//hides open menus when user srolls 100 px up or down
$(window).scroll(function(){
	windowY = $(window).scrollTop();
	$('#scrollPos').html('Scroll Position: '+windowY);
	if(menuY-windowY>100 || menuY-windowY<-100) 
	{
		$('.pointer, .subPointer, .subMenu').slideUp(150);
	}
});


$( window ).resize(function(){
	var windowW = $(window).width();
	var windowH = $(window).height();
	$('#windowSize').html('W: '+windowW+' H: '+windowH);
});

$(document).click( function(){
    $('.pointer, .subPointer, .subMenu').slideUp(75);
});

	