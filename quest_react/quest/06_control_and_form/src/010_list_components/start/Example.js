// const animals = ["Dog", "Cat", "Rat"];

// const Example = () => {
    // const todos = [
    //     { text: "Reactのドキュメントを読む" , completed: false },
    //     { text: "Reactの練習問題を解く", completed: true },
    //     // 他のTODOアイテム
    // ];

    // // const animalList = [];
    // // for (const animal of animals) {
    // //     animalList.push(<li>{animal}</li>);
    // // }
    // // const helloAnimals = animals.map((animal) => <li>Hello,{animal}</li>);

    // // const todoList = [];
    // const todoTexts = todos.map((todo,index) =>
    //     <li key={index}>{todo.completed === true ? todo.text + '✔️' : todo.text }</li>
    // );

    // return (
    //     <>
    //         <h3>配列の操作</h3>
    //         <ul>
    //             {todoTexts}
    //         </ul>
    //     </>
    // );

// };

// export default Example;

import React, { useState } from 'react';

let outsideCounter = 0;

const Example = () => {
    const [counter, setCounter] = useState(0);

    function increment() {
        outsideCounter++;
        setCounter(counter + 1);
    }

    return (
        <div>
            <p>Counter: {counter}</p>
            <p>Outside Counter: {outsideCounter}</p>
            <button onClick={increment}>Increment</button>
        </div>
    );
}
export default Example;