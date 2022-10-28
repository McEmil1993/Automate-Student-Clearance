require('./bootstrap');

window.Echo.channel('alertchannel')
.listen('AlertEvent',(e)=>{
	alert(e.message);
});
