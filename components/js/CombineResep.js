function combineResep(resepFreetext, obatList) {
    const textResepArray = (resepFreetext || "")
        .split("\n")
        .map(item => item.replace(/^\d+\.\s*/, '').trim())
        .filter(item => item !== "");

    const listResepArray = (obatList || []).map(item => {
        let str = item.nama_obat || item.nama_pendek || "";
        if (item.qty) {
            str += ` (${item.qty} ${item.nama_satuan || ""}`.trim() + `)`;
        }
        if (item.ket_aturan_pakai || item.aturan_pakai) {
            str += `, Aturan: ${item.ket_aturan_pakai || item.aturan_pakai || "-"}`;
        }
        if (item.admintime) {
            str += `, Waktu: ${item.admintime}`;
        }
        if (item.timing) {
            str += `, Ket: ${item.timing}`;
        }
        return str;
    });

    const combinedResep = [...textResepArray, ...listResepArray];

    if (combinedResep && combinedResep.length > 0) {
        return combinedResep
            .map((item, index) => `${index + 1}. ${item}`)
            .join("\n");
    } else {
        return "-";
    }
}

const resepFreetext = "1. Paracetamol 500 mg Tablet (1 Tablet), Aturan: -, Waktu: -, Ket: Sesudah\n2. Paracetamol 500 mg Tablet (15 Tablet), Aturan: 3 x sehari 1 Tablet, Waktu: Pagi: 06.00, Siang: 14.00, Malam: 22.00, Ket: Sesudah";

const obatList = [
    {
        "id_penjualan": 505,
        "r_no": 1,
        "nama_pendek": "HARNAL OCAS 0,4",
        "nama_obat": "HARNAL OCAS 0,4 0.4 mg tablet ASTELLAS, PT",
        "qty": 30,
        "nama_satuan": "tablet",
        "kekuatan": 0.4,
        "nama_kekuatan": "mg",
        "aturan_pakai": "1dd1",
        "ket_aturan_pakai": "1 x sehari 1 Tablet ",
        "timing": "Sesudah",
        "admintime": "Malam: 20.00",
        "kronis": "0"
    },
    {
        "nama_obat": "2 FDC Dewasa NEW KIMIA FARMA, PT"
    },
    {
        "nama_obat": "Acyclovir  400 mg Tablet Hexpharm Jaya"
    },
    {
        "nama_obat": "ALGANAX (Alprazolam) 0.5 mg Tablet GUARDIAN PHARMATAMA, PT"
    }
];

const resepGroup = combineResep(resepFreetext, obatList);
console.log(resepGroup);


// DOKUMEN REFERENSI : RS10_RM.17.A ~ RS10-Asesmen Pra Anestesi  v2  || LOCAL ||