<!-- Fasilitas -->
<div class="content">

<?php
$idfasilitas = $_GET['idfasilitas'];

$query = mysqli_query($conn, "SELECT * FROM post where id_fasilitas = '$idfasilitas'");
while ($row = mysqli_fetch_assoc($query)) {
    ?>
    <div class="post">
        <div class="text">
            <h2><?php echo $row['text'];?></h2>
        </div>
        <div class="foto">
            <img src="asset/img/<?php echo $row['foto'];?>">
        </div>
    </div>
<?php
}
?>
    </div>
