<div class="evntdetails">

	<h2>WHY TO ATTEND</h2>

	<div class="tab">

	  <a href="javascript:void(0)" class="tablinks active" onclick="openCity(event, 'Attendee')">Attendee</a>

	  <a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Speaker')">Speaker</a>

	  <a href="javascript:void(0)" class="tablinks" onclick="openCity(event, 'Sponsor')">Sponsor</a>

	</div>



	<div id="Attendee" class="tabcontent" style="display:block">

	<?php do_action('attendy_function','attendee');?>
	  

	</div>



	<div id="Speaker" class="tabcontent" style="display:none">

	 
		<?php do_action('attendy_function','Speaker');?>
	</div>



	<div id="Sponsor" class="tabcontent" style="display:none">

	  
<?php do_action('attendy_function','Sponsor');?>

	</div>
	

</div>
<div id="attendee-mid">
		<ul>
			<li>
				<div class="mid1">

					<div class="part1">75%</div>

					<div class="part2">

						<p class="upper">of Attendees are CXO's</p>

						<p class="lower">& Decision Makers</p>

					</div>

				</div>
			</li>
			<li>
				<div class="mid2">

					<div class="part1">$750M+</div>

					<div class="part2">

						<p class="upper">Average Company</p>

						<p class="lower">Revenue</p>

					</div>

				</div>
			</li>
			<li>
				<div class="mid3">

					<div class="part1">$72M+</div>

					<div class="part2">

						<p class="upper">Average Information</p>

						<p class="lower">Technology Budget</p>

					</div>

				</div>
			</li>
		</ul>

	</div>


<script>

	function openCity(evt, cityName) {

	  var i, tabcontent, tablinks;

	  tabcontent = document.getElementsByClassName("tabcontent");

	  for (i = 0; i < tabcontent.length; i++) {

		tabcontent[i].style.display = "none";

	  }

	  tablinks = document.getElementsByClassName("tablinks");

	  for (i = 0; i < tablinks.length; i++) {

		tablinks[i].className = tablinks[i].className.replace(" active", "");

	  }

	  document.getElementById(cityName).style.display = "block";

	  evt.currentTarget.className += " active";

	}

</script>

