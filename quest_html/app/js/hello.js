const num_1 = 5;
const num_2 = 3;

let sum = num_1 + num_2;
let difference = num_1 - num_2;

// console.log(sum + difference);


const greeting = (name) =>{
    console.log(`Hell,${name}`);
}
// greeting('筒口');


const checkTemperature = (temp) => {
    if (temp > 30) {
        console.log('Hot');
    } else if (temp > 15) {
        console.log("Warm");
    } else {
        console.log("Cold");
    }
}
// checkTemperature(20);


const hasOdd = (numbers) => {
    let oddResult = false;
    numbers.forEach((number) => {
        if (number % 2 !== 0) {
            oddResult = true;
        }
    });
    console.log(oddResult);
}
// hasOdd([2, 2, 8, 2, 10]);


const odd = (numbers) => {
    let oddArray = [];
    numbers.forEach((number) => {
        if (number % 2 !== 0) {
            oddArray.push(number);
        }
    });
    console.log(oddArray);
}
// odd([1,2,3,4,5]);

const square = (numbers) => {
    let doubleArray = [];
    numbers.forEach((number) => {
        doubleArray.push(number * 2);
    });
    console.log(doubleArray);
}

// square([1, 2, 3, 4, 20]);

books = [
    { title: "JavaScript入門", author: "山田太郎" },
    { title: "JavaScript絵本", author: "山田次郎" }
];

const printBooks = (books) => {
    books.forEach((book) => {
        console.log(`『${book.title}』${book.author}`);
    });
}

// printBooks(books);
let users = [
    {
        username: "山田",
        permissions: {
            canRead: true,
            canWrite: true,
            canDelete: false,
        },
    },
    {
        username: "佐藤",
        permissions: {
            canRead: false,
            canWrite: true,
            canDelete: false,
        },
    },
    {
        username: "筒口",
        permissions: {
            canRead: true,
            canWrite: true,
            canDelete: true,
        },
    },
];

const checkPermission = (username, permission) => {
    const user = users.find(user => user.username === username);

    if (user) {
        return user.permissions[permission] === true;
    }

    return false;

};

// console.log(checkPermission("山田", "canRead"));

const obj = {
    method: function () {
        console.log("method");
    },
};
obj.method();

const obj2 = {
    method: () => {
        console.log("method");
    },
};
obj2.method();

const obj3 = {
    method() {
        console.log("method");
    },
};
obj3.method();
