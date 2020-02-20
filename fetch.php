<?php
include("handyfunctions.php");
$conn = create_conn();
$output = '';
if (!empty($_POST["query"])) {
	$search = test_input($_POST["query"]);
	$sql = "SELECT * FROM loppis WHERE rubrik LIKE '%".$search."%' OR beskrivning LIKE '%".$search."%';";
} else {
	$sql = "SELECT * FROM loppis";
}
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	$output .= '<div class="table-responsive">
					<table class="table table bordered">
						<tr>
							<th>Användare</th>
							<th>Rubrik</th>
							<th>Beskrivning</th>
							<th>Pris</th>
						</tr>';
	while ($row = $result->fetch_assoc()) {
		$sql1 = "SELECT * FROM loppis WHERE rubrik='".$row['rubrik']."';";
		$rows = $conn->query($sql1);
		$test = $rows->fetch_assoc();
		$output .= "
			<tr>
				<td><a href='annonser.php?user=".$row['saljare']."'>".$row['saljare']."</a></td>
				<td>".$test['rubrik']."</td>
				<td>".$test['beskrivning']."</td>
				<td>".$test['pris']."</td>
			</tr>
		";
	}
	print($output);
} else {
	print('Data Not Found');
}
?>