// Objek*
// Objek adalah kumpulan data yang saling berhubungan, yang mana data tersebut
// terdiri dari pasangan properti dan value/nilai.

// Contoh

const barang = {
  //Barang adalah nama objeknya
  name: "Lenovo Thinkpad x230", //Properti atau atribut dari Barang
  harga: 2300000,
  warna: "hitam",
  berat: "2kg",
};

// Disebut properti ketika value atau nilainya bukan function
// dan disebut method ketika valuenya adalah sebuah function.

// Function Constructur dan Class*
// Membuat template atau istilahnya blueprint dari objek tersebut.
// Ada 2 cara yaitu membuat blueprint dari sebuah objek atau dengan membuat class

// Function constructor*
// Seperti function biasa saja, untuk membedakan function constructor dan function lainnya adalah berikut!

function Person() {} // ini adalah function constructor
function person() {} // ini adalah Function declaration biasa
//
// Ketika kita ingin membuat 3 objek, tidak perlu satu per satu, cukup seperti ini
function Barang(name, price) {
  this.name = name;
  this.price = price;
  this.detail = function () {
    return this.name + " " + this.price;
  };
}

const barang1 = new Barang("Lenovo Thinkpad x230", "2 Juta");
const barang2 = new Barang("Dell xps 13", "10 Juta");
const barang3 = new Barang("Lenovo Thinkpad X1 Carbon", "5 Juta");

// Classes*
// Fitur class menyediakan syntax yang lebih sederhana dan rapi untuk membuat blueprint sebuah objek.//
class Barang {
  constructor(name, price) {
    this.name = name;
    this.price = price;
  }

  detail() {
    return this.name + " " + this.price;
  }
}

const barang4 = new Barang("Lenovo Thinkpad x230", "2 Juta");
const barang5 = new Barang("Dell xps 13", "10 Juta");
const barang6 = new Barang("Lenovo Thinkpad X1 Carbon", "5 Juta");

console.log(barang4.name); //Lenovo THinkpad x230
console.log(barang5.price); //10 Juta

// Access Modifier atau visibility*
// Mengatur tingkat akses terhadap properti atau method dalam sebuah objek
function Mobil(brand, price, color) {
  // Public
  this.brand = brand;
  this.price = price;

  // Privite
  var color = color;

  //Public Method
  this.detail = function () {
    return this.brand + " " + this.price;
  };

  //Privite Method
  this.detail = function () {
    return "Warnanya adalah " + color;
  };
}

const mobil1 = new Mobil("Toyota", "200 Juta", "Biru");

console.log(mobil1); // Mobil { brand : 'Toyota', price = '200 Juta', color : [Function]}
console.log(mobil1.color); //Error

// 4 Pillar OOP
// Encapsulation atau Enkapsulasi*
// Membatasi akses langsung ke properti atau function dari sebuah objek
// Hal ini berguna untuk menghindari "pihak luar" mengubah properti atau fungsi atau hasil di dalamnya

// Contoh!
function Ongkir(berat) {
  var pajakAplikasi = 2000;
  var biaya = function () {
    return berat * 2000;
  };

  this.totalBiaya = function () {
    return pajakAplikasi + biaya;
  };
}

const leptop = new Ongkir(10);
console.log(laptop.totalBiaya());

// Dari contoh diatas, kita menggunakan privite sehingga biaya ongkir
// tidak dapat berubah dan disesuaikan dengan berat barang

// Inheritance*
// Sebuah class mewarisi properti atau methos ke class lain

class People {
  constructor(name, age) {
    this.name = name;
    this.age = age;
  }
}

class Person extends People {
  //subclass dari People
  constructor(name, age, job) {
    super(name, age);
    this.job = job;
  }
}

const eren = new Person("Eren Yegah", 20, "Tukang Rumbling");
console.log(eren); //Eren { name : 'Eren Yegah', age = '20', job : 'Tukang Rumbling'}

// Polymorphism*
// Poly berarti banyak dan morp berarti bentuk
// Dapat disimpulkan bahwa Polymorphism adalah kemampuan membuat variabel, fungsi, atau objek dengan banyak bentuk

class People {
  constructor(name, age) {
    this.name = name;
    this.age = age;
  }

  greet() {
    return `Halo semuanya, perkenalkan nama saya ${this.name}`;
  }
}

class Person extends People {
  //subclass dari People
  constructor(name, age, job) {
    super(name, age);
    this.job = job;
  }

  greet() {
    return `Hello everyone, my name ${this.name}`;
  }
}

const Sasa = new Person("Sasa Potato", 18, "Tukang Makan");
console.log(Sasa.greet()); // Halo semuanya, nama...

// Apa yang terjadi ketika fungsi greet() di Person di tiadakan?
class People {
  constructor(name, age) {
    this.name = name;
    this.age = age;
  }

  greet() {
    return `Halo semuanya, perkenalkan nama saya ${this.name}`;
  }
}

class Person extends People {
  //subclass dari People
  constructor(name, age, job) {
    super(name, age);
    this.job = job;
  }

  //   greet() {
  //     return `Hello everyone, my name ${this.name}`;
  //   }
}

const Rocky = new Person("Sasa Potato", 18, "Tukang Makan");
console.log(Rocky.greet()); //Hello everyone, ...

// greet() disini memiliki banyak bentuk

// Abstraction*
// Teknik menyembunyikan detail tertentu dan hanya menampilkan fungsionalitas atau fitur pentingnya saja
function Ongkir(berat) {
  var pajakAplikasi = 2000;
  var biaya = function () {
    return berat * 2000;
  };

  this.totalBiaya = function () {
    return pajakAplikasi + biaya;
  };
}

const Meja = new Ongkir(10);
console.log(Meja.totalBiaya());
// Disini anda tidak perlu tahu perhitungan dari fungsi Ongkir, yang anda tahu adalah
// bagaimana menampilkan hasil akhir perhitungannya saja
