//Data Produk
let produkList = [
    {id : 1, nama : "Laptop", harga : 12000000},
    {id : 2, nama : "Smartphone", harga : 5000000},
    {id : 3, nama : "Tablet", harga : 8000000},
    {id : 4, nama : "Headphone", harga : 1200000},
    {id : 5, nama : "Smartwatch", harga : 3000000},
    //minimal 5 data
];

const evenHandler = {
    onTambahProduk : (produk) => console.log(` Prdouk baru ditambahkan ${produk.nama} dengan harga Rp.${produk.harga}`),
    onHapusProduk : (id) => console.log(`produk dengan ID ${id} telah dihapus`),
    onTampilanProduk : () => console.log(` Daftar Produk ditampilkan`)
};

//menambah produk dengan spread operator    
function tambahProduk(id, nama, harga){
    const produkbaru = {id, nama, harga};
    produkList = [...produkList, produkbaru];
    evenHandler.onTambahProduk(produkbaru)
};

//menghapus produk dengan rest parameter
function hapusProduk(...id){
    produkList = produkList.filter(p => !id.includes(p.id));
    id.forEach(i => evenHandler.onHapusProduk(i))
};

//menampilkan produk dengan destructuring
function tampilkanProduk(){
    evenHandler.onTampilanProduk();
    console.log(`Daftar Produk yang dijual`);
    for(const {id, nama, harga} of produkList){
        console.log(`ID : ${id} | Nama : ${nama} | Harga = Rp.${harga}`)
    }
};

tampilkanProduk();
tambahProduk(6, "Mouse", 350000 )
tampilkanProduk();
hapusProduk(2);
tampilkanProduk();