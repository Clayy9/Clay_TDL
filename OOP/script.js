// OOP
const car = {
  // Properties
  brand: "Ford",
  color: "red",
  maxSpeed: 200,
  chassisNumber: "f-1",

  // Methods
  drive: () => {
    console.log("driving");
  },

  reverse: () => {
    console.log("reversing");
  },

  turn: () => {
    console.log("turning");
  },
};

console.log(car.brand);
car.drive();

function Car(brand, color, plate_number) {
  this.brand = brand;
  this.color = color;
  this.plate_number = plate_number;
}

Car.prototype.drive = function () {
  console.log(`${this.brand} ${this.color} is driving`);
};

Car.prototype.reverse = function () {
  console.log(`${this.brand} ${this.color} is reversing`);
};

const car1 = new Car("Toyota", "Silver", "KB 1122 GA");
const car2 = new Car("BMW", "Pink", "B 166 ER");

car1.drive();
car2.reverse();
