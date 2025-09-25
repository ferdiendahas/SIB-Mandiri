import user from './data.mjs'

const index = () => {
    //tampilkan data
    console.log("Daftar seluruh user")
    user.forEach((u, i) => {
        console.log(`${i+1}. Nama : ${u.nama} | umur : ${u.umur} | alamat : ${u.alamat}`) 
    });
}

const store = (user) => {
    //tambahkan data
    user.push(
        {nama : "Wildan", umur : 26, alamat : "Jl. Hamparan"},
        {nama : "Shifa", umur : 21, alamat : "Jl. Arwana"}
    );
    console.log(" Pemberitahuan!");
    console.log(" Data telah ditambahkan");
}

const destroy = (namaUser) => {
    //hapus data
    const indexUser = user.findIndex(u => u.nama === namaUser);
    if (indexUser !== -1){
        user.splice(indexUser,1);
        console.log(`Data dengan nama user ${namaUser} berhasil dihapus`)
    } else {
        console.log(`Data dengan nama user ${namaUser} tidak ditemukan`)
    }
}

export{index, store, destroy};

