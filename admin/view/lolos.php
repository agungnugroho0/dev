<?php

// echo "lolos";
$lolos = $konek -> query("SELECT  log_lolos.*,lolos.nama FROM log_lolos JOIN lolos ON log_lolos.nis = lolos.nis ");
while ($lolos2 = $lolos -> fetch_assoc()) { ?>


<div class="flex flex-wrap max-w-screen-xl gap-2 mx-2 mt-2">
    <a href="" class="md:w-2/6 w-full cursor-default"><div class="bg-sky-50 hover:bg-sky-100 active:scale-95 transition rounded-lg px-2 py-1">
        <span class="font-medium"><?= $lolos2['nama']?>&nbsp;|</span>
        <span class="font-normal"><?= $lolos2['tgl_lolos']?></span>
        <span class="font-normal"><?= $lolos2['job']?></span>

    </div></a>
</div>
<?php
}
?>
