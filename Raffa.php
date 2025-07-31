 <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Raffa";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $nama = $_POST['nama'];
  $tipe = $_POST['tipe'];
  $alamat = $_POST['alamat'];
  $tlp = $_POST['tlp'];
  if(isset($_POST['id'])){
    $id2 = $_POST['id'];
    $sql = "UPDATE `users` SET `nama`= '$nama', `tipe`='$tipe', `alamat`='$alamat', `tlp`='$tlp' WHERE id='$id2'";
  
    if ($conn->query($sql) === TRUE) {
      echo "
      <script>
      alert('Data Berhasil Diubah!!');
      window.location = 'Raffa.php';
      </script>
      ";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  } else {
    $sql = "INSERT INTO `users` (`id`, `nama`, `tipe`, `alamat`, `tlp`) 
    VALUES (NULL, '$nama', '$tipe', '$alamat', '$tlp');";
  
    if ($conn->query($sql) === TRUE) {
      echo "
      <script>
      alert('Data Berhasil Ditambahkan!!');
      window.location = 'Raffa.php';
      </script>
      ";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }
  }

} else if(isset($_GET['aksi'])) {
  $id = $_GET['id'];
  if($_GET['aksi']=="edit"){
    $sql2 = "SELECT * FROM users where id='$id'";
    $result2 = $conn->query($sql2);
    $row2 = $result2->fetch_object();
      $nama2 = $row2->nama;
      $tipe2 = $row2->tipe;
      $alamat2 = $row2->alamat;
      $tlp2 = $row2->tlp;
  } else if($_GET['aksi']=="hapus"){    
    $sql = "DELETE FROM `users` WHERE id='$id'";  
    if ($conn->query($sql) === TRUE) {
      echo "
      <script>
      alert('Data Berhasil Dihapus!!');
      window.location = 'Raffa.php';
      </script>
      ";
    } else {
      echo "Error: " . $sql . "<br>" . $conn->error;
    }    
  }

}



$sql = "SELECT * FROM users";                                                                                                           
$result = $conn->query($sql);

if ($result->num_rows > 0) {
 // output data of each row
  // while($row = $result->fetch_array()) {
    //   echo  $row[1]."<br>";
    // }
    // while($row = $result->fetch_assoc()) {
    //   echo  $row['nama']."<br>";
    // }
    
    
} else {
    echo "0 results";
  }
  
  // $sql2 = "SELECT * FROM users where id='2'";
  // $result2 = $conn->query($sql2);
  
  // $data = $result2->fetch_object();
  // echo $data->alamat;
  
$conn->close();
?>


    <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #F8F8FF;
        }

        .dashboard {
            display: flex;
            height: 100vh;
        }

        .sidebar {
            background-color: #87CEFA;
            color: white;
            width: 250px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .sidebar img {
            width: 80px;
            border-radius: 50%;
            margin-bottom: 15px;
        }

        .sidebar h2 {
            margin: 10px 0;
        }

        .sidebar button {
            background-color: #000000;
            color: white;
            border: none;
            padding: 10px;
            width: 100%;
            margin-bottom: 10px;
            cursor: pointer;
            border-radius: 5px;
        }

        .sidebar button:hover {
            background-color: #808080;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        .content h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .form-section {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            margin-bottom: 20px;
        }

        .form-section input, .form-section select {
            width: calc(50% - 10px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-section button {
            padding: 10px 20px;
            background-color:#880000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-section button:hover {
            background-color: #880000;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #00BFFF;
            color: white;
        }
    </style>
</head>
<body>

<div class="dashboard">
    <div class="sidebar">
        
        <img src="https://via.placeholder.com/80" alt="Admin Avatar">
        <h2>Admin</h2>
        <button>Kelola User</button>
        <button>Kelola Laporan</button>
        <button>Logout</button>
    </div>
    <div class="content">
        <h1>Kelola User</h1>
        <div class="form-section">
            <form method="post" action="Raffa.php">
                <?php
              if(isset($id)){
                echo"
                      <input
                  type=\"hidden\"
                  name=\"id\"
                  value=\"$id\"
                  />";
                  }
                  ?>
                <select name="tipe">
                    <option value="Tipe">Tipe User</option>
                    <option value="Gudang" <?php if(isset($tipe2) and $tipe2=="Gudang"){
              echo "selected";
            }
            ?> >Gedung</option>
                    <option value="Kamar"  <?php if(isset($tipe2) and $tipe2=="Kamar"){
              echo "selected";
            }
            ?> >Kamar</option>
                    <option value="Pembersih" <?php if(isset($tipe2) and $tipe2=="Pembersih"){
              echo "selected";
            }
            ?> >Pembersih</option>
            </select>

<label for="name">Nama</label>
            <input
            type="text"
            id="name"
            name="nama"
            placeholder="Masukkan nama"
            <?php if(isset($nama2)){
              echo "value=\"$nama2\"";
            }
            ?>            
            />
            
            <label for="phone">Telepon</label>
            <input
            type="text"
            id="phone"
            name="tlp"
            placeholder="Masukkan nomor telepon"
            <?php if(isset($tlp2)){
              echo "value=\"$tlp2\"";
            }
            ?>            
            />
            
            <label for="address">Alamat</label>
            <input
            type="text"
            id="address"
            name="alamat"
            placeholder="Masukkan alamat"
            <?php if(isset($alamat2)){
              echo "value=\"$alamat2\"";
            }
            ?>            
            />
             <?php  
            if(isset($_GET['aksi']) and $_GET['aksi']=="edit"){
              echo "
              <button type=\"submit\">
              Ubah
              </button>
              <a href=\"Raffa.php\">
              <button type=\"button\">
              Kembali
              </button>
              </a>
              ";
            } else {
              echo "
              <button type=\"submit\">
              Tambah
              </button>
              ";
            }
            ?>
               
            </form>
                </div>
                <table>
                  <div class="table-kotak">
                <thead>
                    <tr>
                    <th>ID User</th>
                    <th>Tipe User</th>
                    <th>Nama User</th>
                    <th>Alamat</th>
                    <th>Telepon</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
              while($row = $result->fetch_object()) {
                  ?>
                <tr>
                    <td><?=$row->id?></td>
                    <td><?=$row->tipe?></td>
                    <td><?=$row->nama?></td>
                    <td><?=$row->alamat?></td>
                    <td><?=$row->tlp?></td>
                     <td>
                      <a href="?id=<?=$row->id?>&aksi=edit"><button type="button">Edit</button></a>
                      <a href="?id=<?=$row->id?>&aksi=hapus"><button type="button">Hapus</button></a>
                    </td>
                </tr>
                <?php
                }
                ?>

</tbody>
</table>
</div>
</div>

</body>
</html>