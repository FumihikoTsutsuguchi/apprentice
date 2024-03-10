const arrys = [
    age => 10,
    age => 20,
    age => 30,
    age => 40
];
const arry2 = [
    {age : 10},
    {age : 20},
    {age : 30},
    {age : 40},
];

// const newArry = [];

// for (let i = 0; i < arry.length; i++) {
//     const val = arry[i]*2;
//     if (val > 50) {
//         newArry.push(arry[i]*2)
//     }
// }
// console.log(newArry);



const newArry2 = arrys.map(arry => {
    return arry();
});
// const newArry2 =  arry.map(age => age.num * 2);
// const newArry3 = newArry2.filter(val => val > 50);
console.log(newArry2);
// console.log(newArry3);

// const newArry2 =  arry2.map(arry => {
//     return arry.age * 2;
// });
// console.log(newArry2);
