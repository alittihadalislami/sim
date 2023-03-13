<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>AMBK - MA Al Ittihad Al Islami</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  </head>
  <body>
    <?php 
        $jadwal = [
            ["Senin, 13 Maret 2023. 07.30-09.00", "https://tinyurl.com/ambkski", "SKI"],
            ["Senin, 13 Maret 2023. 09.30-11.00", "https://tinyurl.com/ambkindonesia", "Bahasa Indonesia"],
            ["Selasa, 14 Maret 2023. 07.30-09.00", "https://tinyurl.com/ambkaqidah", "Aqidah Ahlak"],
            ["Selasa, 14 Maret 2023. 09.30-11.00", "https://tinyurl.com/ambkhadis", "Ilmu Hadist"],
            ["Rabu, 15 Maret 2023. 07.30-09.00", "https://tinyurl.com/ambkarabw", "Bahasa Arab W"],
            ["Rabu, 15 Maret 2023. 09.30-11.00", "https://tinyurl.com/ambkpkn", "PKn"],
            ["Kamis, 16 Maret 2023. 07.30-09.00", "https://tinyurl.com/ambkmtk", "Matematika W"],
            ["Kamis, 16 Maret 2023. 09.30-11.00", "https://tinyurl.com/ambksejarahw", "Sejarah W"],
            ["Sabtu, 18 Maret 2023. 07.30-09.00", "https://tinyurl.com/ambkqurdis", "Qurdis"],
            ["Sabtu, 18 Maret 2023. 09.30-11.00", "https://tinyurl.com/ambkilmutafsir", "Ilmu Tafsir"],
            ["Ahad, 19 Maret 2023. 07.30-09.00", "https://tinyurl.com/ambkfikih", "Fikih"],
            ["Ahad, 19 Maret 2023. 09.30-11.00", "https://tinyurl.com/ambkinggris", "Bahasa Inggris"],
            ["Senin, 20 Maret 2023. 07.30-09.00", "https://tinyurl.com/ambkarabp", "Bahasa Arab P"],
            ["Senin, 20 Maret 2023. 09.30-11.00", "https://tinyurl.com/ambkusul", "Usul Fikih"]
        ]
    ?>
    <div class="container">
        <div class="col-md-8">
    <div class="row mb-5 text-center">
        <div class="col-md-12 mx-auto">
            <img src="<?=base_url()?>/assets/img/basmalah.png" width="200px">
        </div>
        <div class="mt-5 col-md-12 mx-auto">
            <h2>Asesmen Madrasah </h2> 
            <h3>MA Al Ittihad Al Islami</h3>
            <h5>Tahun Pelajaran 2022-2023</h5>
        </div>
    </div>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Waktu</th>
                    <th scope="col">Mata Pelajaran</th>
                    <th scope="col">link</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jadwal as $jd) : ?>
                <tr>
                    
                    <th scope="row"><?=$jd[0]?> <p>dsafjakls</p></th>
                    <td><?=$jd[2]?></td>
                    <?php  
                    $cek = false;
                    if ($cek) {
                        $link = $jd[1];
                    }else{
                        $link = "#";
                    }
                    ?>
                    <td><a href="<?=$link?>">Mulai ujian</a></td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
        <div class="mt-5 mb-5 col-md-12 mx-auto">
            <h5 class="text-center">Panitia Ujian 2023</h5>
        </div>
    </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>