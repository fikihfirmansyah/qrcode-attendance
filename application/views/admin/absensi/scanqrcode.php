<style media="screen">
	.btn-md {
		padding: 1rem 2.4rem;
		font-size: .94rem;
		display: none;
	}

	.swal2-popup {
		font-family: inherit;
		font-size: 1.2rem;
	}

	video {
		width: 100%;
		height: auto;
	}

	select {

		/* styling */
		background-color: white;
		border: thin solid blue;
		border-radius: 4px;
		display: inline-block;
		font: inherit;
		line-height: 1.5em;
		padding: 0.5em 3.5em 0.5em 1em;

		/* reset */

		margin: 0;
		-webkit-box-sizing: border-box;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		-webkit-appearance: none;
		-moz-appearance: none;
	}
</style>

<div class="row" onload="fullScreenNow();">
	<div class="col-12">
		<div class="card m-b-30">
			<div class="card-body">
				<div class='box'>
					<div class='box-header'></div>
					<div class='box-body'>
						<?php
						$attributes = array('id' => 'button');
						echo form_open('Absen/cek_id', $attributes); ?>
						<div id="sourceSelectPanel" style="display:none">
							<label for="sourceSelect">Change video source:</label>
							<select id="sourceSelect" style="max-width:400px"></select>
						</div><br>
						<div>
							<video id="video" height="100%" style="border: 1px solid gray"></video>
						</div>
						<textarea hidden="" name="username" id="result" readonly></textarea>
						<span> <input type="submit" id="button" class="btn btn-success btn-md" value="Cek Kehadiran"></span>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
	</div> <!-- end col -->
</div> <!-- end row -->
<script>
	addEventListener("click", function() {
		var
			el = document.documentElement,
			rfs =
			el.requestFullScreen ||
			el.webkitRequestFullScreen ||
			el.mozRequestFullScreen;
		rfs.call(el);
	});

	// Find the right method, call on correct element
	function launchFullScreen(element) {
		if (element.requestFullScreen) {
			element.requestFullScreen();
		} else if (element.mozRequestFullScreen) {
			element.mozRequestFullScreen();
		} else if (element.webkitRequestFullScreen) {
			element.webkitRequestFullScreen();
		}
	}

	// Launch fullscreen for browsers that support it!
	launchFullScreen(document.documentElement); // the whole page
	launchFullScreen(document.getElementById("videoElement")); // any individual element
</script>

<script type="text/javascript" src="<?= base_url('assets/') ?>plugins/zxing/zxing.min.js"></script>
<script type="text/javascript">
	const codeReader = new ZXing.BrowserQRCodeReader()
	let audio = new Audio("<?= base_url('assets/') ?>audio/beep.mp3");

	function decodeVideoInputDevice(selectedDeviceId) {
		codeReader.decodeFromInputVideoDevice(selectedDeviceId, 'video').then((result) => {
			console.log(result)
			document.getElementById('result').textContent = result.text
			if (result != null) {
				audio.play();
			}

			setTimeout(() => {
				$('#button').submit();
			}, 2000);
		}).catch((err) => {
			console.error(err)
			document.getElementById('result').textContent = err
		})
	}

	const sourceSelectInput = document.getElementById('sourceSelect');
	sourceSelectInput.addEventListener('change', (ev) => {
		const selectedDeviceId = sourceSelectInput.value;
		decodeVideoInputDevice(selectedDeviceId);
	})

	window.addEventListener('load', function() {
		let selectedDeviceId;
		let audio = new Audio("<?= base_url('assets/') ?>audio/beep.mp3");
		console.log('ZXing code reader initialized')
		codeReader.getVideoInputDevices()
			.then((videoInputDevices) => {
				selectedDeviceId = videoInputDevices[0].deviceId
				if (videoInputDevices[1] != null) {
					selectedDeviceId = videoInputDevices[1].deviceId
				}
				if (videoInputDevices.length >= 1) {
					videoInputDevices.forEach((element) => {
						const sourceOption = document.createElement('option')
						sourceOption.text = element.label
						sourceOption.value = element.deviceId
						sourceSelectInput.appendChild(sourceOption)
					})
					const sourceSelectPanel = document.getElementById('sourceSelectPanel')
					sourceSelectPanel.style.display = 'block'
				}

				decodeVideoInputDevice(selectedDeviceId);
				console.log(`Started continous decode from camera with id ${selectedDeviceId}`)
			})
			.catch((err) => {
				console.error(err)
			})
	})
</script>