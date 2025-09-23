
class Kendaraan{
    constructor (merk, model, hargaSewaPerhari){
        this.merk = merk;
        this.model = model;
        this.hargaSewaPerhari = hargaSewaPerhari;
    }

    // hitung total biaya
    getTotalHarga(durasi){
        return this.hargaSewaPerhari * durasi;
    }
    
    getKendaraanInfo(){
        return `${this.merk} ${this.model} harga (Rp.${this.hargaSewaPerhari}/hari)`
    }

    getJenis() {
    return "Kendaraan";
  }

}

class Mobil extends Kendaraan{
    constructor (merk, model, hargaSewaPerhari, jumlahPintu){
        super(merk, model, hargaSewaPerhari);
        this.jumlahPintu = jumlahPintu;
    }

    getMobilInfo(){
        return`Mobil : ${super.getKendaraanInfo()}, ${this.jumlahPintu} pintu`;
    }
    getJenis() {
    return "mobil";
  }
}

class Motor extends Kendaraan{
    constructor (merk, model, hargaSewaPerhari, kapasitasMesin){
        super(merk, model, hargaSewaPerhari);
        this.kapasitasMesin = kapasitasMesin;
    }

    getMotorInfo(){
        return`Motor : ${super.getKendaraanInfo()}, berkapasitas mesin ${this.kapasitasMesin}CC`;
    }
    getJenis() {
    return "motor";
  }
}

class Pelanggan{
    constructor (nama, nomorTelepon, kendaraanDisewa = null){
        this.nama = nama;
        this.nomorTelepon = nomorTelepon;
        this.kendaraanDisewa = kendaraanDisewa;

    }

    // metode pencatatan penyewaan
    sewaKendaraan(kendaraan, durasi, metodePembayaran){
        this.kendaraanDisewa = {
            kendaraan : kendaraan,
            durasi : durasi,
            metodePembayaran : metodePembayaran
        };
    }

    getInfoPelanggan() {
    if (this.kendaraanDisewa) {
      const kendaraan = this.kendaraanDisewa.kendaraan;
      const total = kendaraan.getTotalHarga(this.kendaraanDisewa.durasi);

      return `${this.nama} (${this.nomorTelepon}) menyewa ${kendaraan.getJenis()} ` +
             `${kendaraan.getKendaraanInfo()} selama ${this.kendaraanDisewa.durasi} hari. ` +
             `Total: Rp.${total}, bayar via ${this.kendaraanDisewa.metodePembayaran}`;
    }
    return `${this.nama} (${this.nomorTelepon}) belum menyewa kendaraan.`;
  }
}

class SistemManajemenTransportasi {
  constructor() {
    this.daftarPelanggan = [];
  }

  tambahPelanggan(pelanggan) {
    this.daftarPelanggan.push(pelanggan);
  }

  tampilkanDaftarPelanggan() {
    console.log("Daftar pelanggan yang menyewa");
    this.daftarPelanggan
      .filter(p => p.kendaraanDisewa !== null)
      .forEach((p, index) => {
        console.log(`${index + 1}. ${p.getInfoPelanggan()}`);
      });
  }
  
  tampilkanKendaraanDisewa() {
    console.log("\n=== Kendaraan yang Sedang Disewa ===");
    this.daftarPelanggan.forEach((p, i) => {
      if (p.kendaraanDisewa) {
        console.log(
          `${i + 1}. ${p.kendaraanDisewa.kendaraan.getKendaraanInfo()} ` +
          `(disewa oleh ${p.nama})`
        );
      }
    });
  }
}


// Buat kendaraan
const mobil1 = new Mobil("Toyota", "Avanza", 150000, 4);
const mobil2 = new Mobil("Daihatsu", "Terios", 200000, 4);
const motor1 = new Motor("Honda", "Vario", 70000, 150);
const motor2 = new Motor("Honda", "Vario", 60000, 125);

// Buat pelanggan
const pelanggan1 = new Pelanggan("Andi", "0812345678");
const pelanggan2 = new Pelanggan("Cahya", "0812223344");
const pelanggan3 = new Pelanggan("Lia", "0812556677");
const pelanggan4 = new Pelanggan("Amar", "08125513314");

// Catat penyewaan
pelanggan1.sewaKendaraan(mobil1, 3, "Transfer");
pelanggan2.sewaKendaraan(mobil2, 2, "Transfer");
pelanggan3.sewaKendaraan(motor1, 5, "Tunai");

// Sistem  masukkan pelanggan
const sistem = new SistemManajemenTransportasi();
sistem.tambahPelanggan(pelanggan1);
sistem.tambahPelanggan(pelanggan2);
sistem.tambahPelanggan(pelanggan3);

// Tampilkan seluruh daftar pelanggan yang menyewa
sistem.tampilkanDaftarPelanggan();

// Tampilan untuk daftar kendaraan yang sedang disewa
sistem.tampilkanKendaraanDisewa();

