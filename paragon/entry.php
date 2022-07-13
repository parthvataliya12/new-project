<?php 
include('connect.php');

$models = array('LEG-guard','Saree guard','Bikes ladies footrest','Gripcover','Break paddel rubber','Seatcover','Gear liver rubber','Mufflers/silencers','Steel covers for silencer/mufflers','Parking bodycover for bikes','Engin plates','Rear grip / Rear seat handle','Side stand','Centre stand','Handel bar','Bikes side hooks','Side spring carrier','Side box / bags');

for($i=0;$i<count($models);$i++){

	$qry = "INSERT INTO access SET 

		brand_id = '".rand(3,6)."',
		a_type = '2',
		a_name =  '".$models[$i]."',
		a_description = 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum',
		a_picture = '18333_st.jpg',
		a_price = '400',
		status = 'Y',
		slug = '".clean_url($models[$i])."',
		setord = '20',
		meta_title = '".$models[$i]."',
		meta_description = '".$models[$i]."',
		meta_keywords = '".$models[$i]."'
	";
	mysqli_query($db,$qry);
}

 ?>