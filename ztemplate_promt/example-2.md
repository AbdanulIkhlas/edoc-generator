buat edoc dengan menggunakan master orkestrator ini [SKILL.md](file;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/.agents/skills/edoc-generator/SKILL.md) .

untuk template nya menggunakan ini [template.pdf](file;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/images/template.pdf) 

buatkan untuk config, json, schema, dan untuk index,html nya bisa langsung edit ini [index.html#L33-1598](textBlock;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/output/index.html#L33-1598) , yang lain jangan di ubah, cukup ubah dan tambahkan disini saja, jangan ada yang di kurangi.

dan untuk print.php nya bisa langsung edit disini [print.php#L0-333](textBlock;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/output/print.php#L0-333) , gunakan class yang ada, tampilan wajib sama persis dengan [template.pdf](file;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/images/template.pdf) , dan rapi. Dan pastikan Seluruh konten dibungkus dalam tabel master berstruktur baris (.main-outer-table) dengan page-break-inside: auto.
Mengeliminasi page-break-inside: avoid pada container besar sehingga jika konten melebihi batas Halaman 1, baris tabel akan terpotong secara alami dan mengalir ke Halaman 2 tanpa mengosongkan sisa halaman pertama..

ini informasi tambahannya :
1. text pada Dengan ini bertindak atas nama diri sendiri/suami/istri/anak/ibu/ayah/saudara *) dari : pada section  Diisi Oleh Pasien / Keluarga di awal , itu adalah dropdown dengan option Diri Sendiri, Suami, Istri, Anak, Ibu, Ayah, Saudara
2. pada bagian no `3. PRIVASI`, text Saya mengijinkan / tidak mengijinkan *), itu adalah dropdown juga
3. masih pada bagian no `3. PRIVASI`, pada bagian gambar pertama ini , itu adalah list data yang bisa di tambah tambah gitu
4. pada bagian no `4. KEROHANIAN`, text Saya Menginginkan / Tidak menginginkan *) adalah dropdown
5. pada bagian no `7. INFORMASI BIAYA`, pada gambar kedua ini , itu adalah checklist atau checkbox yang aktif ketika di checklist di html nya, dan di pdf nya ke checklist jika di checklist.

layout html nya di buat menggunakna section biasa mirip seperti contoh contoh ini ya [index.html](file;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/.agents/skills/edoc-generator/examples/asesmen-awal-medis-rawat-jalan-yasyfin/index.html) [index.html](file;file:///e%3A/A%20Main%20Storage/Project/FG/edoc-generator/.agents/skills/edoc-generator/examples/asesmen-ulang-rawat-jalan-yasyfin/index.html) .

buat yang rapi
