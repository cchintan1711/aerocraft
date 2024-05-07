<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        
    </head>
    <body class="antialiased">
        <div style="display:flex; padding: 10px;">
			<span id="signal_1_img" style="margin-right: 10px; display:block; width: 60px; height: 60px; background: red; border: 1px solid #000; border-radius: 50%;"></span>
			<input class="signalClass" type="number" name="signal1">
		</div>
        <div style="display:flex; padding: 10px;">
			<span id="signal_2_img" style="margin-right: 10px; display:block; width: 60px; height: 60px; background: red; border: 1px solid #000; border-radius: 50%;"></span>
			<input class="signalClass" type="number" name="signal2">
		</div>
        <div style="display:flex; padding: 10px;">
			<span id="signal_3_img" style="margin-right: 10px; display:block; width: 60px; height: 60px; background: red; border: 1px solid #000; border-radius: 50%;"></span>
			<input class="signalClass" type="number" name="signal3">
		</div>
        <div style="display:flex; padding: 10px;">
			<span id="signal_4_img" style="margin-right: 10px; display:block; width: 60px; height: 60px; background: red; border: 1px solid #000; border-radius: 50%;"></span>
			<input class="signalClass" type="number" name="signal4">
		</div>
        <div style="padding: 10px;">
			<span style="margin-right: 10px;">Green Interval (in sec)</span>
			<input type="number" name="time_1" id="time_1">
		</div>
        <div style="padding: 10px;">
			<span style="margin-right: 10px;">Yellow Interval (in sec)</span>
			<input type="number" name="time_2" id="time_2">
		</div>
        <div style="display:flex; padding: 10px;">
			<input style="margin-right: 10px;" type="button" value="Start" onclick="return resetSignal();"><input type="button" value="Stop" onclick="stopSignal();">
		</div>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script>
		var i = 1;
		function resetSignal() {
			var id = window.setTimeout(function() {}, 0);
			var myarray = [];
			
			while (id--) {
				window.clearTimeout(id); // will do nothing if no timeout with id is present
			}
			
			$("input[class=signalClass]").each(function(){
				$(this).attr('id','signal'+this.value);
				
				if(this.value > 4 || this.value < 1)
				{
					$(this).focus();
					alert('Please enter value between 1-4');
					stopSignal();
					return false;
				}
				else if(myarray.length>0 && $.inArray(this.value, myarray) !== -1)
				{
					$(this).focus();
					myarray = [];
					alert('Duplicate value found');
					stopSignal();
					return false;
				}
				myarray.push(this.value);
			})
			
			startSignal();
		}
		function startSignal() {
			var time_1 = $('#time_1').val()*parseInt(1000);
			var time_2 = $('#time_2').val()*parseInt(1000);
			
			if(time_1=='' || time_1==0)
			{
				$('#time_1').focus();
				alert('Please enter green light interval');
				stopSignal();
				return false;
			}
			else if(time_2=='' || time_2==0)
			{
				$('#time_2').focus();
				alert('Please enter yellow light interval');
				stopSignal();
				return false;
			}
			else
			{
				$('#signal'+i).siblings('span').css('background','green');
				setTimeout(function(){
					setTimeout(function(){
						console.log('#signal'+i);
						$('#signal'+i).siblings('span').css('background','red');
						i++;
						if(i==5) {
							i = 1;
						}
						startSignal();
					}, time_2)
					console.log('#signal'+i);
					$('#signal'+i).siblings('span').css('background','yellow');
				}, time_1)
			}
		}
		function stopSignal() {
			var id = window.setTimeout(function() {}, 0);
			while (id--) {
				window.clearTimeout(id); // will do nothing if no timeout with id is present
			}
		}
		</script>
    </body>
</html>
