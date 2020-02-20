<?php
include("handyfunctions.php");
$conn = create_conn();
$output = '';
$data = "";
if (isset($_POST['annonser'])) {
    $data = ($_POST['annonser']);
    $sql = "SELECT * FROM loppis";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $output .= '
        <table border = 1>
        <thead>
        <tr>
        <th>ID</th>
        <th>Säljare</th>
        <th>Rubrik</th>
        <th>Beskrivning</th>
        <th>Pris</th>
        <th>Uppladdad</th>
        <th>Radera</th>
        <th>Editera</th>
        </tr>
        </thead>';
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $saljare = $row['saljare'];
            $rubrik = $row['rubrik'];
            $beskrivning = $row['beskrivning'];
            $pris = $row['pris'];
            $uppladdad = date("d.m.Y H:i:s", strtotime($row['datum']));
            $output .= "
                <tbody>
                <tr>
                <td>".$id."</td>
                <td>".$saljare."</td>
                <td>".$rubrik."</td>
                <td>".$beskrivning."</td>
                <td>".$pris."</td>
                <td>".$uppladdad."</td>";
            if ($_SESSION['roll'] == 'admin') {
                $output .= "
                <td>"."<button class='delete' id='del_$id' data-id='$id'>Radera</button>"."</td>
                <form action=uppdatera.php method=POST>
                <input type=hidden name=id value=$id>
                <input type=hidden name=rubrik value=$rubrik>
                <input type=hidden name=beskrivning value=$beskrivning>
                <input type=hidden name=pris value=$pris>
                <td>"."<button class='update'>Uppdatera</button>"."</td>
                </form>
                </tr>";
            }
            else if ($_SESSION['roll'] == 'editor') {
                $output .= "
                <form action=uppdatera.php method=POST>
                <input type=hidden name=id value=$id>
                <input type=hidden name=rubrik value=$rubrik>
                <input type=hidden name=beskrivning value=$beskrivning>
                <input type=hidden name=pris value=$pris>
                <td>"."<button class='update'>Uppdatera</button>"."</td>
                </form>
                </tr>";
            }
        }
        print($output);
    } else {
        print('Data Not Found');
    }
} else if (isset($_POST['users'])) {
    $data = ($_POST['users']);
    $sql = "SELECT * FROM users";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $output .= '
        <table border = 1>
        <thead>
        <tr>
        <th>ID</th>
        <th>Namn</th>
        <th>Epost</th>
        <th>Roll</th>
        <th>Status</th>
        <th>Registrerad</th>
        <th>Radera</th>
        <th>Editera</th>
        </tr>
        </thead>';
        while ($row = $result->fetch_assoc()) {
            $id = $row['id'];
            $namn = $row['namn'];
            $epost = $row['epost'];
            $roll = $row['roll'];
            $status = $row['status'];
            $datum = date("d.m.Y H:i:s", strtotime($row['datum']));
            $output .= "
                <tbody>
                <tr>
                <td>".$id."</td>
                <td>".$namn."</td>
                <td>".$epost."</td>
                <td>".$roll."</td>
                <td>".$status."</td>
                <td>".$datum."</td>";
            if ($_SESSION['roll'] == 'admin') {
                $output .= "
                <td>"."<button class='deleteUser' id='del_$id' data-id='$id'>Radera</button>"."</td>
                <form action=uppdatera.php method=POST>
                <input type=hidden name=id value=$id>
                <input type=hidden name=rubrik value=$namn>
                <input type=hidden name=beskrivning value=$epost>
                <input type=hidden name=pris value=$roll>
                <input type=hidden name=pris value=$status>
                <td>"."<button class='update'>Uppdatera</button>"."</td>
                </form>
                </tr>";
            }
        }
        print($output);
    } else {
        print('Data Not Found');
    }
}
?>

