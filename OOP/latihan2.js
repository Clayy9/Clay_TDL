// Setter and Getter*
// Setter dan getter adalah salah satu fondasi dibalik library
// state management seperti redux, vuex, mobx, ngrx, dll.

class Product {
  constructor(name) {
    this.name = name;
  }
}
const thinkpad = new Product("Lenovo thinkap x230");
console.log(thinkpad.name); // Lenovo thinkpad x230

// Name disini pasti merujuk pada string, namun jika data yang dimasukkan adalah int maka akan jadi masalah
// itulah gunanya Setter!

// Setter*
// Setter adalah method yang fungsinya khusus untuk mengubah nilai sebuah property.
// Tujuannnya agar data yang dikirimkan bisa diproses atau diolah terlebih dahulu.

class Laptop {
  constructor() {
    this.name = null;
  }

  set setName(value) {
    // Kita periksa datanya sebelum mengubah properti name
    if (typeof value === "string") {
      this.name = value;
    } else {
      this.name = null;
    }
  }
}

const asus = new Laptop();
asus.setName = "Asus"; // Ini akan mengubah nilai properti name menjadi "Asus"
asus.setName = 230; // Nilai properti name tetap null

// Getter*
// Getter adalah method yang fungsinya khusus untuk mengambil nilai sebuah property.

class Motor {
  constructor() {
    this.name = null;
  }
  set setName(value) {
    // kita check datanya dulu sebelum mengubah property name
    if (typeof value === "string") {
      this.name = value;
    } else {
      this.name = null;
    }
  }
  get getName() {
    if (this.name === null) {
      return `value belum di set`;
    }
    return this.name;
  }
}
const honda = new Motor();
console.log(honda.getName); // value belum di set
honda.setName = "Honda x10";
console.log(honda.getName); // Honda x10

// Override*
// Override adalah fitur yang memungkinkan kamu membuat method di dalam kelas child yang
// nama methodnya sama dengan method di class parentnya.

// Ini bisa menjadi solusi ketika kamu membutukan fungsi dengan
// perilaku yang berbeda antara parent class dan subclassnya.

class Hewan {
  constructor(name) {
    this.name = name;
  }
  getDetail() {
    return `Animal name is ${this.name}`;
  }
}

class Mamalia extends Hewan {
  constructor(name, age) {
    super(name);
    this.age = age;
  }
  getDetail() {
    return `Animal name is ${this.name}, ${this.age} years old`;
  }
}

const monyet = new Mamalia("Monyet", 4);
console.log(monyet.getDetail()); // Animal name is Monyet, 4 years old

// Bedanya override dan overload
// Overload membuat 2 fungsi atau lebih yang memiliki nama method yang sama namun beda argumen
// Override membuat 2 fungsi atau lebih yang memiliki nama dan argumen yang sama

// Overload*
class Bertelur extends Hewan {
  constructor(name, age, area) {
    super(name);
    this.age = age;
    this.area = area;
  }

  detailHewan() {
    return `Hewan ${this.name} berumur ${this.age} tahun`;
  }

  detailHewan(area) {
    return `Hewan ${this.name} berumur ${this.age} tahun, tinggal di ${this.area}`;
  }
}

const ular = new Bertelur("Ular", 4);
console.log(detailHewan()); // Hewan Ular berumur 4 tahun

const hiu = new Bertelur("Hiu", 5);
console.log(detailHewan("Air")); // Hewan Hiu berumur 5 tahun, tinggal di Air
